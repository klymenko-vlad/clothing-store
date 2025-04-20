<?php

use Products\Product;

require_once './classes/Product.php';
require_once './classes/Review.php';

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
<body>


<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$pageTitle = $productData['title'];

include('./layout/header.php');

$productId = $_GET['id'] ?? null;

if (!$productId) {
    die('Product ID not specified');
}

$reviewModel = new Reviews\Review();
$reviews = $reviewModel->getCommentsByProduct($productId);

?>

<div class="pt-5">
    <div class="container pt-5 ">
        <div class="row align-items-center ">
            <div class="col-md-6 text-center">
                <img height="400"
                     src="<?= htmlspecialchars($productData['image'] ?? 'assets/images/blank-product.png') ?>"
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
                <span>Reviews (<?= count($reviews) ?>)</span>
                <br><br>
                <a href="products.php" class="filled-button mb-4">Back to Products</a>
                <form action="./functions/handlers/purchase/add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($productData['idproduct']) ?>">
                    <button type="submit" class="btn btn-primary">Buy it</button>
                    <p>You can pay and complete the checkout in your profile</p>
                </form>
            </div>
        </div>

        <hr class="my-4">

        <h5>Leave a Review</h5>
        <form action="./functions/handlers/reviews/handle_add_review.php" method="POST">
            <input type="hidden" name="product_id" value="<?= htmlspecialchars($productData['idproduct']) ?>">

            <div class="form-group mb-3">
                <label for="rating">Rating:</label>
                <select name="rating" id="rating" class="form-control w-25" required>
                    <option value="">Select rating</option>
                    <?php for ($i = 5; $i >= 1; $i--): ?>
                        <option value="<?= $i ?>"><?= $i ?> star<?= $i > 1 ? 's' : '' ?></option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="comment">Your Review:</label>
                <textarea name="comment" id="comment" class="form-control" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>

        <div class="product-comments mt-5">
            <h4 class="mb-4">Customer Reviews:</h4>

            <?php if (empty($reviews)): ?>
                <p>No reviews yet. Be the first to comment!</p>
            <?php else: ?>
                <ul class="list-unstyled">
                    <?php foreach ($reviews as $review): ?>
                        <li class="media mb-4">
                            <div class="media-body">
                                <h5 class="mt-0 mb-1"><?= htmlspecialchars($review['first_name']) . " " . htmlspecialchars($review['last_name']) ?>
                                    <small>(<?= $review['rating'] ?> stars)</small></h5>
                                <p><?= htmlspecialchars($review['comment']) ?></p>
                                <small class="text-muted">Posted
                                    on <?= date('F j, Y', strtotime($review['created_at'])) ?></small>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

    </div>


</div>

<?php include('./layout/footer.php'); ?>

</body>
</html>
