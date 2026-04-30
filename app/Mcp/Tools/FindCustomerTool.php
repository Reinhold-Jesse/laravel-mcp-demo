<?php

namespace App\Mcp\Tools;

use App\Models\Customer;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Tool;

#[Description('Sucht Kunden nach Namen oder E-Mail-Adresse')]
class FindCustomerTool extends Tool
{
    public string $name = 'find_customer';

    public string $description = 'Sucht Kunden nach Namen oder E-Mail-Adresse';

    /**
     * Handle the tool request.
     */
    public function handle(Request $request): Response
    {
        $data = $request->validate([
            'query' => ['nullable', 'string', 'max:255', 'required_without:name'],
            'name' => ['nullable', 'string', 'max:255', 'required_without:query'],
        ]);

        $query = trim((string) ($data['query'] ?? $data['name'] ?? ''));

        $customers = Customer::query()
            ->where(function ($builder) use ($query) {
                $builder
                    ->where('name', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%");
            })
            ->orderBy('name')
            ->get(['id', 'name', 'email'])
            ->toArray();

        return Response::json([
            'success' => true,
            'count' => count($customers),
            'query' => $query,
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
            'query' => $schema->string()
                ->description('Name, Namensanteil oder E-Mail-Adresse des Kunden')
                ->required(),
        ];
    }
}
