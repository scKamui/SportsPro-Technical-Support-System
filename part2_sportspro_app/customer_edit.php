<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require('db.php');

$customerID = '';
$error_message = '';
$success_message = '';
$customer = [];

// If coming from the search page
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['customerID']) && !isset($_POST['update_customer'])) {
    $customerID = $_POST['customerID'];

    // Fetch customer data
    $query = "SELECT * FROM customers WHERE customerID = :customerID";
    $statement = $db->prepare($query);
    $statement->bindValue(':customerID', $customerID);
    $statement->execute();
    $customer = $statement->fetch();
    $statement->closeCursor();

    if (!$customer) {
        $error_message = "Customer not found.";
    }
}

// If submitting an update
elseif (isset($_POST['update_customer'])) {
    $customerID = $_POST['customerID'];
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $address = trim($_POST['address']);
    $city = trim($_POST['city']);
    $state = trim($_POST['state']);
    $postalCode = trim($_POST['postalCode']);
    $countryCode = $_POST['countryCode'];
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($firstName === '' || $lastName === '' || $address === '' || $city === '' || $state === '' ||
        $postalCode === '' || $countryCode === '' || $phone === '' || $email === '' || $password === '') {
        $error_message = "All fields are required.";
    } else {
        $query = "UPDATE customers 
                  SET firstName = :firstName, lastName = :lastName, address = :address, city = :city,
                      state = :state, postalCode = :postalCode, countryCode = :countryCode,
                      phone = :phone, email = :email, password = :password
                  WHERE customerID = :customerID";
        $statement = $db->prepare($query);
        $statement->bindValue(':firstName', $firstName);
        $statement->bindValue(':lastName', $lastName);
        $statement->bindValue(':address', $address);
        $statement->bindValue(':city', $city);
        $statement->bindValue(':state', $state);
        $statement->bindValue(':postalCode', $postalCode);
        $statement->bindValue(':countryCode', $countryCode);
        $statement->bindValue(':phone', $phone);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':customerID', $customerID);
        $statement->execute();
        $statement->closeCursor();

        // Re-fetch updated customer data
        $query = "SELECT * FROM customers WHERE customerID = :customerID";
        $statement = $db->prepare($query);
        $statement->bindValue(':customerID', $customerID);
        $statement->execute();
        $customer = $statement->fetch();
        $statement->closeCursor();

        $success_message = "Customer updated successfully!";
    }
}

// Fetch country list
$country_query = "SELECT countryCode, countryName FROM countries ORDER BY countryName";
$statement = $db->prepare($country_query);
$statement->execute();
$countries = $statement->fetchAll();
$statement->closeCursor();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Customer</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <h1>Edit Customer</h1>

    <?php if ($error_message) : ?>
        <p style="color:red;"><?php echo $error_message; ?></p>
    <?php elseif ($success_message) : ?>
        <p style="color:green;"><?php echo $success_message; ?></p>
    <?php endif; ?>

    <?php if ($customer) : ?>
        <form method="post">
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

            <input type="submit" name="update_customer" value="Update Customer">
        </form>
    <?php endif; ?>

    <p><a href="customer_search.php">Search Customers</a></p>
    <p><a href="index.php">Home</a></p>
</body>
</html>