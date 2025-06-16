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
        try {
            $orderQuery = "SELECT o.total_price, o.status, o.created_at, o.payment_status, o.id as orderId , u.id as userId, u.name, u.email, a.* 
                FROM orders o 
                JOIN users u ON o.user_id = u.id
                JOIN adress a ON o.address_id = a.id
                WHERE o.id = :order_id";
        
            $orderDetailsQuery = "SELECT oi.id as orderItemId, oi.quantity, oi.price, p.name, p.image_url, p.size, p.id
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
                    'id' => $orderResult['orderId'],
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

        }catch(Throwable $e) {
            throw new Exception("Nie udało się pobrać zamówienia");
        }
    }

    public function updateOrder(array $data): void {
        try {
            $this->conn->beginTransaction();

            $sql = "UPDATE adress 
            SET firstname = :firstname,
                lastname = :lastname,
                street = :street,
                city = :city,
                building_number = :building_number,
                postal_code = :postal_code
                WHERE id = :id
            ";
            $result = $this->conn->prepare($sql);
            $result->execute([
                ':firstname' => $data['address']['firstname'],
                ':lastname' => $data['address']['lastname'],
                ':street' => $data['address']['street'],
                ':city' => $data['address']['city'],
                ':building_number' => $data['address']['building_number'],
                ':postal_code' => $data['address']['postal_code'],
                ':id' => $data['address']['id'],
            ]);

            foreach($data['order_items']['quantity'] as $productId => $quantity) {
                $sql = "UPDATE order_items 
                        SET quantity = :quantity 
                        WHERE order_id = :order_id AND product_id = :product_id";

                $result = $this->conn->prepare($sql);
                $result->execute([
                    ':quantity' => (int) $quantity,
                    ':product_id' => (int) $productId,
                    ':order_id' => (int) $data['order']['id']
                ]);
            }

            $totalPrice = $this->countTotalPrice($data['order_items']['quantity']);
            $sql = "UPDATE orders 
                    SET status = :status, payment_status = :payment_status, total_price = :totalPrice
                    WHERE id = :order_id";
            $result = $this->conn->prepare($sql);
            $result->execute([
                ':payment_status' => $data['order']['payment_status'],
                ':status' => $data['order']['status'],
                ':totalPrice' => $totalPrice,
                ':order_id' => (int) $data['order']['id']
            ]);
            $this->conn->commit();
        }catch(Throwable $e) {
            $this->conn->rollBack();
            throw new Exception("Nie udało się zaktualizować danych".$e->getMessage());
        }
    }

    public function deleteOrder(int $id):void {
        try {
            $this->conn->beginTransaction();
                $result = $this->conn->prepare("DELETE FROM order_items WHERE order_id = :orderId");
                $result->execute([':orderId' => $id]);

                $result = $this->conn->prepare("SELECT address_id FROM orders WHERE id = :orderId");
                $result->execute([':orderId' => $id]);
                $addressId = $result->fetchColumn(); 

                $result = $this->conn->prepare("DELETE FROM orders WHERE id = :orderId LIMIT 1");
                $result->execute([':orderId' => $id]);

                $result = $this->conn->prepare("DELETE FROM adress WHERE id = :addressId LIMIT 1");
                $result->execute([':addressId' => $addressId]);

            $this->conn->commit();
        }catch(Throwable $e) {
            $this->conn->rollBack();
            throw new Exception("Nie udało się usunąć zamówienia");
        }
    }

    public function deleteProductFromOrder(int $id):void {
        try {
            $this->conn->beginTransaction();

            $result = $this->conn->prepare("SELECT order_id, price, quantity FROM order_items WHERE id = :orderProduct");
            $result->execute([":orderProduct" => $id]);
            $product = $result->fetch(PDO::FETCH_ASSOC);

            if(!$product){
                throw new Exception("Produktu nie ma w zamówieniu ");
            }

            $totalPriceOfProducts = (float) $product['price'] * (int) $product['quantity'];
            
            $result = $this->conn->prepare("SELECT total_price FROM orders WHERE id = :orderId");
            $result->execute([":orderId" => $product['order_id']]);
            $totalPriceOfOrder = $result->fetchColumn();

            if(!$totalPriceOfOrder) {
                throw new Exception("Zamówienie nie istnieje");
            }

            $newTotalPriceOfOrder = max(0, (float) ($totalPriceOfOrder - $totalPriceOfProducts));

            $result = $this->conn->prepare("UPDATE orders SET total_price = :newPrice WHERE id = :orderId");
            $result->execute([
                ":newPrice" => $newTotalPriceOfOrder, 
                ":orderId" => $product['order_id'],
            ]);

            $result = $this->conn->prepare("DELETE FROM order_items WHERE id = :orderProductId");
            $result->execute([':orderProductId' => $id]);
            
            $this->conn->commit();
        }catch(Throwable $e) {
            $this->conn->rollBack();
            throw new Exception("Nie udało się usunąć produktu z zamówienia");
        } 
    }

    public function createCategory(string $name): void {
        try {
            $result = $this->conn->prepare("INSERT INTO categories (name) VALUES(:name)");
            $result->execute([":name" => $name]);
        }catch(Throwable $e) {
            throw new Exception("Nie udało się utworzyć nowej kategorii");
        }
    }

    public function deleteCategory(int $id):void {
        try {
            $result = $this->conn->prepare("DELETE FROM categories WHERE id = ?");
            $result->execute([$id]);
        }catch(Throwable $e) {
            throw new Exception("Nie udało się usunąć kategorii");
        }
    }

    public function hasProductsInCategory(int $id): bool {
        try{
            $result = $this->conn->prepare("SELECT COUNT(*) FROM products WHERE category_id = ? ");
            $result->execute([$id]);
            $count =  (int) $result->fetchColumn();
            return $count === 0 ? false: true;
        }catch(Throwable $e){
            throw new Exception("Nie udało się pobrać danych");
        }
    }

    private function countTotalPrice(array $data): float {
        $productIds = array_keys($data);
        $placeholders = implode(',', array_fill(0, count($productIds), '?'));
        
        $sql = "SELECT id, price FROM products WHERE id IN ($placeholders)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($productIds);
        $pricesFromDb = $stmt->fetchAll(PDO::FETCH_KEY_PAIR); // [id => price]

        $totalPrice = 0;

        foreach ($data as $productId => $quantity) {
            if (!isset($pricesFromDb[$productId])) {
                throw new Exception("Produkt $productId nie istnieje w bazie.");
            }
            $price = $pricesFromDb[$productId];
            $totalPrice += $quantity * $price;
        }

        return $totalPrice;
    }
}