<?php

namespace App\Domain;

interface PaymentGatewayInterface
{
    public function charge(int $amount): bool;

    public function refund(int $amount): bool;

    public function createCustomer(string $name): string;
}