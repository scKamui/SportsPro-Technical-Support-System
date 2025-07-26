<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../config/db.php');

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Technician</title>
    <link rel="stylesheet" href="../css/main.css">
    <style>
        body {
            text-align: center;
        }

        form {
            display: inline-block;
            text-align: left;
            background-color: #111;
            padding: 2rem 3rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.05);
        }

        label {
            display: block;
            margin-top: 1rem;
            margin-bottom: 0.3rem;
            color: #e60000;
        }

        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 0.5rem;
            border: none;
            border-radius: 4px;
            background-color: #1a1a1a;
            color: #fff;
        }

        input[type="submit"] {
            margin-top: 1.5rem;
            background-color: #e60000;
            color: white;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #ff1a1a;
        }

        .nav-links {
            margin-top: 2rem;
        }

        .nav-links a {
            margin: 0 1rem;
            color: #fff;
            text-decoration: none;
            padding: 0.4rem 1rem;
            background-color: #e60000;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
        }

        .nav-links a:hover {
            background-color: #ff1a1a;
        }

        .error {
            color: red;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <h1>Add Technician</h1>

    <?php if (!empty($error_message)) : ?>
        <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
    <?php endif; ?>

    <form method="post">
        <label>First Name:</label>
        <input type="text" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>">

        <label>Last Name:</label>
        <input type="text" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>">

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">

        <label>Phone:</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>">

        <label>Password:</label>
        <input type="text" name="password" value="<?php echo htmlspecialchars($password); ?>">

        <input type="submit" value="Add Technician">
    </form>

    <div class="nav-links">
        <a href="technician_manager.php">Technician List</a>
        <a href="/COMP3541_A3_Samar_Chauhan/index.php">Home</a>
    </div>
</body>
</html>