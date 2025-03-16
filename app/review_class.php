
<?php

use DatabaseManager\DatabaseManager;

include_once __DIR__ . '\..\config\database.php';
include_once __DIR__ . '\..\database\interface.php';
include_once __DIR__ . '\..\database\DatabaseManager.php';

class Reviews implements reviewInterface
{
    public $db;
    public $comments;
    public $rate;
    public $user_id;
    public $product_id;
    public function __construct()
    {
        return $this->db = DatabaseManager::getConnection();
    }
    public function addReview($comments, $user_id, $product_id)
    {
        $productId = (int)$product_id;

        $q = "INSERT INTO reviews (comments,user_id,product_id) 
        VALUES (:comments,:user_id,:product_id)";

        $sql = $this->db->prepare($q);
        $sql->execute(
            [
                'comments' => $comments,
                'user_id' => $user_id,
                'product_id' => $product_id
            ]
        );
    }
    public function showReviews($id)
    {
        $q = "SELECT * FROM reviews where product_id=:id";
        $sql = $this->db->prepare($q);
        $sql->execute(
            [
                'id' =>  $id
            ]
        );
        $reviews = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $reviews;
    }
    public function allReviews()
    {
        $q = "SELECT * FROM reviews ";
        $sql = $this->db->prepare($q);
        $sql->execute();
        $reviews = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $reviews;
    }
}
