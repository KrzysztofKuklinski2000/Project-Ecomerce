<?php 
declare(strict_types=1);

namespace App\Models;

use PDO;
use Throwable;
use PDOException;
use Exception;

class UserModel extends AbstractModel {
    public function create(array $data):void {
        try {
            $userName = $this->conn->quote($data['userName']);
            $email = $this->conn->quote($data['email']);
            $password = $data['password'];
            
            $sql = "INSERT INTO users(name, email, password) 
                    VALUES($userName, $email, '$password')";

            $this->conn->exec($sql);
        }catch(Throwable $e) {
            throw new Exception("Nie udało się utworzyć uzytkownika");
        }
    }
}