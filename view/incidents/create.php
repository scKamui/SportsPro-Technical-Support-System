<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Incident</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <div class="incident-box">
        <?php if (isset($_SESSION['firstName'])): ?>
            <p>Welcome, <?php echo htmlspecialchars($_SESSION['firstName']); ?> |
                <a href="/COMP3541_A3_Samar_Chauhan/controller/logout.php" class="btn-link">Logout</a>
            </p>
        <?php endif; ?>

        <h1>Create Incident</h1>
        <p>Customer: <strong><?php echo htmlspecialchars($firstName . ' ' . $lastName); ?></strong></p>

        <?php if (!empty($error_message)) : ?>
            <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
        <?php elseif (!empty($success_message)) : ?>
            <p class="success"><?php echo htmlspecialchars($success_message); ?></p>
        <?php endif; ?>

        <form method="post" action="/COMP3541_A3_Samar_Chauhan/controller/incident_create.php">
            <label for="productCode">Product:</label>
            <select name="productCode" id="productCode" required>
                <option value="">-- Select a Product --</option>
                <?php foreach ($products as $product) : ?>
                    <option value="<?php echo $product['productCode']; ?>">
                        <?php echo htmlspecialchars($product['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>

            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="4" required></textarea>

            <div class="button-group">
                <input type="submit" value="Create Incident" class="btn">
                <a href="/COMP3541_A3_Samar_Chauhan/controller/get_customer.php" class="btn">Back</a>
                <a href="/COMP3541_A3_Samar_Chauhan/index.php" class="btn">Home</a>
            </div>
        </form>
    </div>
</body>
</html>