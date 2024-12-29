<?php
declare(strict_types=1);
namespace App\Models;

use PDO;
use Throwable;
use PDOException;
use Exception;


class Model {
    protected PDO $conn;

    public function __construct(array $config) {
        try{
            $dns = "mysql:dbname={$config['database']};host={$config['host']}";
            $this->conn = new PDO($dns, $config['user'], $config['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        }catch(PDOException $e) {
            throw new Exception("Błąd połączenia z baza danych");
        }
    }

    public function GetProducts(): array {
        try {
            $sql = "SELECT * FROM products";
            $result = $this->conn->query($sql);

            return $result->fetchAll(PDO::FETCH_ASSOC);
        }catch(Throwable $e) {
            throw new Exception("Nie udało się pobrać listy produktów.", 400, $e);
        } 
    }
}