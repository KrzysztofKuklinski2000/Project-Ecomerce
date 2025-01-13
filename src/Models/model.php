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

    public function GetProducts(?string $category): array {
        try {
            $sql = "";
            if(in_array($category, ['okna_aluminiowe', 'okna_pcv', 'okna_drewniane']) ){
                $sql = "SELECT products.*, categories.name AS categoryName 
                FROM products
                LEFT JOIN categories ON products.category_id = categories.id
                WHERE categories.name = '$category'";
            } else {
                $sql = "SELECT * FROM products";
            }
            
            $result = $this->conn->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }catch(Throwable $e) {
            throw new Exception("Nie udało się pobrać listy produktów.", 400, $e);
        } 
    }

    public function GetProductDetails(int $id): array {
        try {
            $sql = "SELECT products.id, products.name, products.image_url, products.size, products.description, products.price,products.stock, categories.name AS categoryName
            FROM products 
            LEFT JOIN categories ON products.category_id = categories.id
            WHERE products.id = $id";
            $result = $this->conn->query($sql);

            return $result->fetch(PDO::FETCH_ASSOC);
        }catch(Throwable $e) {
            throw new Exception("Nie udało się pobrać produktu", 400, $e);
        }
    }
}