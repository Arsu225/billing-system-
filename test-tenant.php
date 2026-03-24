<?php

require 'vendor/autoload.php';

use App\Domain\TenantContext;

TenantContext::setTenantId("tenant_1");

echo TenantContext::getTenantId();