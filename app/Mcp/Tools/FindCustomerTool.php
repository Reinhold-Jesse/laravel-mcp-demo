<?php

namespace App\Mcp\Tools;

use App\Models\Customer;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Tool;

#[Description('Sucht Kunden nach Namen')]
class FindCustomerTool extends Tool
{
    public string $name = 'find_customer';

    public string $description = 'Sucht Kunden nach Namen';

    /**
     * Handle the tool request.
     */
    public function handle(Request $request): Response
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $name = $data['name'];

        $customers = Customer::where('name', 'like', "%{$name}%")
            ->get()
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
        return [
            'name' => $schema->string(),
        ];
    }
}