<?php

namespace App\Application;

use App\Infrastructure\SubscriptionRepository;

class SubscriptionService
{
    private SubscriptionRepository $repo;

    public function __construct(SubscriptionRepository $repo)
    {
        $this->repo = $repo;
    }

    public function createSubscription($planId)
    {
        $id = uniqid();
        $startDate = date('Y-m-d');
        $endDate = date('Y-m-d', strtotime('+1 month'));
        $trialEndsAt = date('Y-m-d', strtotime('+14 days'));

        $this->repo->create(
            $id,
            $planId,
            'trial',
            $startDate,
            $endDate,
            $trialEndsAt
        );
    }
    public function handlePaymentFailure($subscription)
{
    $today = date('Y-m-d');

    if ($today <= date('Y-m-d', strtotime($subscription['end_date'] . ' +3 days'))) {
        return 'grace';
    }

    return 'cancelled';
}
}