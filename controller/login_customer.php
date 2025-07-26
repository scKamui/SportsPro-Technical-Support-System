<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
require('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($email === '' || $password === '') {
        header("Location: ../view/auth/login_customer.php?error=Please+fill+out+all+fields");
        exit();
    }

    try {
        $query = "SELECT * FROM customers WHERE email = :email";
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $customer = $statement->fetch();
        $statement->closeCursor();

        if ($customer && $password === 'sesame') {
            $_SESSION['customerID'] = $customer['customerID'];
            $_SESSION['firstName'] = $customer['firstName'];
            $_SESSION['lastName'] = $customer['lastName'];
            $_SESSION['customerName'] = $customer['firstName']; // optional

            header("Location: ../view/registration/get_customer.php");
            exit();
        } else {
            header("Location: ../view/auth/login_customer.php?error=Invalid+email+or+password");
            exit();
        }
    } catch (PDOException $e) {
        header("Location: ../view/shared/error.php");
        exit();
    }
} else {
    header("Location: ../view/auth/login_customer.php");
    exit();
}