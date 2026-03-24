<?php

require 'vendor/autoload.php';

use App\Application\BillingService;
use App\Infrastructure\InvoiceRepository;

$repo = new InvoiceRepository();
$billing = new BillingService($repo);

// Example:
$amount = 299900;
$credit = 199933;

$final = $billing->applyCredit($amount, $credit);

echo "Final Payable: " . $final;