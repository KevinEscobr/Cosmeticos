<?php

namespace App\Services;

class PaymentService
{
    /**
     * Resolve the requested gateway
     *
     * @param string $gatewayName
     * @return PaymentGatewayInterface
     */
    public function getGateway(string $gatewayName = 'mock'): PaymentGatewayInterface
    {
        return match (strtolower($gatewayName)) {
            'stripe' => new StripePaymentGateway(),
            'paypal' => new PayPalPaymentGateway(),
            default => new class implements PaymentGatewayInterface {
                public function charge(float $amount, array $metadata = []): array {
                    return [
                        'success' => true,
                        'transaction_id' => 'mock_txn_' . bin2hex(random_bytes(8)),
                        'message' => 'Simulación de cobro exitosa (Modo Prueba)'
                    ];
                }
            }
        };
    }
}
