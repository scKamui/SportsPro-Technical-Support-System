<?php
// File: controller/customer_search.php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require('../config/db.php');

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../home.php");
    exit();
}

$lastName = '';
$customers = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lastName = trim($_POST['lastName']);

    if (!empty($lastName)) {
        $query = "SELECT * FROM customers WHERE lastName LIKE :lastName";
        $statement = $db->prepare($query);
        $statement->bindValue(':lastName', '%' . $lastName . '%');
        $statement->execute();
        $customers = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
    }
}

include('../view/customer/search.php');