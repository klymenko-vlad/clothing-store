<?php
session_start();
require_once __DIR__ . '/classes/User.php';

use Users\User;

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$userInstance = new User();
$user = $userInstance->getUserByEmail($_SESSION['user']['email']);

if (!$user) {
    echo "User not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<body>

<?php
$pageTitle = $user['first_name'] . " " . $user['last_name'];

include('./layout/header.php');
?>

<section class="pt-5">
    <div class="container pt-5">
        <h3 class="mb-4">Hello, <?= htmlspecialchars($user['first_name'])?>, you can view and change your profile here</h3>
        <form action="./functions/handle_update_user.php" method="post">
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>

            <div class="form-group mt-3">
                <label for="firstname">First Name:</label>
                <input type="text" name="firstname" id="firstname" class="form-control" value="<?= htmlspecialchars($user['first_name']) ?>" required>
            </div>

            <div class="form-group mt-3">
                <label for="lastname">Last Name:</label>
                <input type="text" name="lastname" id="lastname" class="form-control" value="<?= htmlspecialchars($user['last_name']) ?>" required>
            </div>

            <div class="form-group mt-3">
                <label for="phone">Phone Number:</label>
                <input type="text" name="phone" id="phone" class="form-control" value="<?= htmlspecialchars($user['phone']) ?>" required>
            </div>

            <div class="form-group mt-3">
                <label for="role">Role:</label>
                <select name="role" id="role" class="form-control">
                    <option value="1" <?= $user['role'] == 1 ? 'selected' : '' ?>>Buyer</option>
                    <option value="2" <?= $user['role'] == 2 ? 'selected' : '' ?>>Seller</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-4">Update</button>
        </form>
    </div>
</section>


<?php
    if ($_SESSION['user']['role'] == 2) {
        include('./components/createproduct_form.php');
    }
?>

<?php include('./layout/footer.php'); ?>

</body>
</html>
