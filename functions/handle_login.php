<?php
session_start();
require_once __DIR__ . '/../classes/User.php';

use Users\User;

$user = new User();

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

try {
    $user->login($email, $password);
} catch (Exception $e) {
    throw $e;
}
header("Location: ../index.php");
exit();

