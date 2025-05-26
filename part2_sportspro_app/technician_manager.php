<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('db.php');

// Handle delete
if (isset($_POST['delete_technician'])) {
    $tech_id = $_POST['tech_id'];
    $query = "DELETE FROM technicians WHERE techID = :tech_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':tech_id', $tech_id);
    $statement->execute();
    $statement->closeCursor();
}

// Get technicians
$query = 'SELECT * FROM technicians ORDER BY techID';
$statement = $db->prepare($query);
$statement->execute();
$technicians = $statement->fetchAll();
$statement->closeCursor();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Technician Manager</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <h1>Technician List</h1>
    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Password</th>
            <th>Action</th>
        </tr>
        <?php foreach ($technicians as $tech) : ?>
        <tr>
            <td><?php echo htmlspecialchars($tech['firstName']); ?></td>
            <td><?php echo htmlspecialchars($tech['lastName']); ?></td>
            <td><?php echo htmlspecialchars($tech['email']); ?></td>
            <td><?php echo htmlspecialchars($tech['phone']); ?></td>
            <td><?php echo htmlspecialchars($tech['password']); ?></td>
            <td>
                <form method="post" action="">
                    <input type="hidden" name="tech_id" value="<?php echo $tech['techID']; ?>">
                    <input type="submit" name="delete_technician" value="Delete">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <p><a href="technician_add.php">Add Technician</a></p>
    <p><a href="index.php">Home</a></p>
</body>
</html>