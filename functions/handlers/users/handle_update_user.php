<?php
session_start();
require_once __DIR__ . '/../../../classes/User.php';

use Users\User;

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $role = $_POST['role'];
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $phone = $_POST['phone'];

    $userInstance = new User();
    $status = $userInstance->updateUser($email, $role, $first_name, $last_name, $phone);

    $_SESSION['user']['email'] = $email;
    $_SESSION['user']['role'] = $role;

    header('Location: /phpproj/me.php');
    exit;
}
