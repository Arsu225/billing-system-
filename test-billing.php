<?php

require 'vendor/autoload.php';

use App\Http\TenantResolver;
use App\Infrastructure\InvoiceRepository;
use App\Application\BillingService;

// simulate tenant
$_SERVER['HTTP_X_TENANT_ID'] = 'tenant_1';

TenantResolver::resolve();

$repo = new InvoiceRepository();
$service = new BillingService($repo);

$service->generateInvoice(99900);

echo "Invoice created!";