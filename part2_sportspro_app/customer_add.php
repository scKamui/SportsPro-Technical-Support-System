<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require('db.php');

$error_message = '';
$firstName = $lastName = $address = $city = $state = $postalCode = $countryCode = $phone = $email = $password = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Basic validation
    if ($firstName === '' || $lastName === '' || $address === '' || $city === '' || $state === '' ||
        $postalCode === '' || $countryCode === '' || $phone === '' || $email === '' || $password === '') {
        $error_message = "All fields are required.";
    } else {
        $query = "INSERT INTO customers 
                  (firstName, lastName, address, city, state, postalCode, countryCode, phone, email, password)
                  VALUES 
                  (:firstName, :lastName, :address, :city, :state, :postalCode, :countryCode, :phone, :email, :password)";
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
        $statement->execute();
        $statement->closeCursor();

        // Redirect to search page
        header("Location: customer_search.php");
        exit();
    }
}

// Fetch countries for dropdown
$country_query = "SELECT countryCode, countryName FROM countries ORDER BY countryName";
$statement = $db->prepare($country_query);
$statement->execute();
$countries = $statement->fetchAll();
$statement->closeCursor();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Customer</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <h1>Add New Customer</h1>

    <?php if ($error_message) : ?>
        <p style="color:red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form method="post">
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

    <p><a href="customer_search.php">Search Customers</a></p>
    <p><a href="index.php">Home</a></p>
</body>
</html>