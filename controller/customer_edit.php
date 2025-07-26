<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require('../config/db.php');

$error_message = '';
$customer = [];
$countries = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['customerID'])) {
    $customerID = $_POST['customerID'];

    // Fetch customer info
    $query = "SELECT * FROM customers WHERE customerID = :customerID";
    $statement = $db->prepare($query);
    $statement->bindValue(':customerID', $customerID);
    $statement->execute();
    $customer = $statement->fetch();
    $statement->closeCursor();

    if (!$customer) {
        $error_message = "Customer not found.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    // Update customer info
    $customerID = $_POST['customerID'];
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
        $query = "UPDATE customers
                  SET firstName = :firstName, lastName = :lastName, address = :address,
                      city = :city, state = :state, postalCode = :postalCode,
                      countryCode = :countryCode, phone = :phone, email = :email, password = :password
                  WHERE customerID = :customerID";
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
        $statement->bindValue(':customerID', $customerID);
        $statement->execute();
        $statement->closeCursor();

        header("Location: customer_search.php");
        exit();
    }

    // Rebuild customer array for redisplay
    $customer = [
        'customerID' => $customerID,
        'firstName' => $firstName,
        'lastName' => $lastName,
        'address' => $address,
        'city' => $city,
        'state' => $state,
        'postalCode' => $postalCode,
        'countryCode' => $countryCode,
        'phone' => $phone,
        'email' => $email,
        'password' => $password
    ];
}

// Get country list
$country_query = "SELECT countryCode, countryName FROM countries ORDER BY countryName";
$statement = $db->prepare($country_query);
$statement->execute();
$countries = $statement->fetchAll();
$statement->closeCursor();

include('../view/customer/edit.php');