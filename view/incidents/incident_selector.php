<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Redirect to login if technician is not logged in
if (!isset($_SESSION['techID'])) {
    header("Location: ../view/auth/login_technician.php");
    exit();
}

require('../config/db.php');

$techID = $_SESSION['techID'];

// Query to get all incidents assigned to this technician that are not closed
$query = "SELECT * FROM incidents 
          WHERE techID = :techID AND dateClosed IS NULL 
          ORDER BY dateOpened DESC";

try {
    $statement = $db->prepare($query);
    $statement->bindValue(':techID', $techID);
    $statement->execute();
    $incidents = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
} catch (PDOException $e) {
    $incidents = [];
    $error_message = "Error fetching technician incidents: " . $e->getMessage();
}

// Load technician view
include('../view/incidents/tech_select_incident.php');