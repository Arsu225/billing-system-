<?php

require 'vendor/autoload.php';

use App\Application\BillingService;
use App\Infrastructure\InvoiceRepository;

$repo = new InvoiceRepository();
$billing = new BillingService($repo);

$credit = $billing->downgradePlan(
    299900, // old plan
    10,     // used days
    30      // total days
);

echo "Credit: " . $credit;