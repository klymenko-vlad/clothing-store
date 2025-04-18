<?php

$config = require __DIR__ . '/../db/config.php';

class Database
{
    protected $conn;


    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        $config = DATABASE;

        $options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->conn = new PDO(
                'mysql:host=' . $config['HOST'] . ';port=' . $config['PORT'] . ';dbname=' . $config['DBNAME'],
                $config['USERNAME'],
                $config['PASSWORD'],
                $options
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
