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


    public function getProducts($limit = 20)
    {
        $stmt = $this->conn->prepare('SELECT * FROM product LIMIT :limit');
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getProduct($id)
    {
        $stmt = $this->conn->prepare('SELECT * FROM product WHERE idproduct = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function createProduct($title, $price)
    {
        $stmt = $this->conn->prepare('INSERT INTO product (title, price) VALUES (:title, :price)');
        $stmt->execute([':title' => $title, ':price' => $price]);
    }
}