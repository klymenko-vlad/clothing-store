<?php
session_start();


require_once __DIR__ . '/../../../classes/User.php';
require_once __DIR__ . "/../../../classes/Product.php";
$cloudinary = require __DIR__ . '/../../../db/cloudinary_upload.php';

use Users\User;
use Products\Product;

if (!isset($_SESSION['user'])) {
    header('Location: /phpproj/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product = new Product();
    $title = $_POST['title'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $categories = $_POST['categories'];

    $imageUrl = null;

    if (isset($_FILES['image']) && $_FILES['image']['tmp_name'] !== '') {
        $upload = $cloudinary->uploadApi()->upload($_FILES['image']['tmp_name']);
        $imageUrl = $upload['secure_url'];

    }

    $userInstance = new User();
    $user = $userInstance->getUserByEmail($_SESSION['user']['email']);

    $product->createProduct($title, $price, $description, $user['iduser'], $categories, $imageUrl);


    header('Location: /phpproj/product.php');
}