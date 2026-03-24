<?php

require 'vendor/autoload.php';

use App\Application\SubscriptionService;
use App\Infrastructure\SubscriptionRepository;

$repo = new SubscriptionRepository();
$service = new SubscriptionService($repo);

// simulate subscription
$subscription = [
    'end_date' => date('Y-m-d', strtotime('-1 day')) // expired yesterday
];

$status = $service->handlePaymentFailure($subscription);

echo "Status: " . $status;