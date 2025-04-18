<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sixteen Clothing</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
          rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="assets/css/owl.css">

    <style>
        .login-container {
            margin-top: 80px;
            margin-bottom: 80px;
            max-width: 400px;
            background-color: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .login-container h2 {
            margin-bottom: 30px;
            font-weight: 600;
        }
    </style>
</head>
<body>

<?php include('./layout/header.php'); ?>

<div class="container d-flex justify-content-center align-items-center">
    <div class="login-container">
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

<!-- JS Scripts -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/custom.js"></script>
</body>
</html>
