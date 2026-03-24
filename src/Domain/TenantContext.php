<?php

namespace App\Domain;

class TenantContext
{
    private static ?string $tenantId = null;

    public static function setTenantId(string $tenantId): void
    {
        self::$tenantId = $tenantId;
    }

    public static function getTenantId(): ?string
    {
        return self::$tenantId;
    }
}