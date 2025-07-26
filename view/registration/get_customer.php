<?php
session_start();

// Redirect if customer is not logged in
if (!isset($_SESSION['customerID']) || !isset($_SESSION['firstName'])) {
    header("Location: /COMP3541_A3_Samar_Chauhan/view/auth/login_customer.php");
    exit();
}

$customerName = $_SESSION['firstName'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Product - Get Customer</title>
    <link rel="stylesheet" href="/COMP3541_A3_Samar_Chauhan/css/main.css">
</head>
<body>
    <div class="incident-box">
        <h1>Register Product</h1>

        <form method="post" action="/COMP3541_A3_Samar_Chauhan/controller/register_customer.php">
            <label for="email">Customer Email:</label>
            <input 
                type="email" 
                name="email" 
                id="email"
                value="<?php echo htmlspecialchars($email ?? ''); ?>" 
                required
            >

            <div class="button-group">
                <input type="submit" value="Find Customer" class="btn">
                <a href="/COMP3541_A3_Samar_Chauhan/index.php" class="btn">Home</a>
            </div>
        </form>

        <?php if (!empty($error_message)) : ?>
            <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>

        <?php if (!empty($customerName)) : ?>
            <div class="status-message" style="margin-top: 20px;">
                Logged in as: <strong><?php echo htmlspecialchars($customerName); ?></strong>
            </div>
            <div class="button-group" style="margin-top: 10px;">
                <a href="/COMP3541_A3_Samar_Chauhan/controller/logout.php" class="btn">Logout</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>