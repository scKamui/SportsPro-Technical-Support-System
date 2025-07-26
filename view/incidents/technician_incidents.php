<?php
if (session_status() === PHP_SESSION_NONE) session_start();

// Redirect if not logged in
if (!isset($_SESSION['techID'])) {
    header("Location: ../technicians/login_technician.php");
    exit();
}

require('../../config/db.php');

$techID = $_SESSION['techID'];
$techName = $_SESSION['techName'] ?? 'Technician';

// Fetch open incidents assigned to the technician
$query = "SELECT * FROM incidents 
          WHERE techID = :techID AND dateClosed IS NULL
          ORDER BY dateOpened ASC";
$statement = $db->prepare($query);
$statement->bindValue(':techID', $techID);
$statement->execute();
$incidents = $statement->fetchAll(PDO::FETCH_ASSOC);
$statement->closeCursor();

// Check if there are newly assigned incidents (last 24 hours)
$newIncidentQuery = "SELECT COUNT(*) FROM incidents 
                     WHERE techID = :techID AND dateClosed IS NULL 
                     AND dateOpened >= NOW() - INTERVAL 1 DAY";
$newIncidentStmt = $db->prepare($newIncidentQuery);
$newIncidentStmt->bindValue(':techID', $techID);
$newIncidentStmt->execute();
$newIncidentsCount = $newIncidentStmt->fetchColumn();
$newIncidentStmt->closeCursor();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Technician Incidents</title>
    <link rel="stylesheet" href="/COMP3541_A3_Samar_Chauhan/css/main.css">
</head>
<body>
    <div class="content-box">
        <h1>Select Incident</h1>

        <p class="welcome-text">You are logged in as <strong><?= htmlspecialchars($techName) ?></strong></p>

        <?php if (empty($incidents)) : ?>
            <p class="error">There are no open incidents assigned to you.</p>
            <?php if ($newIncidentsCount > 0) : ?>
                <p><a href="/COMP3541_A3_Samar_Chauhan/view/incidents/view_assigned_incidents.php" class="btn">View New Incidents</a></p>
            <?php endif; ?>
        <?php else : ?>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Date Opened</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($incidents as $incident) : ?>
                            <tr>
                                <td><?= htmlspecialchars($incident['customerID']) ?></td>
                                <td><?= htmlspecialchars($incident['productCode']) ?></td>
                                <td><?= htmlspecialchars($incident['dateOpened']) ?></td>
                                <td><?= htmlspecialchars($incident['title']) ?></td>
                                <td><?= htmlspecialchars($incident['description']) ?></td>
                                <td>
                                    <form action="/COMP3541_A3_Samar_Chauhan/view/incidents/update_incident.php" method="post">
                                        <input type="hidden" name="incidentID" value="<?= $incident['incidentID'] ?>">
                                        <input type="submit" value="Select" class="btn">
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <div class="button-group">
            <a href="/COMP3541_A3_Samar_Chauhan/controller/logout_technician.php" class="btn">Logout</a>
        </div>
    </div>
</body>
</html>