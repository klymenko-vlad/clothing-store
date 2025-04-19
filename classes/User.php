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

    public function register($email, $password, $firstname, $lastname, $phone, $role = 1): bool
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email OR phone = :phone");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();
        $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) {
            return false;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare("INSERT INTO users (email, password, role, first_name, last_name, phone) VALUES (:email, :password, :role, :first_name, :last_name, :phone)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':first_name', $firstname);
        $stmt->bindParam(':last_name', $lastname);
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();

        $userId = $this->conn->lastInsertId();

        $sessionToken = bin2hex(random_bytes(32));

        $stmt = $this->conn->prepare("UPDATE users SET session_token = :session_token WHERE iduser = :iduser");
        $stmt->bindParam(':session_token', $sessionToken);
        $stmt->bindParam(':iduser', $userId);
        $stmt->execute();

        $stmt = $this->conn->prepare("SELECT iduser, role FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return true;
    }

    public function login($email, $password): bool
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
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
        $stmt = $this->conn->prepare("UPDATE users SET session_token = :session_token WHERE iduser = :iduser");
        $stmt->bindParam(':session_token', $sessionToken);
        $stmt->bindParam(':iduser', $user['iduser']);
        $stmt->execute();

        $_SESSION['user'] = [
            'email' => $user['email'],
            'role' => $user['role'],
        ];

        return true;
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->conn->prepare("SELECT iduser, email, role, first_name, last_name, phone FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($email, $role, $firstname, $lastname, $phone): bool
    {
        $user = $this->getUserByEmail($_SESSION['user']['email']);

        if (!$user) {
            return false;
        }

        $stmt = $this->conn->prepare("UPDATE users SET email = :email, role = :role, first_name = :first_name, last_name = :last_name, phone = :phone WHERE iduser = :iduser");
        $stmt->execute(['email' => $email, 'role' => $role, 'first_name' => $firstname, 'last_name' => $lastname, 'phone' => $phone, 'iduser' => $user['iduser']]);

        $sessionToken = bin2hex(random_bytes(32));
        $stmt = $this->conn->prepare("UPDATE users SET session_token = :session_token WHERE iduser = :iduser");
        $stmt->bindParam(':session_token', $sessionToken);
        $stmt->bindParam(':iduser', $user['iduser']);
        $stmt->execute();

        return true;
    }


    function deleteUserByEmail($email): void
    {
        $email = $_SESSION['user']['email'];
        $user = $this->getUserByEmail($email);

        if (!isset($user)) {
            header('Location: login.php');
            session_destroy();
            exit;
        }

        $stmt = $this->conn->prepare("DELETE FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

    }



}
