<?php

namespace Products;

require_once __DIR__ . '/../db/Database.php';

use Database;
use PDO;

class Product extends Database
{
    public function __construct()
    {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    public function getProducts($limit = 20, $offset = 0)
    {
        $stmt = $this->conn->prepare('SELECT products.*, ROUND(AVG(reviews.rating)) AS avg_rating, COUNT(reviews.idreview) AS review_count
        FROM products
        LEFT JOIN reviews ON products.idproduct = reviews.idproduct
        GROUP BY products.idproduct
        LIMIT :limit OFFSET :offset
    ');

        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getProduct($id)
    {
        $stmt = $this->conn->prepare('
            SELECT products.*, ROUND(AVG(reviews.rating)) AS avg_rating, COUNT(reviews.idreview) AS review_count FROM products
            LEFT JOIN reviews ON reviews.idproduct = products.idproduct
            WHERE products.idproduct = :id;
        ');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function createProduct($title, $price, $description, $iduser, $categories, $imageUrl): bool
    {
        $stmt = $this->conn->prepare('INSERT INTO products (title, price, description, seller_iduser, image) VALUES (:title, :price, :description, :seller_iduser, :image)');
        $stmt->execute([':title' => $title, ':price' => $price, ':description' => $description, ':seller_iduser' => $iduser, ':image' => $imageUrl]);

        $productId = $this->conn->lastInsertId();

        foreach ($categories as $categoryId) {
            $stmt = $this->conn->prepare("INSERT INTO product_categories (idproduct, idcategory) VALUES (:productId, :categoryId)");
            $stmt->bindParam(':productId', $productId);
            $stmt->bindParam(':categoryId', $categoryId);
            $stmt->execute();
        }

        return true;
    }

    public function getProductsByCategory($categoryId)
    {
        $stmt = $this->conn->prepare(
            "SELECT p.* FROM products p
         JOIN product_categories pc ON p.idproduct = pc.idproduct
         WHERE pc.idcategory = :idcategory"
        );
        $stmt->execute([':idcategory' => $categoryId]);
        return $stmt->fetchAll();
    }
}