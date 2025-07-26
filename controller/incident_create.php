<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require('../config/db.php');

if (!isset($_SESSION['customerID'])) {
    header("Location: get_customer.php");
    exit();
}

$customerID = $_SESSION['customerID'];
$firstName = $_SESSION['firstName'];
$lastName = $_SESSION['lastName'];
$error_message = '';
$success_message = '';
$products = [];

try {
    // Fetch registered products
    $query = "SELECT p.productCode, p.name
              FROM products p
              INNER JOIN registrations r ON p.productCode = r.productCode
              WHERE r.customerID = :customerID";
    $statement = $db->prepare($query);
    $statement->bindValue(':customerID', $customerID);
    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();
} catch (PDOException $e) {
    include('../view/shared/error.php');
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productCode = $_POST['productCode'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    if ($productCode === '' || $title === '' || $description === '') {
        $error_message = "All fields are required.";
    } else {
        try {
            $query = "INSERT INTO incidents
                     (customerID, productCode, dateOpened, title, description)
                     VALUES (:customerID, :productCode, NOW(), :title, :description)";
            $statement = $db->prepare($query);
            $statement->bindValue(':customerID', $customerID);
            $statement->bindValue(':productCode', $productCode);
            $statement->bindValue(':title', $title);
            $statement->bindValue(':description', $description);
            $statement->execute();
            $statement->closeCursor();

            $success_message = "Incident was added to our database.";
        } catch (PDOException $e) {
            include('../view/shared/error.php');
            exit();
        }
    }
}

include('../view/incidents/create.php');