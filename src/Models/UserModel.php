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
            $username = $this->conn->quote($data['username']);
            $email = $this->conn->quote($data['email']);
            $password = $data['password'];
            
            $sql = "INSERT INTO users(name, email, password) 
                    VALUES($username, $email, '$password')";
            
            $this->conn->exec($sql);
        }catch(Throwable $e) {
            throw new Exception("Nie udało się utworzyć uzytkownika");
        }
    }

    public function getUser(string $email): array {
        try {
            $Email = $this->conn->quote($email);

            $sql = "SELECT * FROM users WHERE email = $Email LIMIT 1";
            $result = $this->conn->query($sql);
            return $result->fetch(PDO::FETCH_ASSOC);
        }catch(Throwable $e) {
            throw new Exception("Nie udało się pobrać uytkownika");
        }
    }


    public function getByEmail(string $email): int {
        try {
            $Email = $this->conn->quote($email);
            $sql = "SELECT COUNT(*) AS NumberOfUsers FROM users WHERE email = $Email";
            
            
            $result = $this->conn->query($sql);
            $result = $result->fetch(PDO::FETCH_ASSOC);

            return $result['NumberOfUsers'];
        }catch(Throwable){
            throw new Exception("Nie ma takiego uzytkownika");
        }
    }
}