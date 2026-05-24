<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class StripePaymentGateway implements PaymentGatewayInterface
{
    protected string $secretKey;

    public function __construct()
    {
        $this->secretKey = env('STRIPE_SECRET', '');
    }

    /**
     * Charge payment using Stripe API
     */
    public function charge(float $amount, array $metadata = []): array
    {
        // If placeholder is still set, execute mock payment for testing
        if (empty($this->secretKey) || $this->secretKey === 'sk_test_51PlaceHolderSecret') {
            Log::warning('Stripe API Secret Key not configured or placeholder used. Executing Mock payment.');
            return [
                'success' => true,
                'transaction_id' => 'ch_mock_' . Str::lower(Str::random(16)),
                'message' => 'Pago completado en modo simulación (Stripe no configurado)'
            ];
        }

        try {
            // Convert price to cents (Stripe currency requirement)
            $amountCents = (int) round($amount * 100);

            // Call Stripe REST API directly using Laravel HTTP Client
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->secretKey,
                'Content-Type' => 'application/x-www-form-urlencoded',
            ])->asForm()->post('https://api.stripe.com/v1/payment_intents', [
                'amount' => $amountCents,
                'currency' => 'usd',
                'payment_method_types' => ['card'],
                'description' => 'Compra E-commerce Cosméticos - ' . ($metadata['email'] ?? 'Invitado'),
                'metadata' => $metadata
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return [
                    'success' => true,
                    'transaction_id' => $data['id'] ?? 'ch_stripe_unknown',
                    'message' => 'Intento de pago Stripe creado correctamente'
                ];
            }

            return [
                'success' => false,
                'transaction_id' => null,
                'error' => $response->json()['error']['message'] ?? 'Error de autenticación o procesamiento con Stripe.'
            ];

        } catch (\Exception $e) {
            Log::error('Stripe Integration Error: ' . $e->getMessage());
            return [
                'success' => false,
                'transaction_id' => null,
                'error' => 'Error de conexión: ' . $e->getMessage()
            ];
        }
    }
}
