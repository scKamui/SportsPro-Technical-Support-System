<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Incident - Get Customer</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <div class="incident-box">
        <h1>Create Incident</h1>

        <form method="post" action="/COMP3541_A3_Samar_Chauhan/controller/get_customer.php">
            <label for="email">Email:</label>
            <input 
                type="email" 
                name="email" 
                id="email"
                value="<?php echo htmlspecialchars($email ?? ''); ?>" 
                required
            >

            <!-- Button group starts here -->
            <div class="button-group">
                <input type="submit" value="Get Customer" class="btn">
                <a href="/COMP3541_A3_Samar_Chauhan/index.php" class="btn">Home</a>
            </div>
        </form>

        <?php if (!empty($error_message)) : ?>
            <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>
    </div>
</body>
</html>