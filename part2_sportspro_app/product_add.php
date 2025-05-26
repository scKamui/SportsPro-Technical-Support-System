<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('db.php');

$code = '';
$name = '';
$version = '';
$releaseDate = '';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = trim($_POST['code']);
    $name = trim($_POST['name']);
    $version = trim($_POST['version']);
    $releaseDate = trim($_POST['releaseDate']);

    // Validate required fields
    if (empty($code) || empty($name) || empty($version) || empty($releaseDate)) {
        $error_message = "All fields are required.";
    } else {
        // Insert into database
        $query = "INSERT INTO products (productCode, name, version, releaseDate)
                  VALUES (:code, :name, :version, :releaseDate)";
        $statement = $db->prepare($query);
        $statement->bindValue(':code', $code);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':version', $version);
        $statement->bindValue(':releaseDate', $releaseDate);
        $statement->execute();
        $statement->closeCursor();

        // Redirect back to product list
        header("Location: product_manager.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <h1>Add Product</h1>

    <?php if (!empty($error_message)) : ?>
        <p style="color: red;"><?php echo htmlspecialchars($error_message); ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Code:</label>
        <input type="text" name="code" value="<?php echo htmlspecialchars($code); ?>"><br>

        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>"><br>

        <label>Version:</label>
        <input type="text" name="version" value="<?php echo htmlspecialchars($version); ?>"><br>

        <label>Release Date:</label>
        <input type="text" name="releaseDate" value="<?php echo htmlspecialchars($releaseDate); ?>"><br>

        <input type="submit" value="Add Product">
    </form>

    <p><a href="product_manager.php">View Product List</a></p>
    <p><a href="index.php">Home</a></p>
</body>
</html>