<?php

namespace Categories;

require_once __DIR__ . '/../db/Database.php';

use Database;
use PDO;

class Category extends Database
{
    public function __construct ()
    {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    public function getCategories ()
    {
        $stmt = $this->conn->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}