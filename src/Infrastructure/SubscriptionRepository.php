<?php

namespace App\Infrastructure;

use PDO;

class SubscriptionRepository extends BaseRepository
{
    public function create($id, $planId, $status, $startDate, $endDate, $trialEndsAt)
    {
        $db = Database::getConnection();

        $stmt = $db->prepare("
            INSERT INTO subscriptions 
            (id, tenant_id, plan_id, status, start_date, end_date, trial_ends_at)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $id,
            $this->getTenantId(),
            $planId,
            $status,
            $startDate,
            $endDate,
            $trialEndsAt
        ]);
    }
}