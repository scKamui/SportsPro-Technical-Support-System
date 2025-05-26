<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require('db.php');

$error_message = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    if ($email === '') {
        $error_message = "Please enter an email address.";
    } else {
        $query = "SELECT * FROM customers WHERE email = :email";
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $customer = $statement->fetch();
        $statement->closeCursor();

        if ($customer) {
            // Store customerID in session and redirect
            session_start();
            $_SESSION['customerID'] = $customer['customerID'];
            $_SESSION['firstName'] = $customer['firstName'];
            header("Location: register_product.php");
            exit();
        } else {
            $error_message = "No customer found with that email.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Registration - Login</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <h1>Register Product</h1>

    <form method="post">
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <input type="submit" value="Login">
    </form>

    <?php if ($error_message) : ?>
        <p style="color:red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <p><a href="index.php">Home</a></p>
</body>
</html>