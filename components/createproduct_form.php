<?php
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>

<section class="pt-5">
    <div class="container pt-5">
        <h2>Create New Product</h2>
        <form action="../functions/handlers/handle_create_product.php" method="post">
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

<!--            <div class="form-group mt-3">-->
<!--                <label for="image">Product Image:</label>-->
<!--                <input type="file" name="image" id="image" class="form-control-file" >-->
<!--            </div>-->

            <button type="submit" class="btn btn-success mt-4">Create Product</button>
        </form>
    </div>
</section>


