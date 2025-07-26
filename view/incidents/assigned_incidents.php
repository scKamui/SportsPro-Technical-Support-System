<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require('../../config/db.php');

// Redirect if technician not logged in
if (!isset($_SESSION['techID'])) {
    header("Location: ../../view/technicians/technician_login.php");
    exit();
}

$techID = $_SESSION['techID'];

// Fetch assigned incidents
$query = "
    SELECT i.*, c.firstName, c.lastName, p.name AS productName
    FROM incidents i
    JOIN customers c ON i.customerID = c.customerID
    JOIN products p ON i.productCode = p.productCode
    WHERE i.techID = :techID
    ORDER BY i.dateOpened DESC
";

$statement = $db->prepare($query);
$statement->bindValue(':techID', $techID);
$statement->execute();
$incidents = $statement->fetchAll(PDO::FETCH_ASSOC);
$statement->closeCursor();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Assigned Incidents</title>
    <link rel="stylesheet" href="/COMP3541_A3_Samar_Chauhan/css/main.css">
</head>
<body>
    <div class="content-box">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['techName']); ?></h1>
        <h2>Your Assigned Incidents</h2>

        <?php if (empty($incidents)) : ?>
            <p class="error">No incidents assigned to you.</p>
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($incidents as $incident) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($incident['firstName'] . ' ' . $incident['lastName']); ?></td>
                                <td><?php echo htmlspecialchars($incident['productName']); ?></td>
                                <td><?php echo htmlspecialchars($incident['dateOpened']); ?></td>
                                <td><?php echo htmlspecialchars($incident['title']); ?></td>
                                <td><?php echo htmlspecialchars($incident['description']); ?></td>
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