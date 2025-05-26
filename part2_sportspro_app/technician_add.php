<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('db.php');

$firstName = '';
$lastName = '';
$email = '';
$phone = '';
$password = '';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = trim($_POST['password']);

    if (empty($firstName) || empty($lastName) || empty($email) || empty($phone) || empty($password)) {
        $error_message = "All fields are required.";
    } else {
        $query = "INSERT INTO technicians (firstName, lastName, email, phone, password)
                  VALUES (:firstName, :lastName, :email, :phone, :password)";
        $statement = $db->prepare($query);
        $statement->bindValue(':firstName', $firstName);
        $statement->bindValue(':lastName', $lastName);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':phone', $phone);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $statement->closeCursor();

        header("Location: technician_manager.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Technician</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <h1>Add Technician</h1>

    <?php if (!empty($error_message)) : ?>
        <p style="color:red;"><?php echo htmlspecialchars($error_message); ?></p>
    <?php endif; ?>

    <form method="post">
        <label>First Name:</label>
        <input type="text" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>"><br>

        <label>Last Name:</label>
        <input type="text" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>"><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>"><br>

        <label>Phone:</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>"><br>

        <label>Password:</label>
        <input type="text" name="password" value="<?php echo htmlspecialchars($password); ?>"><br>

        <input type="submit" value="Add Technician">
    </form>

    <p><a href="technician_manager.php">View Technician List</a></p>
    <p><a href="index.php">Home</a></p>
</body>
</html>