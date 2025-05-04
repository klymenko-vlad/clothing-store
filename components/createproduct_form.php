<?php

require_once __DIR__ . '/../classes/Category.php';

use Categories\Category;

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$categoryInstance = new Category();
$categories = $categoryInstance->getCategories();


?>

<section class="pt-5">
    <div class="container pt-5">
        <h2>Create New Product</h2>
        <form action="../functions/handlers/products/handle_create_product.php" method="post" enctype="multipart/form-data">
            <div class="form-group mt-3">
                <label for="title">Product Title:</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <div class="form-group mt-3">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control" rows="4"></textarea>
            </div>

            <div class="form-group mt-3">
                <label for="price">Price (€):</label>
                <input type="number" name="price" id="price" class="form-control" step="0.01" required>
            </div>

            <div class="form-group mt-4">
                <label for="categories">Categories:</label>
                <select required name="categories[]" id="categories" class="form-select" multiple
                        size="<?php echo count($categories); ?>">
                    <?php foreach ($categories as $category)
                        echo '<option value="' . $category['idcategory'] . '">' . $category['title'] . '</option>';
                    ?>}
                </select>
                <small class="form-text text-muted">Hold Ctrl (or Cmd) to select multiple</small>
            </div>

            <div class="form-group mt-3">
                <label for="image">Product Image:</label>
                <input type="file" name="image" id="image" class="form-control-file">
            </div>

            <button type="submit" class="btn btn-success mt-4">Create Product</button>
        </form>
    </div>
</section>


