<?php

namespace App\Mcp\Tools;

use App\Models\Product;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Tool;

#[Description('Listet alle Produkte auf')]
class ListProductsTool extends Tool
{
    public string $name = 'list_products';

    public string $description = 'Listet alle Produkte auf';

    /**
     * Handle the tool request.
     */
    public function handle(Request $request): Response
    {
        $products = Product::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name', 'sku', 'description', 'price', 'stock_quantity'])
            ->map(function (Product $product): array {
                $isOutOfStock = $product->stock_quantity <= 0;

                return [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'sku' => $product->sku,
                    'description' => $product->description,
                    'price' => $product->price,
                    'stock_quantity' => $product->stock_quantity,
                    'is_out_of_stock' => $isOutOfStock,
                    'restock_notification' => $isOutOfStock
                        ? [
                            'eligible' => true,
                            'next_step' => 'Frage den Kunden, ob er bei Verfuegbarkeit informiert werden moechte, und erfasse seine E-Mail-Adresse. Nutze danach das Tool create_product_restock_subscription mit product_id und email.',
                        ]
                        : [
                            'eligible' => false,
                        ],
                ];
            })
            ->toArray();

        return Response::json([
            'success' => true,
            'count' => count($products),
            'data' => $products,
        ]);
    }

    /**
     * Get the tool's input schema.
     *
     * @return array<string, JsonSchema>
     */
    public function schema(JsonSchema $schema): array
    {
        // Dieses Tool erwartet keine Eingaben.
        return [];
    }
}
