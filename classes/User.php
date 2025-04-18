<?php

namespace Users;

require_once __DIR__ . '/../db/Database.php';

use Database;
use PDO;

class User extends Database
{

    public function __construct()
    {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    public function register($email, $password, $role = 1): bool
    {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) {
            return false;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare("INSERT INTO user (email, password, role) VALUES (:email, :password, :role)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $role);
        $stmt->execute();

        $userId = $this->conn->lastInsertId();

        $sessionToken = bin2hex(random_bytes(32));

        $stmt = $this->conn->prepare("UPDATE user SET session_token = :session_token WHERE iduser = :iduser");
        $stmt->bindParam(':session_token', $sessionToken);
        $stmt->bindParam(':iduser', $userId);
        $stmt->execute();

        return true;
    }

    public function login($email, $password): bool
    {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user['password'])) {
            return false;
        }

        $sessionToken = bin2hex(random_bytes(32));
        $stmt = $this->conn->prepare("UPDATE user SET session_token = :session_token WHERE iduser = :iduser");
        $stmt->bindParam(':session_token', $sessionToken);
        $stmt->bindParam(':iduser', $user['iduser']);
        $stmt->execute();

        $_SESSION['user'] = [
            'id' => $user['iduser'],
            'email' => $user['email'],
            'role' => $user['role'],
            'session_token' => $sessionToken
        ];

        return true;
    }

}
