<?php

namespace App\Mcp\Resources;

use App\Models\Product;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Resource;

class ProductsResource extends Resource
{
    /**
     * The resource's description.
     */
    protected string $description = 'List of fake products from the database.';

    /**
     * The resource's URI.
     */
    protected string $uri = 'file://resources/products.json';

    /**
     * The resource's MIME type.
     */
    protected string $mimeType = 'application/json';

    /**
     * Handle the resource request.
     */
    public function handle(): Response
    {
        $products = Product::query()
            ->where('is_active', true)
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
}
