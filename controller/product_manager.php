<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../config/db.php');

// Handle delete if form is submitted
if (isset($_POST['delete_product'])) {
    $product_code = $_POST['product_code'];
    $query = "DELETE FROM products WHERE productCode = :product_code";
    $statement = $db->prepare($query);
    $statement->bindValue(':product_code', $product_code);
    $statement->execute();
    $statement->closeCursor();
}

// Get all products
$query = 'SELECT * FROM products ORDER BY productCode';
$statement = $db->prepare($query);
$statement->execute();
$products = $statement->fetchAll();
$statement->closeCursor();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Manager</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <h1>Product List</h1>
    <table>
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Version</th>
            <th>Release Date</th>
            <th>Action</th>
        </tr>
        <?php foreach ($products as $product) : ?>
        <tr>
            <td><?php echo htmlspecialchars($product['productCode']); ?></td>
            <td><?php echo htmlspecialchars($product['name']); ?></td>
            <td><?php echo htmlspecialchars($product['version']); ?></td>
            <td><?php echo htmlspecialchars($product['releaseDate']); ?></td>
            <td>
                <form method="post" action="">
                    <input type="hidden" name="product_code" value="<?php echo $product['productCode']; ?>">
                    <input type="submit" name="delete_product" value="Delete">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <div class="button-group">
        <a href="product_add.php" class="btn">Add Product</a>
        <a href="/COMP3541_A3_Samar_Chauhan/index.php" class="btn">Home</a>
    </div> 
</body>
</html>