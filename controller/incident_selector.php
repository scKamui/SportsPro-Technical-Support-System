<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require('../config/db.php');

$error_message = '';
$incidents = [];

try {
    $query = "
        SELECT 
            incidents.incidentID, 
            customers.firstName, 
            customers.lastName, 
            products.name AS productName, 
            incidents.dateOpened, 
            incidents.title, 
            incidents.description
        FROM incidents
        JOIN customers ON incidents.customerID = customers.customerID
        JOIN products ON incidents.productCode = products.productCode
        WHERE incidents.techID IS NULL
        ORDER BY incidents.dateOpened
    ";

    $statement = $db->prepare($query);
    $statement->execute();
    $incidents = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();

} catch (PDOException $e) {
    $error_message = "Error fetching incidents: " . $e->getMessage();
}

// Load the view
include('../view/incidents/select_incident.php');