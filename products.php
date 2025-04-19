<!DOCTYPE html>
<html lang="en">
<style>
    .filters ul {
        display: flex;
        overflow-x: auto;
        list-style: none;
        padding: 0;
        margin: 0;
        gap: 1rem;
        scrollbar-width: thin;
    }

    .filters ul a {
        white-space: nowrap;
        padding: 8px 16px;
        background: #f8f9fa;
        border-radius: 20px;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .filters ul li a {
        color: red;
    }

    .filters ul a:hover,
    .filters ul a.active {
        background-color: #bdbdbd;
        color: white;
    }
</style>

<body>


<?php
$pageTitle = "Products";

include('./layout/header.php');
?>

<?php
require_once __DIR__ . '/classes/Product.php';
require_once __DIR__ . '/classes/Category.php';

require_once __DIR__ . '/functions/item_display.php';

use Products\Product;
use Categories\Category;

$productModel = new Product();
$categoryId = $_GET['category'] ?? null;

if ($categoryId) {
    $products = $productModel->getProductsByCategory($categoryId);
} else {
    $products = $productModel->getProducts(10);
}

$categoryModel = new Category();
$categories = $categoryModel->getCategories();
?>

<!-- Page Content -->
<div class="page-heading products-heading header-text">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-content">
                    <h4>new arrivals</h4>
                    <h2>sixteen products</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="products">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="filters mt-4">
                    <ul>
                        <a class="<?= !isset($_GET['category']) ? 'active' : '' ?>" href="products.php">All Products</a>
                        <?php foreach ($categories as $category): ?>
                            <a class="<?= (isset($_GET['category']) && $_GET['category'] == $category['idcategory']) ? 'active' : '' ?>"
                               href="products.php?category=<?= $category['idcategory'] ?>">
                                <?= htmlspecialchars($category['title']) ?>
                            </a>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <?php if (empty($products)): ?>
                <div class="col-md-12">
                    <p>No products available at the moment. Please check back later!</p>
                </div>
            <?php else: ?>
                <?php foreach ($products as $product): ?>
                    <div class="col-md-4">
                        <?php echo generateProduct(
                            $product['idproduct'],
                            $product['image'],
                            $product['title'],
                            $product['price'],
                            $product['description']
                        ); ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include('./layout/footer.php'); ?>

</body>

</html>
