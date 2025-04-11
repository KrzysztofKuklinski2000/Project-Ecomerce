<?php
declare(strict_types=1);
namespace App\Models;

use PDO;
use Throwable;
use PDOException;
use Exception;

class DashboardModel extends AbstractModel {

    public function getData(string $table): array {
        try {
            $sql = "SELECT * FROM $table";
            $result = $this->conn->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }catch(Throwable $e) {
            throw new Exception("Nie udało się pobrać uzytkowników");
        }
    }
}