<?php
session_start();

require_once __DIR__ . '/../../classes/User.php';

use Users\User;

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();

    $user->deleteUserByEmail($_SESSION['user']['email']);
    session_destroy();
    header('Location: /../index.php');

    exit;
}











