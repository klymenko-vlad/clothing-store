<?php
require_once '../../../classes/Order.php';
use Orders\Order;

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 2) {
    header('Location: ../../../login.php');
    exit;
}

$orderId = $_POST['order_id'] ?? null;

if (!$orderId) {
    die("Invalid order ID");
}

$orderModel = new Order();
$orderModel->updateStatus($orderId, 'shipped');

header('Location: ../../../profile.php');
exit;
