<?php

require 'vendor/autoload.php';

use App\Infrastructure\Database;

$db = Database::getConnection();

echo "DB Connected!";