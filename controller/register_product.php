<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require('../config/db.php');

// Redirect if customer isn't logged in
if (!isset($_SESSION['customerID'])) {
    header("Location: ../view/auth/login_customer.php");
    exit();
}

$customerID = $_SESSION['customerID'];
$firstName = isset($_SESSION['firstName']) ? $_SESSION['firstName'] : 'Customer';
$error_message = '';
$success_message = '';

// Fetch all products for dropdown
try {
    $query = "SELECT productCode, name FROM products ORDER BY name";
    $statement = $db->prepare($query);
    $statement->execute();
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
} catch (PDOException $e) {
    $error_message = "Error loading products: " . $e->getMessage();
    $products = [];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productCode'])) {
    $productCode = $_POST['productCode'];

    if (empty($productCode)) {
        $error_message = "Please select a product to register.";
    } else {
        try {
            // Check if already registered
            $checkQuery = "SELECT * FROM registrations WHERE customerID = :customerID AND productCode = :productCode";
            $checkStmt = $db->prepare($checkQuery);
            $checkStmt->bindValue(':customerID', $customerID);
            $checkStmt->bindValue(':productCode', $productCode);
            $checkStmt->execute();
            $existing = $checkStmt->fetch();
            $checkStmt->closeCursor();

            if ($existing) {
                $error_message = "This product is already registered.";
            } else {
                // Register product
                $insertQuery = "INSERT INTO registrations (customerID, productCode, registrationDate)
                                VALUES (:customerID, :productCode, NOW())";
                $insertStmt = $db->prepare($insertQuery);
                $insertStmt->bindValue(':customerID', $customerID);
                $insertStmt->bindValue(':productCode', $productCode);
                $insertStmt->execute();
                $insertStmt->closeCursor();

                $success_message = "Product registered successfully.";
            }
        } catch (PDOException $e) {
            $error_message = "Database error: " . $e->getMessage();
        }
    }
}

// Load the view
include('../view/registration/register.php');