<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require('../config/db.php');

// Redirect to login page with error if form not submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: /COMP3541_A3_Samar_Chauhan/view/technicians/login_technician.php");
    exit();
}

// Validate submitted email
$email = $_POST['email'] ?? '';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: /COMP3541_A3_Samar_Chauhan/view/technicians/login_technician.php?error=1");
    exit();
}

// Look up technician by email
$query = "SELECT * FROM technicians WHERE email = :email";
$statement = $db->prepare($query);
$statement->bindValue(':email', $email);
$statement->execute();
$technician = $statement->fetch();
$statement->closeCursor();

if ($technician) {
    // Successful login
    $_SESSION['techID'] = $technician['techID'];
    $_SESSION['techName'] = $technician['firstName'] . ' ' . $technician['lastName'];

    // ✅ Correct redirection path for Task 5
    header("Location: /COMP3541_A3_Samar_Chauhan/view/incidents/technician_incidents.php");
    exit();
} else {
    // Failed login
    header("Location: /COMP3541_A3_Samar_Chauhan/view/technicians/login_technician.php?error=1");
    exit();
}