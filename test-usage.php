<?php

require 'vendor/autoload.php';

use App\Application\BillingService;
use App\Infrastructure\InvoiceRepository;
use App\Infrastructure\MockGateway; // 👈 ADD THIS

$repo = new InvoiceRepository();
$gateway = new MockGateway(); // 👈 ADD THIS

$billing = new BillingService($repo, $gateway); // 👈 FIXED

$overage = $billing->calculateOverage(
    8, // active users
    5  // plan limit
);

echo "Overage Charge: " . $overage;