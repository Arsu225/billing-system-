<?php

namespace App\Infrastructure;

use App\Domain\PaymentGatewayInterface;

class MockGateway implements PaymentGatewayInterface
{
    public function charge(int $amount): bool
    {
        // simulate failure randomly
        return rand(0, 1) === 1;
    }

    public function refund(int $amount): bool
    {
        return true;
    }

    public function createCustomer(string $name): string
    {
        return uniqid('cust_');
    }
}