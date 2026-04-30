<?php

namespace App\Mcp\Tools;

use App\Models\Customer;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Tool;

#[Description('Legt neuen Kunden an')]
class CreateCustomerTool extends Tool
{
    public string $name = 'create_customer';

    public string $description = 'Legt neuen Kunden an';

    /**
     * Handle the tool request.
     */
    public function handle(Request $request): Response
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
        ]);

        $customer = Customer::create($data);

        return Response::json([
            'success' => true,
            'customer' => $customer->toArray(),
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
            'name' => $schema->string()
                ->description('Name des Kunden')
                ->required(),
            'email' => $schema->string()
                ->description('E-Mail-Adresse des Kunden'),
        ];
    }
}
