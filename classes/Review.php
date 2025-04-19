<?php

namespace Reviews;

require_once __DIR__ . '/../db/Database.php';
require_once __DIR__ . '/../classes/User.php';

use Users\User;

use Database;
use PDO;

class Review extends Database
{

    public function __construct()
    {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    public function addReview($productId, $email, $rating, $comment): void
    {
        $userModel = new User();
        $user = $userModel->getUserByEmail($email);

        $stmt = $this->conn->prepare('INSERT INTO reviews (idproduct, iduser, rating, comment) VALUES (:idproduct, :iduser, :rating, :comment)');
        $stmt->bindParam(':idproduct', $productId);
        $stmt->bindParam(':iduser', $user['iduser']);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':comment', $comment);
        $stmt->execute();
    }

    public function getCommentsByProduct($productId)
    {
        $stmt = $this->conn->prepare("SELECT reviews.*, first_name, last_name FROM reviews 
JOIN users ON reviews.iduser = users.iduser 
WHERE reviews.idproduct = :productId 
ORDER BY reviews.created_at DESC");
        $stmt->execute([':productId' => $productId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}