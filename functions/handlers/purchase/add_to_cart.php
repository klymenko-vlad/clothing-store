<?php

session_start();

require_once __DIR__ . '/../../../classes/Order.php';
require_once __DIR__ . '/../../../classes/User.php';

use Orders\Order;
use Users\User;

$userModel = new User();
$user = $userModel->getUserByEmail($_SESSION['user']['email']);

$productId = $_POST['product_id'] ?? null;

$userId = $user['iduser'];
$quantity = 1;

if (!$productId) {
    die("Product ID missing");
}

try {
    $order = new Order();
    $order->addProductToOrder($userId, $productId, $quantity);

    header("Location: /phpproj/me.php");
    exit();
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
