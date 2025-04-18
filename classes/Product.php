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
        $stmt = $this->conn->prepare('SELECT * FROM products LIMIT :limit OFFSET :offset');
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getProduct($id)
    {
        $stmt = $this->conn->prepare('SELECT * FROM products WHERE idproduct = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function createProduct($title, $price, $description, $iduser): bool
    {
        $stmt = $this->conn->prepare('INSERT INTO products (title, price, description, seller_iduser) VALUES (:title, :price, :description, :seller_iduser)');
        $stmt->execute([':title' => $title, ':price' => $price, ':description' => $description, ':seller_iduser' => $iduser]);
        return true;
    }
}