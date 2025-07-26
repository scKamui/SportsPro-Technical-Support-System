<?php
// File: controller/incident_assign.php

session_start();
require('../config/db.php');

// Ensure user is logged in (basic protection)
if (!isset($_SESSION['customerID']) && !isset($_SESSION['admin'])) {
    header("Location: ../view/auth/login_customer.php");
    exit();
}

try {
    $query = "SELECT incidents.incidentID, customers.firstName, customers.lastName, products.name AS productName, incidents.dateOpened, incidents.title, incidents.description
              FROM incidents
              JOIN customers ON incidents.customerID = customers.customerID
              JOIN products ON incidents.productCode = products.productCode
              WHERE incidents.techID IS NULL
              ORDER BY incidents.dateOpened";

    $statement = $db->prepare($query);
    $statement->execute();
    $incidents = $statement->fetchAll();
    $statement->closeCursor();

} catch (PDOException $e) {
    $error_message = "Database error: " . $e->getMessage();
    $incidents = [];
}

include('../view/incidents/select_incident.php');