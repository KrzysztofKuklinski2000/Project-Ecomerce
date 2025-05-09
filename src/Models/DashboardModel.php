<?php
declare(strict_types=1);
namespace App\Models;

use PDO;
use Throwable;
use Exception;

class DashboardModel extends AbstractModel {

    public function getData(string $table): array {
        try {
            $sql = "SELECT * FROM $table";
            $result = $this->conn->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }catch(Throwable $e) {
            throw new Exception("Nie udało się pobrać danych");
        }
    }

    public function getSingleElement(string $table, int $id):array {
        try {
            $sql = "SELECT * FROM $table WHERE id = $id";
            $result = $this->conn->query($sql);

            $result = $result->fetch(PDO::FETCH_ASSOC);
        }catch(Throwable $e) {
            throw new Exception("Nie udało się pobrać elementu");
        }

        if(!$result) {
            throw new Exception("Nie ma elementu o takim id");
        }

        return $result; 
    }

    public function createProduct(array $data):void {
        try {
            $imageName = null;

            if($_FILES['image'] && $_FILES['image']['error'] == 0){
                $uploadDir = 'public/images/products/';
                
                if(!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
    
                $imageName = uniqid('product_', true).'.'.pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $imagePath = $uploadDir.$imageName;
    
                if(!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                    throw new Exception("Nie udało się przesłać obrazka");
                }
            }

            $sql = "INSERT INTO products(name, description, size, price, stock, category_id, image_url, created_at) 
            VALUES(:name, :description, :size, :price, :stock, :category_id, :image_url, NOW())";

    
            $result = $this->conn->prepare($sql);
    
            $result->execute([
                ':name' => $data['name'],
                ':description' => $data['description'],
                ':size' => $data['size'],
                ':price' => $data['price'],
                ':stock' => $data['stock'],
                ':category_id' => $data['category'],
                ':image_url' => $imageName
            ]);
           }catch(Throwable $e) {
            throw new Exception("Nie udało się zaktualizować danych". $e->getMessage());
           }
    }

    public function updateProduct(array $data): void {
       try {
        $imageName = null;
        $sql = "UPDATE products SET 
        name = :name, 
        description = :description,
        size = :size,
        price = :price,
        stock = :stock,
        category_id = :category
        ";

        if($_FILES['image'] && $_FILES['image']['error'] == 0){
            $uploadDir = 'public/images/products/';
            
            if(!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $imageName = uniqid('product_', true).'.'.pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $imagePath = $uploadDir.$imageName;

            if(move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                $sql .= ", image_url = :image_url";
            }else {
                throw new Exception("Nie udało się przesłać obrazka");
            }
        }
        $sql .= " WHERE id = :id";

        $result = $this->conn->prepare($sql);

        $params = [
            ':name' => $data['name'],
            ':description' => $data['description'],
            ':size' => $data['size'],
            ':price' => $data['price'],
            ':stock' => $data['stock'],
            ':category' => $data['category'],
            ':id' => (int) $data['id'],
        ];

        if($imagePath) {
            $params[':image_url'] = $imageName;
        }

        $result->execute($params);
       }catch(Throwable $e) {
        throw new Exception("Nie udało się zaktualizować danych". $e->getMessage());
       }
    }
}