<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require('../config/db.php');

$error_message = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    if ($email === '') {
        $error_message = "Please enter an email address.";
    } else {
        try {
            $query = "SELECT * FROM customers WHERE email = :email";
            $statement = $db->prepare($query);
            $statement->bindValue(':email', $email);
            $statement->execute();
            $customer = $statement->fetch();
            $statement->closeCursor();

            if ($customer) {
                $_SESSION['customerID'] = $customer['customerID'];
                $_SESSION['firstName'] = $customer['firstName'];
                $_SESSION['lastName'] = $customer['lastName'];
                header("Location: register_product.php");
                exit();
            } else {
                $error_message = "No customer found with that email.";
            }
        } catch (PDOException $e) {
            $error_message = "Database error: " . $e->getMessage();
        }
    }
}

include('../view/registration/get_customer.php');