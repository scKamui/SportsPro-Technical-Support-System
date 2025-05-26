<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require('db.php');
session_start();

// Redirect if customer isn't logged in
if (!isset($_SESSION['customerID'])) {
    header("Location: register_login.php");
    exit();
}

$customerID = $_SESSION['customerID'];
$firstName = $_SESSION['firstName'];
$error_message = '';
$success_message = '';

// Get all products
$query = "SELECT * FROM products ORDER BY name";
$statement = $db->prepare($query);
$statement->execute();
$products = $statement->fetchAll();
$statement->closeCursor();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productCode'])) {
    $productCode = $_POST['productCode'];

    if ($productCode === '') {
        $error_message = "Please select a product to register.";
    } else {
        // Check if already registered
        $check = "SELECT * FROM registrations WHERE customerID = :customerID AND productCode = :productCode";
        $stmt = $db->prepare($check);
        $stmt->bindValue(':customerID', $customerID);
        $stmt->bindValue(':productCode', $productCode);
        $stmt->execute();
        $existing = $stmt->fetch();
        $stmt->closeCursor();

        if ($existing) {
            $error_message = "This product is already registered.";
        } else {
            // Insert registration
            $insert = "INSERT INTO registrations (customerID, productCode, registrationDate)
                       VALUES (:customerID, :productCode, NOW())";
            $stmt = $db->prepare($insert);
            $stmt->bindValue(':customerID', $customerID);
            $stmt->bindValue(':productCode', $productCode);
            $stmt->execute();
            $stmt->closeCursor();

            $success_message = "Product ($productCode) was registered successfully.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Product</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <h1>Register Product</h1>

    <p>Customer: <strong><?php echo htmlspecialchars($firstName); ?></strong></p>

    <?php if ($error_message) : ?>
        <p style="color:red;"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <?php if ($success_message) : ?>
        <p style="color:green;"><?php echo $success_message; ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Product:</label>
        <select name="productCode">
            <option value="">-- Select a Product --</option>
            <?php foreach ($products as $product) : ?>
                <option value="<?php echo $product['productCode']; ?>">
                    <?php echo $product['name']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Register Product">
    </form>

    <p><a href="register_login.php">Logout</a></p>
    <p><a href="index.php">Home</a></p>
</body>
</html>