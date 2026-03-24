<?php

require 'vendor/autoload.php';

use App\Http\TenantResolver;
use App\Domain\TenantContext;

// simulate request header
$_SERVER['HTTP_X_TENANT_ID'] = 'tenant_999';

TenantResolver::resolve();

echo TenantContext::getTenantId();