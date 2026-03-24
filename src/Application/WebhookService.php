<?php

namespace App\Application;

use App\Infrastructure\Database;

class WebhookService
{
    public function send($url, $payload)
    {
        $secret = "secret_key";

        $signature = hash_hmac('sha256', json_encode($payload), $secret);

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "X-Signature: $signature",
            "Content-Type: application/json"
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        $status = $response ? 'success' : 'failed';

        curl_close($ch);

        // log store karo
        $db = Database::getConnection();

        $stmt = $db->prepare("
            INSERT INTO webhook_logs (endpoint_url, payload, status, attempts)
            VALUES (?, ?, ?, ?)
        ");

        $stmt->execute([$url, json_encode($payload), $status, 1]);
    }
}