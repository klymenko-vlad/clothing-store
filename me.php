<?php
session_start();
require_once __DIR__ . '/classes/User.php';
require_once __DIR__ . '/classes/Order.php';

use Users\User;
use Orders\Order;

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

$orderInstance = new Order();
$orders = $orderInstance->getMyOrders($user['iduser']);


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
        <form action="functions/handlers/users/handle_update_user.php" method="post">
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

<section class="pt-5">
    <div class="container pt-5">
        <h5 class="">You won't be able to restore your data!</h5>
        <form action="functions/handlers/users/handle_delete_user.php" method="post">

            <button type="submit" class="btn btn-primary mt-4">Delete your account</button>
        </form>
    </div>
</section>

<div class="container pt-5">
    <h2 class="mb-4">My Orders</h2>

    <?php if (empty($orders)): ?>
        <p>You have no orders yet.</p>
    <?php else: ?>
        <?php foreach ($orders as $order): ?>
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <strong>Order #<?= $order['idorder'] ?></strong> |
                        Status: <span class="badge bg-info"><?= ucfirst($order['status']) ?></span> |
                        Date: <?= date('F j, Y H:i', strtotime($order['created_at'])) ?>
                    </div>
                    <?php if ($order['status'] !== 'shipped' && $_SESSION['user']['role'] == 2): ?>
                        <form method="POST" action="./functions/handlers/orders/mark_as_shipped.php" class="m-0">
                            <input type="hidden" name="order_id" value="<?= $order['idorder'] ?>">
                            <button type="submit" class="btn btn-sm btn-success">Pay for this order</button>
                        </form>
                    <?php endif; ?>
                </div>
                <ul class="list-group list-group-flush">
                    <?php foreach ($order['products'] as $product): ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <div>
                                <strong><?= htmlspecialchars($product['title']) ?></strong><br>
                                Quantity: <?= $product['quantity'] ?> × $<?= number_format($product['price'], 2) ?>
                            </div>
                            <span class="fw-bold">$<?= number_format($product['subtotal'], 2) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>


<?php include('./layout/footer.php'); ?>

</body>
</html>
