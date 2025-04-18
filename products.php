<!DOCTYPE html>
<html lang="en">
<body>


<?php
$pageTitle = "Products";

include('./layout/header.php');
?>

<?php
require_once __DIR__ . '/classes/Product.php';
require_once __DIR__ . '/functions/item_display.php';

use Products\Product;

$productModel = new Product();
$products = $productModel->getProducts(10);
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
                <div class="filters">
                    <ul>
                        <li class="active">All Products</li>
                        <li>Featured</li>
                        <li>Flash Deals</li>
                        <li>Last Minute</li>
                    </ul>
                </div>
            </div>
            <!--            <div class="col-md-12">-->
            <!--                <div class="filters-content">-->
            <!--                    <div class="row grid">-->
            <!--                        <div class="col-lg-4 col-md-4 all des">-->
            <!--                            <div class="product-item">-->
            <!--                                <a href="#"><img src="assets/images/product_01.jpg" alt=""></a>-->
            <!--                                <div class="down-content">-->
            <!--                                    <a href="#"><h4>Tittle goes here</h4></a>-->
            <!--                                    <h6>$18.25</h6>-->
            <!--                                    <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla-->
            <!--                                        aspernatur.</p>-->
            <!--                                    <ul class="stars">-->
            <!--                                        <li><i class="fa fa-star"></i></li>-->
            <!--                                        <li><i class="fa fa-star"></i></li>-->
            <!--                                        <li><i class="fa fa-star"></i></li>-->
            <!--                                        <li><i class="fa fa-star"></i></li>-->
            <!--                                        <li><i class="fa fa-star"></i></li>-->
            <!--                                    </ul>-->
            <!--                                    <span>Reviews (12)</span>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                        <div class="col-lg-4 col-md-4 all dev">-->
            <!--                            <div class="product-item">-->
            <!--                                <a href="#"><img src="assets/images/product_02.jpg" alt=""></a>-->
            <!--                                <div class="down-content">-->
            <!--                                    <a href="#"><h4>Tittle goes here</h4></a>-->
            <!--                                    <h6>$16.75</h6>-->
            <!--                                    <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla-->
            <!--                                        aspernatur.</p>-->
            <!--                                    <ul class="stars">-->
            <!--                                        <li><i class="fa fa-star"></i></li>-->
            <!--                                        <li><i class="fa fa-star"></i></li>-->
            <!--                                        <li><i class="fa fa-star"></i></li>-->
            <!--                                        <li><i class="fa fa-star"></i></li>-->
            <!--                                        <li><i class="fa fa-star"></i></li>-->
            <!--                                    </ul>-->
            <!--                                    <span>Reviews (24)</span>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                        <div class="col-lg-4 col-md-4 all gra">-->
            <!--                            <div class="product-item">-->
            <!--                                <a href="#"><img src="assets/images/product_03.jpg" alt=""></a>-->
            <!--                                <div class="down-content">-->
            <!--                                    <a href="#"><h4>Tittle goes here</h4></a>-->
            <!--                                    <h6>$32.50</h6>-->
            <!--                                    <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla-->
            <!--                                        aspernatur.</p>-->
            <!--                                    <ul class="stars">-->
            <!--                                        <li><i class="fa fa-star"></i></li>-->
            <!--                                        <li><i class="fa fa-star"></i></li>-->
            <!--                                        <li><i class="fa fa-star"></i></li>-->
            <!--                                        <li><i class="fa fa-star"></i></li>-->
            <!--                                        <li><i class="fa fa-star"></i></li>-->
            <!--                                    </ul>-->
            <!--                                    <span>Reviews (36)</span>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                        <div class="col-lg-4 col-md-4 all gra">-->
            <!--                            <div class="product-item">-->
            <!--                                <a href="#"><img src="assets/images/product_04.jpg" alt=""></a>-->
            <!--                                <div class="down-content">-->
            <!--                                    <a href="#"><h4>Tittle goes here</h4></a>-->
            <!--                                    <h6>$24.60</h6>-->
            <!--                                    <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla-->
            <!--                                        aspernatur.</p>-->
            <!--                                    <ul class="stars">-->
            <!--                                        <li><i class="fa fa-star"></i></li>-->
            <!--                                        <li><i class="fa fa-star"></i></li>-->
            <!--                                        <li><i class="fa fa-star"></i></li>-->
            <!--                                        <li><i class="fa fa-star"></i></li>-->
            <!--                                        <li><i class="fa fa-star"></i></li>-->
            <!--                                    </ul>-->
            <!--                                    <span>Reviews (48)</span>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                        <div class="col-lg-4 col-md-4 all dev">-->
            <!--                            <div class="product-item">-->
            <!--                                <a href="#"><img src="assets/images/product_05.jpg" alt=""></a>-->
            <!--                                <div class="down-content">-->
            <!--                                    <a href="#"><h4>Tittle goes here</h4></a>-->
            <!--                                    <h6>$18.75</h6>-->
            <!--                                    <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla-->
            <!--                                        aspernatur.</p>-->
            <!--                                    <ul class="stars">-->
            <!--                                        <li><i class="fa fa-star"></i></li>-->
            <!--                                        <li><i class="fa fa-star"></i></li>-->
            <!--                                        <li><i class="fa fa-star"></i></li>-->
            <!--                                        <li><i class="fa fa-star"></i></li>-->
            <!--                                        <li><i class="fa fa-star"></i></li>-->
            <!--                                    </ul>-->
            <!--                                    <span>Reviews (60)</span>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                        <div class="col-lg-4 col-md-4 all des">-->
            <!--                            <div class="product-item">-->
            <!--                                <a href="#"><img src="assets/images/product_06.jpg" alt=""></a>-->
            <!--                                <div class="down-content">-->
            <!--                                    <a href="#"><h4>Tittle goes here</h4></a>-->
            <!--                                    <h6>$12.50</h6>-->
            <!--                                    <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla-->
            <!--                                        aspernatur.</p>-->
            <!--                                    <ul class="stars">-->
            <!--                                        <li><i class="fa fa-star"></i></li>-->
            <!--                                        <li><i class="fa fa-star"></i></li>-->
            <!--                                        <li><i class="fa fa-star"></i></li>-->
            <!--                                        <li><i class="fa fa-star"></i></li>-->
            <!--                                        <li><i class="fa fa-star"></i></li>-->
            <!--                                    </ul>-->
            <!--                                    <span>Reviews (72)</span>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
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
