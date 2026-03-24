<?php

require 'vendor/autoload.php';

use App\Application\BillingService;
use App\Infrastructure\InvoiceRepository;

$repo = new InvoiceRepository();
$billing = new BillingService($repo);

$result = $billing->calculateProration(
    99900,  // old plan
    299900, // new plan
    10,     // used days
    30      // total days
);

echo $result;