<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require('db.php');
session_start();

// Redirect if no customer selected
if (!isset($_SESSION['customerID'])) {
    header("Location: incident_get_customer.php");
    exit();
}

$customerID = $_SESSION['customerID'];
$firstName = $_SESSION['firstName'];
$lastName = $_SESSION['lastName'];
$error_message = '';
$success_message = '';

// Fetch registered products for this customer
$query = "SELECT p.productCode, p.name
          FROM products p
          INNER JOIN registrations r ON p.productCode = r.productCode
          WHERE r.customerID = :customerID";
$statement = $db->prepare($query);
$statement->bindValue(':customerID', $customerID);
$statement->execute();
$products = $statement->fetchAll();
$statement->closeCursor();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productCode = $_POST['productCode'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    if ($productCode === '' || $title === '' || $description === '') {
        $error_message = "All fields are required.";
    } else {
        $query = "INSERT INTO incidents
                 (customerID, productCode, dateOpened, title, description)
                 VALUES (:customerID, :productCode, NOW(), :title, :description)";
        $statement = $db->prepare($query);
        $statement->bindValue(':customerID', $customerID);
        $statement->bindValue(':productCode', $productCode);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':description', $description);
        $statement->execute();
        $statement->closeCursor();

        $success_message = "Incident was added to our database.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Incident</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <h1>Create Incident</h1>
    <p>Customer: <strong><?php echo htmlspecialchars($firstName . ' ' . $lastName); ?></strong></p>

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
                    <?php echo htmlspecialchars($product['name']); ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label>Title:</label>
        <input type="text" name="title"><br>

        <label>Description:</label><br>
        <textarea name="description" rows="4" cols="50"></textarea><br>

        <input type="submit" value="Create Incident">
    </form>

    <p><a href="incident_get_customer.php">Back</a></p>
    <p><a href="index.php">Home</a></p>
</body>
</html>