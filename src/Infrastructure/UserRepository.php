<?php

namespace App\Infrastructure;

use PDO;

class UserRepository extends BaseRepository
{
    public function getAllUsers()
    {
        $db = Database::getConnection();

        $stmt = $db->prepare("SELECT * FROM users WHERE tenant_id = ?");
        $stmt->execute([$this->getTenantId()]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}