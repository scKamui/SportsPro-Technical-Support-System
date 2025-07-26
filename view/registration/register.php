<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Product</title>
    <link rel="stylesheet" href="/COMP3541_A3_Samar_Chauhan/css/main.css">
</head>
<body>
    <div class="incident-box">
        <?php if (isset($_SESSION['firstName'])): ?>
            <p>Welcome, <?php echo htmlspecialchars($_SESSION['firstName']); ?> |
                <a href="/COMP3541_A3_Samar_Chauhan/controller/logout.php" class="btn-link">Logout</a>
            </p>
        <?php endif; ?>

        <h1 style="color: red;">Register Product</h1>
        <p>Customer: <strong><?php echo htmlspecialchars($firstName); ?></strong></p>

        <?php if (!empty($error_message)) : ?>
            <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>

        <?php if (!empty($success_message)) : ?>
            <p class="success"><?php echo htmlspecialchars($success_message); ?></p>
        <?php endif; ?>

        <form method="post" action="/COMP3541_A3_Samar_Chauhan/controller/register_product.php">
            <label for="productCode">Product:</label>
            <select name="productCode" id="productCode" required>
                <option value="">-- Select a Product --</option>
                <?php if (!empty($products)) : ?>
                    <?php foreach ($products as $product) : ?>
                        <option value="<?php echo htmlspecialchars($product['productCode']); ?>">
                            <?php echo htmlspecialchars($product['name']); ?>
                        </option>
                    <?php endforeach; ?>
                <?php else : ?>
                    <option disabled>No products available</option>
                <?php endif; ?>
            </select>

            <div class="button-group">
                <input type="submit" value="Register Product" class="btn">
                <a href="/COMP3541_A3_Samar_Chauhan/index.php" class="btn">Home</a>
            </div>
        </form>
    </div>
</body>
</html>