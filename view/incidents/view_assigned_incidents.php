<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require('../../config/db.php');

// Fetch incidents that have been assigned a technician
$query = "SELECT i.incidentID, i.title, i.description, i.dateOpened, i.dateClosed,
                c.firstName AS customerFirstName, c.lastName AS customerLastName,
                t.firstName AS techFirstName, t.lastName AS techLastName,
                p.name AS productName
          FROM incidents i
          JOIN customers c ON i.customerID = c.customerID
          JOIN technicians t ON i.techID = t.techID
          JOIN products p ON i.productCode = p.productCode
          WHERE i.techID IS NOT NULL
          ORDER BY i.dateOpened DESC";

try {
    $statement = $db->prepare($query);
    $statement->execute();
    $assignedIncidents = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
} catch (PDOException $e) {
    $assignedIncidents = [];
    $error_message = "Error fetching assigned incidents: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assigned Incidents</title>
    <link rel="stylesheet" href="/COMP3541_A3_Samar_Chauhan/css/main.css">
</head>
<body>
    <div class="content-box">
        <h1>Assigned Incidents</h1>

        <?php if (!empty($error_message)) : ?>
            <p class="error"><?= htmlspecialchars($error_message) ?></p>
        <?php elseif (empty($assignedIncidents)) : ?>
            <p class="error">No incidents have been assigned yet.</p>
        <?php else : ?>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Incident ID</th>
                            <th>Date Opened</th>
                            <th>Date Closed</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Technician</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($assignedIncidents as $incident) : ?>
                            <tr>
                                <td><?= htmlspecialchars($incident['customerFirstName'] . ' ' . $incident['customerLastName']) ?></td>
                                <td><?= htmlspecialchars($incident['productName']) ?></td>
                                <td><?= htmlspecialchars($incident['incidentID']) ?></td>
                                <td><?= htmlspecialchars($incident['dateOpened']) ?></td>
                                <td><?= $incident['dateClosed'] ? htmlspecialchars($incident['dateClosed']) : 'OPEN' ?></td>
                                <td><?= htmlspecialchars($incident['title']) ?></td>
                                <td><?= htmlspecialchars($incident['description']) ?></td>
                                <td><?= htmlspecialchars($incident['techFirstName'] . ' ' . $incident['techLastName']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <div class="button-group">
            <a href="/COMP3541_A3_Samar_Chauhan/view/incidents/unassigned_incidents.php" class="btn">View Unassigned Incidents</a>
            <a href="/COMP3541_A3_Samar_Chauhan/index.php" class="btn">Home</a>
        </div>
    </div>
</body>
</html>