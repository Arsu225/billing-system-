<?php

require 'vendor/autoload.php';

use App\Application\WebhookService;

$webhook = new WebhookService();

$webhook->send(
    "https://webhook.site/test", // dummy URL
    [
        "event" => "invoice.paid",
        "amount" => 99900
    ]
);

echo "Webhook sent!";