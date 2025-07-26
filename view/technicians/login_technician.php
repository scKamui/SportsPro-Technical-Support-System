<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Technician Login - SportsPro</title>
    <link rel="stylesheet" href="/COMP3541_A3_Samar_Chauhan/css/main.css">
</head>
<body>
    <div class="incident-box">
        <h1>Technician Login</h1>

        <?php if (isset($_GET['error'])) : ?>
            <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>

        <form action="/COMP3541_A3_Samar_Chauhan/controller/tech_login.php" method="post">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

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