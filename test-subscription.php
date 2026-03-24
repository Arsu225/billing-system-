<?php

require 'vendor/autoload.php';

use App\Http\TenantResolver;
use App\Infrastructure\SubscriptionRepository;
use App\Application\SubscriptionService;

// simulate tenant
$_SERVER['HTTP_X_TENANT_ID'] = 'tenant_1';

TenantResolver::resolve();

$repo = new SubscriptionRepository();
$service = new SubscriptionService($repo);

$service->createSubscription(1);

echo "Subscription created!";