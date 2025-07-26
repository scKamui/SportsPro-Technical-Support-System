<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require('../config/db.php');

$error_message = '';
$firstName = $lastName = $address = $city = $state = $postalCode = $countryCode = $phone = $email = $password = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $address = trim($_POST['address']);
    $city = trim($_POST['city']);
    $state = trim($_POST['state']);
    $postalCode = trim($_POST['postalCode']);
    $countryCode = $_POST['countryCode'];
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($firstName === '' || $lastName === '' || $address === '' || $city === '' || $state === '' ||
        $postalCode === '' || $countryCode === '' || $phone === '' || $email === '' || $password === '') {
        $error_message = "All fields are required.";
    } else {
        $query = "INSERT INTO customers 
                  (firstName, lastName, address, city, state, postalCode, countryCode, phone, email, password)
                  VALUES 
                  (:firstName, :lastName, :address, :city, :state, :postalCode, :countryCode, :phone, :email, :password)";
        $statement = $db->prepare($query);
        $statement->bindValue(':firstName', $firstName);
        $statement->bindValue(':lastName', $lastName);
        $statement->bindValue(':address', $address);
        $statement->bindValue(':city', $city);
        $statement->bindValue(':state', $state);
        $statement->bindValue(':postalCode', $postalCode);
        $statement->bindValue(':countryCode', $countryCode);
        $statement->bindValue(':phone', $phone);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $statement->closeCursor();

        header("Location: customer_search.php");
        exit();
    }
}

// Fetch countries for dropdown
$country_query = "SELECT countryCode, countryName FROM countries ORDER BY countryName";
$statement = $db->prepare($country_query);
$statement->execute();
$countries = $statement->fetchAll();
$statement->closeCursor();

include('../view/customer/add.php');