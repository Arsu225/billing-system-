<?php

namespace App\Infrastructure;

use PDO;

class InvoiceRepository extends BaseRepository
{
    public function createInvoice($id, $amount, $status, $dueDate)
    {
        $db = Database::getConnection();

        $stmt = $db->prepare("
            INSERT INTO invoices (id, tenant_id, total_amount, status, due_date)
            VALUES (?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $id,
            $this->getTenantId(),
            $amount,
            $status,
            $dueDate
        ]);
    }

    public function addItem($invoiceId, $description, $amount)
    {
        $db = Database::getConnection();

        $stmt = $db->prepare("
            INSERT INTO invoice_items (invoice_id, description, amount)
            VALUES (?, ?, ?)
        ");

        $stmt->execute([
            $invoiceId,
            $description,
            $amount
        ]);
    }
}