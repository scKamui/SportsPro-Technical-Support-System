<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require('db.php');

$lastName = '';
$customers = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lastName = trim($_POST['lastName']);

    if (!empty($lastName)) {
        $query = "SELECT * FROM customers WHERE lastName LIKE :lastName";
        $statement = $db->prepare($query);
        $statement->bindValue(':lastName', '%' . $lastName . '%');
        $statement->execute();
        $customers = $statement->fetchAll();
        $statement->closeCursor();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Search</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <h1>Customer Search</h1>

    <form method="post">
        <label>Last Name:</label>
        <input type="text" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>">
        <input type="submit" value="Search">
    </form>

    <?php if (!empty($customers)) : ?>
        <table>
            <tr>
                <th>Name</th>
                <th>Email Address</th>
                <th>City</th>
                <th>Action</th>
            </tr>
            <?php foreach ($customers as $customer) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($customer['firstName'] . ' ' . $customer['lastName']); ?></td>
                    <td><?php echo htmlspecialchars($customer['email']); ?></td>
                    <td><?php echo htmlspecialchars($customer['city']); ?></td>
                    <td>
                        <form method="post" action="customer_edit.php">
                            <input type="hidden" name="customerID" value="<?php echo $customer['customerID']; ?>">
                            <input type="submit" value="Select">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <p><a href="customer_add.php">Add New Customer</a></p>
    <p><a href="index.php">Home</a></p>
</body>
</html>