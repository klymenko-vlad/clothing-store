<!DOCTYPE html>
<html lang="en">
<body>

<?php
$pageTitle = "Create Account";

include('./layout/header.php');
?>

<div class="container d-flex justify-content-center align-items-center pt-5">
    <div class="register-container pt-5">
        <h2 class="text-center">Create Account</h2>
        <form action="./functions/handle_register.php" method="post">

            <div class="form-group mt-3">
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" id="first_name" class="form-control" required placeholder="Enter first name">
            </div>

            <div class="form-group mt-3">
                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" id="last_name" class="form-control" required placeholder="Enter last name">
            </div>

            <div class="form-group mt-3">
                <label for="phone">Phone:</label>
                <input type="text" name="phone" id="phone" class="form-control" required placeholder="Enter phone number">
            </div>

            <div class="form-group mt-3">
                <label for="email">Email address:</label>
                <input type="email" name="email" id="email" class="form-control" required placeholder="Enter email">
            </div>

            <div class="form-group mt-3">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required
                       placeholder="Enter password">
            </div>

            <div class="form-group mt-3">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required
                       placeholder="Repeat password">
            </div>

            <div class="form-group mt-3">
                <label for="role">Register as:</label>
                <select name="role" id="role" class="form-control" required>
                    <option value="1" selected>Buyer</option>
                    <option value="2">Seller</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary btn-block mt-4">Register</button>

            <p class="text-center mt-3">
                Already have an account? <a href="login.php">Login</a>
            </p>
        </form>
    </div>
</div>

<?php include('./layout/footer.php'); ?>

</body>
</html>
