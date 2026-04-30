<?php

namespace App\Mcp\Tools;

use App\Models\Product;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Tool;

#[Description('Sucht ein Produkt nach Name oder SKU')]
class FindProductTool extends Tool
{
    public string $name = 'find_product';

    public string $description = 'Sucht ein Produkt nach Name oder SKU';

    /**
     * Handle the tool request.
     */
    public function handle(Request $request): Response
    {
        $data = $request->validate([
            'query' => ['required', 'string', 'max:255'],
        ]);

        $query = $data['query'];

        $products = Product::query()
            ->where('is_active', true)
            ->where(function ($builder) use ($query) {
                $builder
                    ->where('name', 'like', "%{$query}%")
                    ->orWhere('sku', 'like', "%{$query}%");
            })
            ->orderBy('name')
            ->get(['id', 'name', 'sku', 'description', 'price', 'stock_quantity'])
            ->map(function (Product $product): array {
                $isOutOfStock = $product->stock_quantity === 0;

                return [
                    ...$product->toArray(),
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
        return [
            'query' => $schema->string(),
        ];
    }
}
