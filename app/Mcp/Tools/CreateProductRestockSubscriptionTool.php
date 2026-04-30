<?php

namespace App\Mcp\Tools;

use App\Models\Product;
use App\Models\ProductRestockSubscription;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Illuminate\Support\Facades\RateLimiter;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Tool;

#[Description('Speichert eine E-Mail für Produkt-Verfügbarkeitsbenachrichtigungen')]
class CreateProductRestockSubscriptionTool extends Tool
{
    private const MAX_ATTEMPTS_PER_MINUTE = 5;

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

        $normalizedEmail = mb_strtolower(trim($data['email']));
        $rateLimitKey = $this->rateLimitKey($request, (int) $data['product_id'], $normalizedEmail);

        if (RateLimiter::tooManyAttempts($rateLimitKey, self::MAX_ATTEMPTS_PER_MINUTE)) {
            $retryAfter = RateLimiter::availableIn($rateLimitKey);

            return Response::json([
                'success' => false,
                'error' => 'Zu viele Anfragen. Bitte versuche es spaeter erneut.',
                'retry_after_seconds' => $retryAfter,
            ]);
        }

        RateLimiter::hit($rateLimitKey, 60);

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
                'email' => $normalizedEmail,
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
            'product_id' => $schema->integer()
                ->description('ID des Produkts')
                ->required(),
            'email' => $schema->string()
                ->description('E-Mail-Adresse fuer die Verfuegbarkeitsbenachrichtigung')
                ->required(),
        ];
    }

    private function rateLimitKey(Request $request, int $productId, string $email): string
    {
        $requesterFingerprint = $this->resolveRequesterFingerprint($request);

        return "mcp:restock-subscription:{$requesterFingerprint}:{$productId}:".sha1($email);
    }

    private function resolveRequesterFingerprint(Request $request): string
    {
        if (filled($request->sessionId())) {
            return 'session:'.$request->sessionId();
        }

        $meta = $request->meta() ?? [];

        if (! empty($meta)) {
            $metaHash = sha1((string) json_encode($meta));

            return 'meta:'.$metaHash;
        }

        if (filled($request->uri())) {
            return 'uri:'.sha1((string) $request->uri());
        }

        return 'anonymous';
    }
}
