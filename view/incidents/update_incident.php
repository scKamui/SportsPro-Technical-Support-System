<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['techID'])) {
    header("Location: ../technicians/login_technician.php");
    exit();
}

require('../../config/db.php');

// Validate incidentID from POST
if (!isset($_POST['incidentID'])) {
    header("Location: technician_incidents.php");
    exit();
}

$incidentID = $_POST['incidentID'];

// Fetch incident details
$query = "SELECT * FROM incidents WHERE incidentID = :incidentID";
$statement = $db->prepare($query);
$statement->bindValue(':incidentID', $incidentID);
$statement->execute();
$incident = $statement->fetch();
$statement->closeCursor();

if (!$incident) {
    echo "<p class='error'>Incident not found.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Incident</title>
    <link rel="stylesheet" href="/COMP3541_A3_Samar_Chauhan/css/main.css">
</head>
<body>
<div class="content-box">
    <h1>Update Incident</h1>

    <form action="../../controller/update_incident.php" method="post">
        <input type="hidden" name="incidentID" value="<?= $incident['incidentID'] ?>">

        <label>Product Code:</label>
        <input type="text" value="<?= htmlspecialchars($incident['productCode']) ?>" disabled><br>

        <label>Date Opened:</label>
        <input type="text" value="<?= htmlspecialchars($incident['dateOpened']) ?>" disabled><br>

        <label for="dateClosed">Date Closed:</label>
        <input type="date" name="dateClosed" id="dateClosed"><br>

        <label for="description">Description:</label><br>
        <textarea name="description" id="description" rows="5" cols="50"><?= htmlspecialchars($incident['description']) ?></textarea><br><br>

        <input type="submit" value="Update Incident" class="btn">
        <a href="technician_incidents.php" class="btn">Cancel</a>
    </form>
</div>
</body>
</html>