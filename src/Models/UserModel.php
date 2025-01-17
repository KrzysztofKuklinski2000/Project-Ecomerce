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

    public function GetUserCart(int $userId): array {
        try {
            $sql = "SELECT SUM(cart.quantity * products.price) AS total_amount,
                    products.id AS productId, products.name AS productName, products.price AS productPrice, products.stock AS productStock, products.image_url AS productImageUrl, products.size AS productSize,
                    users.id AS userId, users.name AS userName, users.email AS userEmail,
                    cart.id,
                    cart.quantity
                    FROM cart
                    INNER JOIN products ON cart.product_id = products.id
                    INNER JOIN users ON cart.user_id = users.id
                    WHERE cart.user_id = $userId
                    GROUP BY 
                        products.id, 
                        products.name, 
                        products.price, 
                        products.stock, 
                        products.image_url, 
                        products.size, 
                        users.id, 
                        users.name, 
                        users.email, 
                        cart.id, 
                        cart.quantity
                    ";
                    
            $result = $this->conn->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        
        }catch(Throwable $e) {
            throw new Exception("Nie udało się pobrać koszyka");
        }
    }

    public function AddProductToCart(array $cartData): void {
        try {

            $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES('$cartData[userId]', '$cartData[productId]', '$cartData[quantity]')";
            $this->conn->exec($sql);
        }catch(Throwable $e) {
            throw new Exception("Nie udało się dodać produktu do koszyka"); 
        }
    }

    public function DeleteProductFromCart(int $cartId): void {
        try {

            $sql = "DELETE FROM cart WHERE id = $cartId";
            $this->conn->exec($sql);

        }catch(Throwable $e) {
            throw new Exception("Nie udało się usunąć elementu z koszyka");
        }
    }

    public function AddAddress(array $data): string {
        try {
            $city = $this->conn->quote($data['city']);
            $street = $this->conn->quote($data['street']);
            $postal_code = $this->conn->quote($data['postal_code']);
            $building_number = $this->conn->quote($data['building_number']);
            $firstname = $this->conn->quote($data['firstname']);
            $lastname = $this->conn->quote($data['lastname']);
            

            $sql = "INSERT INTO adress(city, street, postal_code, building_number, firstname, lastname, user_id) VALUES($city, $street, $postal_code, $building_number, $firstname, $lastname, '$data[userId]')";
            $this->conn->exec($sql);
            return $this->conn->lastInsertId();
        }catch(Throwable $e) {
            throw new Exception("Nie udało się dodać adresu");
        }
    }

    public function CreateOrder(array $data): string {
        try {
            $sql = "INSERT INTO orders(user_id, total_price, address_id) VALUES('$data[userId]', '$data[total_amount]', '$data[addressId]')";
            $this->conn->exec($sql);
            return $this->conn->lastInsertId();
        }catch(Throwable $e) {
            throw new Exception("Nie udało się utworzyć zamównienia");
        }
    }

    public function AddProductsToOrder(array $data, int $orderId): void {
        try {
            $sql = "INSERT INTO order_items(order_id, product_id, quantity, price) VALUES";

            foreach($data as $product) {
                $sql .= "('$orderId', '$product[productId]', '$product[quantity]', '$product[productPrice]'),";
            }
            $sql = substr($sql, 0, -1);
            $this->conn->exec($sql);
        }catch(Throwable $e) {
            throw new Exception("Nie udało się dodać produktów do zamówienia");
        } 
    }

    public function updatePaymentStatus(int $orderId, string $status): void {
        try {
            $sql = "UPDATE orders set payment_status = '$status' WHERE id = '$orderId'";
            $this->conn->exec($sql);
        }catch(Throwable $e) {
            throw new Exception("Nie udało się zaktualizować");
        }
    }
}