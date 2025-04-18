<?php
session_start();
require_once __DIR__ . '/../classes/User.php';

use Users\User;

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $userInstance = new User();
    $status = $userInstance->updateUser($userId, $email, $role);

    if ($status) {
        $_SESSION['user']['email'] = $email;
        $_SESSION['user']['role'] = $role;
        header('Location: ../me.php');
    }

    header('Location: ../me.php');
    exit;


}
