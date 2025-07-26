<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Incident</title>
    <link rel="stylesheet" href="/COMP3541_A3_Samar_Chauhan/css/main.css">
</head>
<body>
    <div class="content-box">
        <h1>Select Incident</h1>

        <?php if (isset($_GET['assigned']) && $_GET['assigned'] == 1): ?>
            <p class="success">Technician assigned successfully.</p>
        <?php endif; ?>

        <?php if (empty($incidents)) : ?>
            <?php if (!isset($_GET['assigned'])) : ?>
                <p class="error">No unassigned incidents found.</p>
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
                                <td><?php echo htmlspecialchars($incident['firstName'] . ' ' . $incident['lastName']); ?></td>
                                <td><?php echo htmlspecialchars($incident['productName']); ?></td>
                                <td><?php echo htmlspecialchars($incident['dateOpened']); ?></td>
                                <td><?php echo htmlspecialchars($incident['title']); ?></td>
                                <td><?php echo htmlspecialchars($incident['description']); ?></td>
                                <td>
                                    <form action="/COMP3541_A3_Samar_Chauhan/controller/assign_technician.php" method="post">
                                        <input type="hidden" name="incidentID" value="<?php echo $incident['incidentID']; ?>">
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
            <a href="/COMP3541_A3_Samar_Chauhan/index.php" class="btn">Home</a>
        </div>
    </div>
</body>
</html>