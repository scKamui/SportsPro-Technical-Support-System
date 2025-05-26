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
            session_start();
            $_SESSION['customerID'] = $customer['customerID'];
            $_SESSION['firstName'] = $customer['firstName'];
            $_SESSION['lastName'] = $customer['lastName'];
            header("Location: incident_create.php");
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
    <title>Create Incident - Get Customer</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <h1>Create Incident</h1>

    <form method="post">
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <input type="submit" value="Get Customer">
    </form>

    <?php if ($error_message) : ?>
        <p style="color:red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <p><a href="index.php">Home</a></p>
</body>
</html>