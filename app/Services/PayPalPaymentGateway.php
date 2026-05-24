<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PayPalPaymentGateway implements PaymentGatewayInterface
{
    protected string $clientId;
    protected string $clientSecret;
    protected string $baseUrl;

    public function __construct()
    {
        $this->clientId = env('PAYPAL_CLIENT_ID', '');
        $this->clientSecret = env('PAYPAL_CLIENT_SECRET', '');
        
        // Dynamic mode selection (sandbox or production)
        $mode = env('PAYPAL_MODE', 'sandbox');
        $this->baseUrl = $mode === 'live' 
            ? 'https://api-m.paypal.com' 
            : 'https://api-m.sandbox.paypal.com';
    }

    /**
     * Charge payment using PayPal API
     */
    public function charge(float $amount, array $metadata = []): array
    {
        // If placeholder is still set, execute mock payment for testing
        if (empty($this->clientId) || $this->clientId === 'placeholder_client_id') {
            Log::warning('PayPal Client ID not configured or placeholder used. Executing Mock payment.');
            return [
                'success' => true,
                'transaction_id' => 'paypal_mock_' . Str::lower(Str::random(16)),
                'message' => 'Pago completado en modo simulación (PayPal no configurado)'
            ];
        }

        try {
            // 1. Authenticate and get Access Token
            $tokenResponse = Http::asForm()
                ->withBasicAuth($this->clientId, $this->clientSecret)
                ->post($this->baseUrl . '/v1/oauth2/token', [
                    'grant_type' => 'client_credentials'
                ]);

            if (!$tokenResponse->successful()) {
                $errorData = $tokenResponse->json();
                return [
                    'success' => false,
                    'transaction_id' => null,
                    'error' => 'PayPal Auth Error: ' . ($errorData['error_description'] ?? 'Credenciales incorrectas.')
                ];
            }

            $accessToken = $tokenResponse->json()['access_token'];

            // 2. Create PayPal Checkout Order
            $orderResponse = Http::withToken($accessToken)
                ->post($this->baseUrl . '/v2/checkout/orders', [
                    'intent' => 'CAPTURE',
                    'purchase_units' => [
                        [
                            'amount' => [
                                'currency_code' => 'USD',
                                'value' => number_format($amount, 2, '.', '')
                            ],
                            'description' => 'Compra E-commerce Cosméticos - ' . ($metadata['email'] ?? 'Invitado')
                        ]
                    ]
                ]);

            if ($orderResponse->successful()) {
                $orderData = $orderResponse->json();
                return [
                    'success' => true,
                    'transaction_id' => $orderData['id'] ?? 'paypal_order_id',
                    'message' => 'Orden de PayPal generada. Estado: ' . ($orderData['status'] ?? 'CREATED')
                ];
            }

            $errorData = $orderResponse->json();
            return [
                'success' => false,
                'transaction_id' => null,
                'error' => $errorData['message'] ?? 'Error al procesar la orden con PayPal.'
            ];

        } catch (\Exception $e) {
            Log::error('PayPal Integration Error: ' . $e->getMessage());
            return [
                'success' => false,
                'transaction_id' => null,
                'error' => 'Error de conexión: ' . $e->getMessage()
            ];
        }
    }
}
