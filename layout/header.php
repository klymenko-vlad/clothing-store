<?php
$path = $_SERVER['REQUEST_URI'];
$lastPart = basename(parse_url($path, PHP_URL_PATH));
?>

<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="/phpproj/index.php"><h2>Sixteen <em>Clothing</em></h2></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item <?php echo $lastPart === 'index.php' ? 'active' : ''; ?>">
                        <a class="nav-link" href="/phpproj/index.php">Home
                        </a>
                    </li>
                    <li class="nav-item <?php echo $lastPart === 'products.php' ? 'active' : ''; ?>">
                        <a class="nav-link" href="/phpproj/products.php">Our Products</a>
                    </li>
                    <li class="nav-item <?php echo $lastPart === 'about.php' ? 'active' : ''; ?>">
                        <a class="nav-link" href="/phpproj/about.php">About Us</a>
                    </li>
                    <li class="nav-item <?php echo $lastPart === 'contact.php' ? 'active' : ''; ?>">
                        <a class="nav-link" href="/phpproj/contact.php">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

