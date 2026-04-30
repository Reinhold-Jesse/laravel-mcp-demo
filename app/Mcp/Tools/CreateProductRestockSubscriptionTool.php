<?php

namespace App\Mcp\Tools;

use App\Models\Product;
use App\Models\ProductRestockSubscription;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Tool;

#[Description('Speichert eine E-Mail für Produkt-Verfügbarkeitsbenachrichtigungen')]
class CreateProductRestockSubscriptionTool extends Tool
{
    public string $name = 'create_product_restock_subscription';

    public string $description = 'Speichert eine E-Mail für Produkt-Verfügbarkeitsbenachrichtigungen';

    /**
     * Handle the tool request.
     */
    public function handle(Request $request): Response
    {
        $data = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'email' => ['required', 'email', 'max:255'],
        ]);

        $product = Product::findOrFail($data['product_id']);

        if ($product->stock_quantity > 0) {
            return Response::json([
                'success' => false,
                'error' => 'Das Produkt ist aktuell verfügbar, eine Benachrichtigung ist nicht erforderlich.',
                'product' => $product->only(['id', 'name', 'sku', 'stock_quantity']),
            ]);
        }

        $subscription = ProductRestockSubscription::query()->firstOrCreate(
            [
                'product_id' => $product->id,
                'email' => mb_strtolower($data['email']),
            ]
        );
        $created = $subscription->wasRecentlyCreated;

        return Response::json([
            'success' => true,
            'created' => $created,
            'message' => $created
                ? 'Benachrichtigungsanfrage wurde gespeichert.'
                : 'Für diese E-Mail besteht bereits eine Benachrichtigungsanfrage.',
            'subscription' => $subscription->toArray(),
            'product' => $product->only(['id', 'name', 'sku', 'stock_quantity']),
        ]);
    }

    /**
     * Get the tool's input schema.
     *
     * @return array<string, JsonSchema>
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'product_id' => $schema->integer(),
            'email' => $schema->string(),
        ];
    }
}
