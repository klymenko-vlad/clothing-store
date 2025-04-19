<?php
session_start();
require_once __DIR__ . '/../classes/User.php';

use Users\User;

$user = new User();

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$res = $user->login($email, $password);

if (!$res) {
    header("Location: ../login.php?error=1");
    exit();
}

header("Location: ../me.php");
exit();



