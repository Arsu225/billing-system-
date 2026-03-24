<?php

namespace App\Infrastructure;

use App\Domain\TenantContext;

class BaseRepository
{
    protected function getTenantId(): string
    {
        $tenantId = TenantContext::getTenantId();

        if (!$tenantId) {
            die("Tenant not set");
        }

        return $tenantId;
    }
}