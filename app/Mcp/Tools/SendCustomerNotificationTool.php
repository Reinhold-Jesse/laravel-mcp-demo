<?php

namespace App\Mcp\Tools;

use App\Models\Customer;
use App\Notifications\CustomerMessageNotification;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Tool;
use Throwable;

#[Description('Sendet eine Nachricht an einen Kunden per E-Mail')]
class SendCustomerNotificationTool extends Tool
{
    public string $name = 'send_customer_notification';

    public string $description = 'Sendet eine Nachricht an einen Kunden per E-Mail';

    /**
     * Handle the tool request.
     */
    public function handle(Request $request): Response
    {
        $data = $request->validate([
            'customer_id' => ['required', 'integer', 'exists:customers,id'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $customer = Customer::findOrFail($data['customer_id']);

        if (blank($customer->email)) {
            return Response::json([
                'success' => false,
                'error' => 'Der Kunde hat keine E-Mail-Adresse.',
                'customer_id' => $customer->id,
            ]);
        }

        try {
            $customer->notifyNow(new CustomerMessageNotification($data['message']));
        } catch (Throwable $exception) {
            report($exception);

            return Response::json([
                'success' => false,
                'error' => 'Die Benachrichtigung konnte nicht versendet werden.',
                'customer' => $customer->only(['id', 'name', 'email']),
            ]);
        }

        return Response::json([
            'success' => true,
            'message' => 'Benachrichtigung wurde gesendet.',
            'customer' => $customer->only(['id', 'name', 'email']),
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
            'customer_id' => $schema->integer()
                ->description('ID des Kunden')
                ->required(),
            'message' => $schema->string()
                ->description('Nachrichtentext mit maximal 2000 Zeichen')
                ->required(),
        ];
    }
}
