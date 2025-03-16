<?php
use DatabaseManager\DatabaseManager;
include_once __DIR__ . '/../helper/Sessions.php';
include_once __DIR__ . '/../config/database.php';
include_once __DIR__ . '/../database/interface.php';
include_once __DIR__ . '/../database/DatabaseManager.php';

class Blog implements BlogInterface
{
    private $db;
    public $title;
    public $content;
    public $image;
    public $user_id;

    public function __construct()
    {
        $this->db = DatabaseManager::getConnection();
    }

    private function BlogValidation($title, $content, $image)
    {
    

        if (empty($title) || strlen($title) > 255) {
            Sessions::set('errors',"title must be less than 255 charactr");
        }

        if (empty($content)) {
            Sessions::set('errors',"this feild is required");

        }

        if ($image) {
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $imageExtension = pathinfo($image, PATHINFO_EXTENSION);
            if (!in_array(strtolower($imageExtension), $allowedExtensions)) {
            Sessions::set('errors',"this extension is not supported");

            }
        }

       
    }

    public function create()
    {
        $session = $this->BlogValidation($this->title, $this->content, $this->image);
        if (!empty($session)){
            return $session;
        }

        try {
            $sql = "INSERT INTO posts (title, content, image, user_id) VALUES (:title, :content, :image, :user_id)";
            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':content', $this->content);
            $stmt->bindParam(':image', $this->image);
            $stmt->bindParam(':user_id', $this->user_id);

            return $stmt->execute();
        } catch (PDOException $e) {
            return ["post desnot add". $e->getMessage()];
        }
    }

    public function read()
    {
        try {
            $sql = "SELECT * FROM posts ORDER BY created_at DESC";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return  $e->getMessage();
        }
    }

    public function update($id)
    {
        $session = $this->BlogValidation($this->title, $this->content, $this->image);
        if (!empty($session)){
            return $session;
        }

        try {
            $sql = "UPDATE posts SET title = :title, content = :content, image = :image WHERE id = :id";
            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':content', $this->content);
            $stmt->bindParam(':image', $this->image);
            $stmt->bindParam(':id', $id);

            return $stmt->execute();
        } catch (PDOException $e) {
            return [" update error " . $e->getMessage()];
        }
    }

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM posts WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);

            return $stmt->execute();
        } catch (PDOException $e) {
            return ["post does not delete" . $e->getMessage()];
        }
    }
}













?>