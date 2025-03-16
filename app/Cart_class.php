<?php

use DatabaseManager\DatabaseManager;

include_once __DIR__ . '\..\config\database.php';
include_once __DIR__ . '\..\database\interface.php';
include_once __DIR__ . '\..\database\DatabaseManager.php';

class Cart implements cartInterface
{
    private $db;

    public function __construct()
    {
        $this->db = DatabaseManager::getConnection();
    }

    private function CartValidation($user_id, $product_id, $quantity = 1)
    {
        if (!is_numeric($user_id) || ($user_id <= 0)) {
            return "This user is not found.";
        }
        if (!is_numeric($product_id) || ($product_id <= 0)) {
            return "Invalid product.";
        }
        if (!is_numeric($quantity) || ($quantity < 1)) {
            return "You can add one or more products only.";
        }
        return true;
    }

    public function create($user_id, $product_id, $quantity)
    {
        $validation = $this->CartValidation($user_id, $product_id, $quantity);
        if ($validation !== true) {
            return $validation;
        }

        $sql = "SELECT * FROM carts WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id]);
        $item = $stmt->fetch();

        if ($item) {

            $sql = "UPDATE carts SET quantity = quantity + :quantity WHERE product_id = :product_id AND user_id = :user_id";
            $stmt = $this->db->prepare($sql);
            $success = $stmt->execute([
                'quantity' => $quantity,
                'product_id' => $product_id,
                'user_id' => $user_id
            ]);
        } else {
            $sql = "INSERT INTO carts (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)";
            $stmt = $this->db->prepare($sql);
            $success = $stmt->execute([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'quantity' => $quantity
            ]);
        }

        return $success ? "Product added successfully!" : "Oops! Please try to add the product again.";
    }

    public function read($user_id)
    {
        if (!is_numeric($user_id) || ($user_id <= 0)) {
            return "Invalid user.";
        }

        $sql = "SELECT carts.product_id, carts.quantity, products.name, products.price, products.image 
                FROM carts 
                INNER JOIN products ON carts.product_id = products.id 
                WHERE carts.user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);
        $items = $stmt->fetchAll();

        return $items ? $items : "No items in the cart.";
    }

    public function update($user_id, $product_id, $quantity)
    {
        $validation = $this->CartValidation($user_id, $product_id, $quantity);
        if ($validation !== true) {
            return $validation;
        }

        $sql = "UPDATE carts SET quantity = :quantity WHERE product_id = :product_id AND user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $success = $stmt->execute([
            'quantity' => $quantity,
            'product_id' => $product_id,
            'user_id' => $user_id
        ]);

        return $success ? "Cart updated successfully!" : "Failed to update the cart.";
    }

    public function delete($user_id, $product_id)
    {
        if (!is_numeric($user_id) || ($user_id <= 0)) {
            return "Invalid user.";
        }
        if (!is_numeric($product_id) || ($product_id <= 0)) {
            return "Invalid product.";
        }

        $sql = "DELETE FROM carts WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $this->db->prepare($sql);
        $success = $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id]);

        return $success ? "Item removed from the cart." : "Failed to remove the item.";
    }
}
