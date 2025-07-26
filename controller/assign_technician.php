<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require('../config/db.php');

// Redirect if no incidentID is available
if (!isset($_POST['incidentID']) && !isset($_SESSION['incidentID'])) {
    header("Location: ../view/incidents/select_incident.php");
    exit();
}

// Preserve incidentID in session if first time
if (isset($_POST['incidentID'])) {
    $_SESSION['incidentID'] = $_POST['incidentID'];
}
$incidentID = $_SESSION['incidentID'];

$error_message = '';
$success_message = '';

// Fetch the selected incident
try {
    $query = "SELECT * FROM incidents WHERE incidentID = :incidentID";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':incidentID', $incidentID);
    $stmt->execute();
    $incident = $stmt->fetch();
    $stmt->closeCursor();

    if (!$incident) {
        $error_message = "Incident not found.";
    }

    // Get all technicians
    $query = "SELECT techID, firstName, lastName FROM technicians ORDER BY lastName";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $technicians = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
} catch (PDOException $e) {
    $error_message = "Database error: " . $e->getMessage();
    $technicians = [];
}

// Assign technician if submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['techID'])) {
    $techID = $_POST['techID'];
    try {
        $updateQuery = "UPDATE incidents SET techID = :techID WHERE incidentID = :incidentID";
        $updateStmt = $db->prepare($updateQuery);
        $updateStmt->bindValue(':techID', $techID);
        $updateStmt->bindValue(':incidentID', $incidentID);
        $updateStmt->execute();
        $updateStmt->closeCursor();

        // Clear session and redirect
        unset($_SESSION['incidentID']);
        header("Location: ../view/incidents/select_incident.php?assigned=1");
        exit();
    } catch (PDOException $e) {
        $error_message = "Error assigning technician: " . $e->getMessage();
    }
}

// Load the view
include('../view/incidents/assign_technician.php');