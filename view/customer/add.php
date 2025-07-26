<!DOCTYPE html>
<html>
<head>
    <title>Add New Customer</title>
    <link rel="stylesheet" href="../../css/main.css">
</head>
<body>
    <h1>Add New Customer</h1>

    <?php if ($error_message) : ?>
        <p style="color:red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form method="post" action="../../controller/customer_add.php">
        <label>First Name:</label>
        <input type="text" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>"><br>

        <label>Last Name:</label>
        <input type="text" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>"><br>

        <label>Address:</label>
        <input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>"><br>

        <label>City:</label>
        <input type="text" name="city" value="<?php echo htmlspecialchars($city); ?>"><br>

        <label>State:</label>
        <input type="text" name="state" value="<?php echo htmlspecialchars($state); ?>"><br>

        <label>Postal Code:</label>
        <input type="text" name="postalCode" value="<?php echo htmlspecialchars($postalCode); ?>"><br>

        <label>Country:</label>
        <select name="countryCode">
            <?php foreach ($countries as $country) : ?>
                <option value="<?php echo $country['countryCode']; ?>"
                    <?php if ($country['countryCode'] === $countryCode) echo 'selected'; ?>>
                    <?php echo $country['countryName']; ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label>Phone:</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>"><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>"><br>

        <label>Password:</label>
        <input type="text" name="password" value="<?php echo htmlspecialchars($password); ?>"><br>

        <input type="submit" value="Add Customer">
    </form>

    <p><a href="../../controller/customer_search.php">Search Customers</a></p>
    <p><a href="/COMP3541_A3_Samar_Chauhan/index.php">Home</a></p>
</body>
</html>