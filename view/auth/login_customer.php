<?php
session_start();
if (isset($_SESSION['customerID'])) {
    header("Location: ../../controller/register_product.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Login - SportsPro</title>
    <link rel="stylesheet" href="/COMP3541_A3_Samar_Chauhan/css/main.css">
</head>
<body>
    <div class="incident-box">
        <h1>Customer Login</h1>

        <?php if (isset($_GET['error'])) : ?>
            <p class="error">Invalid email or password. Please try again.</p>
        <?php endif; ?>

        <form method="post" action="/COMP3541_A3_Samar_Chauhan/controller/login_customer.php">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email"
                   value="<?php echo htmlspecialchars($_GET['email'] ?? ''); ?>" required>

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