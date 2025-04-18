<?php
use Products\Product;

require_once './classes/Product.php';
require_once './db/Database.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die('Product ID not specified');
}

$productModel = new Product();
$productData = $productModel->getProduct($id);

if (!$productData) {
    die('Product not found');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
          rel="stylesheet">

    <title>Sixteen Clothing HTML Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--

    TemplateMo 546 Sixteen Clothing

    https://templatemo.com/tm-546-sixteen-clothing

    -->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="assets/css/owl.css">

</head>

<body>



<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('./layout/header.php');
?>

<div class="pt-5">
    <div class="container pt-5 ">
        <div class="row align-items-center ">
            <div class="col-md-6 text-center">
                <img height="400" src="<?= htmlspecialchars($productData['image'] ?? 'assets/images/default.jpg') ?>"
                     alt="<?= htmlspecialchars($productData['title']) ?>" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h2><?= htmlspecialchars($productData['title']) ?></h2>
                <h4 class="text-success">$<?= number_format($productData['price'], 2) ?></h4>
                <p><?= htmlspecialchars($productData['description'] ?? 'No description available.') ?></p>
                <ul class="stars d-flex p-0 m-0" style="list-style: none; gap: 4px;">
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                </ul>
                <span>Reviews (<?= rand(5, 100) ?>)</span>
                <br><br>
                <a href="products.php" class="filled-button">Back to Products</a>
            </div>
        </div>
    </div>
</div>

<?php include('./layout/footer.php'); ?>

<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
