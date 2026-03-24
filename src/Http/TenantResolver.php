<?php

namespace App\Http;

use App\Domain\TenantContext;

class TenantResolver
{
    public static function resolve(): void
    {
        // Header se tenant id lo
        $tenantId = $_SERVER['HTTP_X_TENANT_ID'] ?? null;

        if (!$tenantId) {
            die("Tenant not found");
        }

        TenantContext::setTenantId($tenantId);
    }
}