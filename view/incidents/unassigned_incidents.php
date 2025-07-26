<?php
// incident_display_unassigned.php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
require('../../config/db.php');

$query = "
    SELECT i.incidentID, i.title, i.description, i.dateOpened,
           c.firstName AS customerFirstName, c.lastName AS customerLastName,
           p.name AS productName
    FROM incidents i
    JOIN customers c ON i.customerID = c.customerID
    JOIN products p ON i.productCode = p.productCode
    WHERE i.techID IS NULL
    ORDER BY i.dateOpened DESC
";

$statement = $db->prepare($query);
$statement->execute();
$incidents = $statement->fetchAll();
$statement->closeCursor();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Unassigned Incidents</title>
    <link rel="stylesheet" href="/COMP3541_A3_Samar_Chauhan/css/main.css">
</head>
<body>
    <div class="content-box">
        <h1>Unassigned Incidents</h1>

        <?php if (empty($incidents)) : ?>
            <p class="error">No unassigned incidents found.</p>
        <?php else : ?>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Incident ID</th>
                            <th>Date Opened</th>
                            <th>Title</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($incidents as $incident) : ?>
                            <tr>
                                <td><?= htmlspecialchars($incident['customerFirstName'] . ' ' . $incident['customerLastName']) ?></td>
                                <td><?= htmlspecialchars($incident['productName']) ?></td>
                                <td><?= htmlspecialchars($incident['incidentID']) ?></td>
                                <td><?= htmlspecialchars($incident['dateOpened']) ?></td>
                                <td><?= htmlspecialchars($incident['title']) ?></td>
                                <td><?= htmlspecialchars($incident['description']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <div class="button-group">
            <a href="/COMP3541_A3_Samar_Chauhan/index.php" class="btn">Home</a>
        </div>
    </div>
</body>
</html>