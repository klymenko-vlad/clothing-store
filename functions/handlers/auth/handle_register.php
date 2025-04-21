<?php

session_start();
require_once __DIR__ . '/../../../classes/User.php';

use Users\User;

$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];
$role = $_POST['role'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$phone = $_POST['phone'];

if ($password !== $confirmPassword) {
    die("Passwords do not match.");
}

$userModel = new User();
$success = $userModel->register($email, $password, $first_name, $last_name, $phone, $role);

if ($success) {
    $_SESSION['user'] = [
        'email' => $email,
        'role' => $role,
    ];

    header("Location: ../index.php");
    exit;
} else {
    die("User already exists.");
}

?>
