<!DOCTYPE html>
<html>
<head>
    <title>Edit Customer</title>
    <link rel="stylesheet" href="../../css/main.css">
</head>
<body>
    <h1>Edit Customer</h1>

    <?php if ($error_message) : ?>
        <p style="color:red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <?php if (!empty($customer)) : ?>
    <form method="post" action="../../controller/customer_edit.php">
        <input type="hidden" name="customerID" value="<?php echo $customer['customerID']; ?>">

        <label>First Name:</label>
        <input type="text" name="firstName" value="<?php echo htmlspecialchars($customer['firstName']); ?>"><br>

        <label>Last Name:</label>
        <input type="text" name="lastName" value="<?php echo htmlspecialchars($customer['lastName']); ?>"><br>

        <label>Address:</label>
        <input type="text" name="address" value="<?php echo htmlspecialchars($customer['address']); ?>"><br>

        <label>City:</label>
        <input type="text" name="city" value="<?php echo htmlspecialchars($customer['city']); ?>"><br>

        <label>State:</label>
        <input type="text" name="state" value="<?php echo htmlspecialchars($customer['state']); ?>"><br>

        <label>Postal Code:</label>
        <input type="text" name="postalCode" value="<?php echo htmlspecialchars($customer['postalCode']); ?>"><br>

        <label>Country:</label>
        <select name="countryCode">
            <?php foreach ($countries as $country) : ?>
                <option value="<?php echo $country['countryCode']; ?>"
                    <?php if ($country['countryCode'] === $customer['countryCode']) echo 'selected'; ?>>
                    <?php echo $country['countryName']; ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label>Phone:</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($customer['phone']); ?>"><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($customer['email']); ?>"><br>

        <label>Password:</label>
        <input type="text" name="password" value="<?php echo htmlspecialchars($customer['password']); ?>"><br>

        <input type="submit" name="update" value="Update Customer">
    </form>
    <?php endif; ?>

    <p><a href="../../controller/customer_search.php">Search Customers</a></p>
    <p><a href="/COMP3541_A3_Samar_Chauhan/index.php">Home</a></p>
</body>
</html>