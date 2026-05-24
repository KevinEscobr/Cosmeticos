<?php

namespace App\Services;

interface PaymentGatewayInterface
{
    /**
     * Process order payment.
     *
     * @param float $amount
     * @param array $metadata
     * @return array [success => bool, transaction_id => string, error => string]
     */
    public function charge(float $amount, array $metadata = []): array;
}
