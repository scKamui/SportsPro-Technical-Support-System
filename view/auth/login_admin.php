<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - SportsPro</title>
    <link rel="stylesheet" href="/COMP3541_A3_Samar_Chauhan/css/main.css">
</head>
<body>
    <div class="incident-box">
        <h1>Administrator Login</h1>

        <?php if (isset($_GET['error'])) : ?>
            <p class="error">Invalid username or password. Please try again.</p>
        <?php endif; ?>

        <form action="/COMP3541_A3_Samar_Chauhan/controller/login_admin.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <div class="button-group">
                <input type="submit" value="Login" class="btn">
                <a href="/COMP3541_A3_Samar_Chauhan/home.php" class="btn">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>