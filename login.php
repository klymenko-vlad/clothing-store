<!DOCTYPE html>
<html lang="en">

<body>

<?php
$pageTitle = 'Log in';

include('./layout/header.php');
?>

<div class="container d-flex justify-content-center align-items-center pt-5">
    <div class="login-container pt-5">
        <h2 class="text-center">Login</h2>
        <form action="./functions/handle_login.php" method="post">
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" name="email" id="email" class="form-control" required placeholder="Enter email">
            </div>

            <div class="form-group mt-3">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required
                       placeholder="Enter password">
            </div>

            <button type="submit" class="btn btn-primary btn-block mt-4">Login</button>

            <p class="text-center mt-3">
                Don’t have an account? <a href="register.php">Register</a>
            </p>
        </form>
    </div>
</div>

<?php include('./layout/footer.php'); ?>

</body>
</html>
