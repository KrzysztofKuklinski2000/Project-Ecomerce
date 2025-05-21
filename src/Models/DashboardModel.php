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

    public function deleteProduct(int $id): void {
        try {
            $sql = "DELETE FROM products WHERE id = $id LIMIT 1";
            $this->conn->exec($sql);
        }catch(Throwable $e) {
            throw new Exception("Nie udało się usunąć notatki");
        }
    }

    public function getOrder(int $id): array {
        $orderQuery = "SELECT o.total_price, o.status, o.created_at, o.payment_status , u.id as userId, u.name, u.email, a.* 
                FROM orders o 
                JOIN users u ON o.user_id = u.id
                JOIN adress a ON o.address_id = a.id
                WHERE o.id = :order_id";
        
        $orderDetailsQuery = "SELECT oi.quantity, oi.price, p.name, p.image_url, p.size 
                FROM order_items oi
                JOIN products p ON oi.product_id = p.id
                WHERE oi.order_id = :order_id";

        $orderResult = $this->conn->prepare($orderQuery);
        $orderResult->execute([':order_id' => $id]);

        $orderDetailsResult = $this->conn->prepare($orderDetailsQuery);
        $orderDetailsResult->execute([':order_id' => $id]);

        $orderResult =  $orderResult->fetch(PDO::FETCH_ASSOC);
        $orderDetailsResult = $orderDetailsResult->fetchAll(PDO::FETCH_ASSOC);

        if(!$orderResult) throw new Exception("Nie znaleziono zamówienia");

        return [
            'order' => [
                'total_price' => $orderResult['total_price'],
                'status' => $orderResult['status'],
                'created_at' => $orderResult['created_at'],
                'payment_status' => $orderResult['payment_status'],
            ],
            'user' => [
                'id' => $orderResult['userId'],
                'name' => $orderResult['name'],
                'email' => $orderResult['email']
            ],
            'address' => [
                'id' => $orderResult['id'],
                'firstname' => $orderResult['firstname'],
                'lastname' => $orderResult['lastname'],
                'street' => $orderResult['street'],
                'city' => $orderResult['city'],
                'building_number' => $orderResult['building_number'],
                'postal_code' => $orderResult['postal_code'],
                'user_id' => $orderResult['user_id'],
            ],
            'products' => $orderDetailsResult,
        ];
    }
}