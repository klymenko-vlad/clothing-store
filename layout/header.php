<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use Products\Product;

$path = $_SERVER['REQUEST_URI'];
$lastPart = basename(parse_url($path, PHP_URL_PATH));
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../classes/Product.php';

try {
    $product = new Product();
} catch (Exception $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php"><h2>Sixteen <em>Clothing</em></h2></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item <?php echo $lastPart === 'index.php' ? 'active' : ''; ?>">
                        <a class="nav-link" href="index.php">Home
                        </a>
                    </li>
                    <li class="nav-item <?php echo $lastPart === 'products.php' ? 'active' : ''; ?>">
                        <a class="nav-link" href="products.php">Our Products</a>
                    </li>
                    <li class="nav-item <?php echo $lastPart === 'about.php' ? 'active' : ''; ?>">
                        <a class="nav-link" href="about.php">About Us</a>
                    </li>
                    <li class="nav-item <?php echo $lastPart === 'contact.php' ? 'active' : ''; ?>">
                        <a class="nav-link" href="contact.php">Contact Us</a>
                    </li>
                    <?php if (isset($_SESSION['user'])): ?>
                        <li class="nav-item <?php echo $lastPart === 'logout.php' ? 'active' : ''; ?>">
                            <a class="nav-link" href="logout.php">Log out</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item <?php echo $lastPart === 'login.php' ? 'active' : ''; ?>">
                            <a class="nav-link" href="login.php">Log in</a>
                        </li>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['user'])): ?>
                        <li class="nav-item <?php echo $lastPart === 'me.php' ? 'active' : ''; ?>">
                            <a class="nav-link" href="me.php">Profile</a>
                        </li>
                    <?php endif; ?>


                </ul>
            </div>
        </div>
    </nav>
</header>

