<?php

require 'vendor/autoload.php';

use App\Http\TenantResolver;
use App\Infrastructure\InvoiceRepository;
use App\Application\BillingService;

// simulate tenant
$_SERVER['HTTP_X_TENANT_ID'] = 'tenant_1';

TenantResolver::resolve();

$repo = new InvoiceRepository();
$billing = new BillingService($repo);

$result = $billing->upgradePlan(
    99900,   // old plan
    299900,  // new plan
    10,      // used days
    30       // total days
);

echo "Upgrade charge: " . $result;