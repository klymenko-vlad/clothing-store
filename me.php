<?php
session_start();
require_once __DIR__ . '/classes/User.php';

use Users\User;

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$userInstance = new User();
$user = $userInstance->getUserById($_SESSION['user']['id']);

if (!$user) {
    echo "User not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <title>My Profile - Sixteen Clothing</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="assets/css/owl.css">
</head>
<body>

<?php include('./layout/header.php'); ?>

<section class="pt-5">
    <div class="container pt-5">
        <h2 class="mb-4">Hello, <?= htmlspecialchars($user['email'])?>, you can view and change your profile here</h2>
        <form action="./functions/handle_update_user.php" method="post">
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>

            <div class="form-group mt-3">
                <label for="role">Role:</label>
                <select name="role" id="role" class="form-control">
                    <option value="1" <?= $user['role'] == 1 ? 'selected' : '' ?>>Buyer</option>
                    <option value="2" <?= $user['role'] == 2 ? 'selected' : '' ?>>Seller</option>
                </select>
            </div>

            <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['iduser']) ?>">

            <button type="submit" class="btn btn-primary mt-4">Update</button>
        </form>
    </div>
</section>

<?php include('./layout/footer.php'); ?>

<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
