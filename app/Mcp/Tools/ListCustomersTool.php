<?php

namespace App\Mcp\Tools;

use App\Models\Customer;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Tool;

#[Description('Listet alle Kunden auf')]
class ListCustomersTool extends Tool
{
    public string $name = 'list_customers';

    public string $description = 'Listet alle Kunden auf';

    /**
     * Handle the tool request.
     */
    public function handle(Request $request): Response
    {
        $customers = Customer::query()
            ->orderBy('name')
            ->get(['id', 'name', 'email'])
            ->toArray();

        return Response::json([
            'success' => true,
            'data' => $customers,
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
