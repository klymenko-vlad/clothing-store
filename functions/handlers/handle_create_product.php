<?php
session_start();


require_once __DIR__ . '/../../classes/User.php';
require_once __DIR__ . "/../../classes/Product.php";

use Users\User;
use Products\Product;

if (!isset($_SESSION['user'])) {
    header('Location: ../../login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product = new Product();
    $title = $_POST['title'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $categories = $_POST['categories'];

    $userInstance = new User();
    $user = $userInstance->getUserByEmail($_SESSION['user']['email']);

    $product->createProduct($title, $price, $description, $user['iduser'], $categories);

    header('Location: ../product.php');
}