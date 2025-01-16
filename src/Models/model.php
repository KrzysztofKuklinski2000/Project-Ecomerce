<?php
declare(strict_types=1);
namespace App\Models;

use PDO;
use Throwable;
use PDOException;
use Exception;


class Model extends AbstractModel  {
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

            $product = $result->fetch(PDO::FETCH_ASSOC);
        }catch(Throwable $e) {
            throw new Exception("Nie udało się pobrać produktu", 400, $e);
        }

        if(!$product) {
            throw new Exception("Nie znaleziono produktu");
        }

        return $product;
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

}