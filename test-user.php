<?php

require 'vendor/autoload.php';

use App\Http\TenantResolver;
use App\Infrastructure\UserRepository;

// simulate tenant
$_SERVER['HTTP_X_TENANT_ID'] = 'tenant_1';

TenantResolver::resolve();

$userRepo = new UserRepository();

$users = $userRepo->getAllUsers();

print_r($users);