<?php
session_start();
require('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($email === '' || $password === '') {
        header("Location: /COMP3541_A3_Samar_Chauhan/view/technicians/login_technician.php?error=Please+fill+out+all+fields");
        exit();
    }

    $query = "SELECT * FROM technicians WHERE email = :email";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $tech = $stmt->fetch();
    $stmt->closeCursor();

    // Check if technician exists and password is correct
    if ($tech && $password === 'sesame') {
        $_SESSION['technician'] = $tech;
        $_SESSION['techID'] = $tech['techID'];
        $_SESSION['techName'] = $tech['firstName'] . ' ' . $tech['lastName'];

        header("Location: /COMP3541_A3_Samar_Chauhan/view/incidents/technician_incidents.php");
        exit();
    } else {
        header("Location: /COMP3541_A3_Samar_Chauhan/view/technicians/login_technician.php?error=Invalid+email+or+password");
        exit();
    }
} else {
    header("Location: /COMP3541_A3_Samar_Chauhan/view/technicians/login_technician.php");
    exit();
}