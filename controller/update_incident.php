<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require('../config/db.php');

// Check if submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $incidentID = $_POST['incidentID'] ?? null;
    $dateClosed = $_POST['dateClosed'] ?? null;
    $description = $_POST['description'] ?? '';

    if ($incidentID && $description) {
        try {
            $query = "UPDATE incidents 
                      SET description = :description, dateClosed = :dateClosed 
                      WHERE incidentID = :incidentID";
            $stmt = $db->prepare($query);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':dateClosed', $dateClosed ?: null); // null if empty
            $stmt->bindValue(':incidentID', $incidentID);
            $stmt->execute();
            $stmt->closeCursor();

            // Redirect with success message
            header("Location: /COMP3541_A3_Samar_Chauhan/view/incidents/technician_incidents.php?updated=1");
            exit();
        } catch (PDOException $e) {
            die("Error updating incident: " . $e->getMessage());
        }
    } else {
        header("Location: /COMP3541_A3_Samar_Chauhan/view/incidents/technician_incidents.php?error=1");
        exit();
    }
} else {
    header("Location: /COMP3541_A3_Samar_Chauhan/index.php");
    exit();
}