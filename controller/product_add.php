<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once('../config/db.php');

$error_message = '';
$success_message = '';

$code = '';
$name = '';
$version = '';
$releaseDate = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = trim($_POST['code']);
    $name = trim($_POST['name']);
    $version = trim($_POST['version']);
    $releaseDate = trim($_POST['releaseDate']);

    // Basic validation
    if ($code === '' || $name === '' || $version === '' || $releaseDate === '') {
        $error_message = "All fields are required.";
    } elseif (!is_numeric($version)) {
        $error_message = "Version must be a number.";
    } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $releaseDate)) {
        $error_message = "Invalid date format. Use YYYY-MM-DD.";
    } else {
        // Insert product
        $query = "INSERT INTO products (productCode, name, version, releaseDate)
                  VALUES (:code, :name, :version, :releaseDate)";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':code', $code);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':version', $version);
        $stmt->bindValue(':releaseDate', $releaseDate);
        $stmt->execute();
        $stmt->closeCursor();

        $success_message = "✅ Product added successfully.";
        $code = $name = $version = $releaseDate = ''; // Clear form
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <h1>Add New Product</h1>

    <?php if ($error_message): ?>
        <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
    <?php elseif ($success_message): ?>
        <p class="success"><?php echo htmlspecialchars($success_message); ?></p>
    <?php endif; ?>

    <div class="form-box">
        <form method="post">
            <label>Code:</label>
            <input type="text" name="code" value="<?php echo htmlspecialchars($code); ?>">

            <label>Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>">

            <label>Version:</label>
            <input type="text" name="version" value="<?php echo htmlspecialchars($version); ?>">

            <label>Release Date:</label>
            <input type="date" name="releaseDate" value="<?php echo htmlspecialchars($releaseDate); ?>">

            <div class="button-group">
                <input type="submit" value="Add Product" class="btn">
                <a href="product_manager.php" class="btn">Back to Product List</a>
            </div>
        </form>
    </div>
</body>
</html>