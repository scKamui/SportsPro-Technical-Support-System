<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require('../config/db.php');

$productCode = '';
$incidents = [];
$error_message = '';

// Fetch all products
$product_query = "SELECT productCode, name FROM products ORDER BY name";
$stmt = $db->prepare($product_query);
$stmt->execute();
$products = $stmt->fetchAll();
$stmt->closeCursor();

// If product is selected
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productCode'])) {
    $productCode = $_POST['productCode'];

    if ($productCode === '') {
        $error_message = "Please select a product.";
    } else {
        $query = "SELECT c.firstName, c.lastName, i.title, i.dateOpened
                  FROM incidents i
                  JOIN customers c ON i.customerID = c.customerID
                  WHERE i.productCode = :productCode
                  ORDER BY i.dateOpened DESC";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':productCode', $productCode);
        $stmt->execute();
        $incidents = $stmt->fetchAll();
        $stmt->closeCursor();
    }
}

include('../view/incidents/by_product.php');