<?php
session_start();
require_once __DIR__ . '/../../../classes/Review.php';

use Reviews\Review;


if (!isset($_SESSION['user'])) {
    header('Location: ../../login.php');
    exit;
}

$productId = $_POST['product_id'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];
$email = $_SESSION['user']['email'];

error_log($rating);
error_log($comment);
error_log($email);
error_log($productId);

if ($productId && $rating && $comment) {
    $reviewModel = new Review();
    $reviewModel->addReview($productId, $email, $rating, $comment);
}

header("Location: ../../product.php?id=$productId");
exit;
