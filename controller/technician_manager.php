<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../config/db.php');

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Technician Manager</title>
    <link rel="stylesheet" href="../css/main.css">
    <style>
        table {
            margin: 2rem auto;
            border-collapse: collapse;
            width: 95%;
            background-color: #111;
        }

        th, td {
            border: 1px solid #444;
            padding: 0.75rem;
            text-align: left;
            color: #fff;
        }

        th {
            background-color: #1a1a1a;
            color: #e60000;
        }

        tr:nth-child(even) {
            background-color: #1c1c1c;
        }

        form {
            display: inline;
        }

        input[type="submit"] {
            background-color: #e60000;
            color: white;
            border: none;
            padding: 0.4rem 1rem;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #ff1a1a;
        }

        .button-group {
            text-align: center;
            margin-top: 2rem;
        }

        .button-group a {
            margin: 0 1rem;
            color: #fff;
            text-decoration: none;
            background-color: #e60000;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            font-weight: bold;
        }

        .button-group a:hover {
            background-color: #ff1a1a;
        }

        h1 {
            text-align: center;
            color: #e60000;
            margin-top: 1rem;
            margin-bottom: 2rem;
        }
    </style>
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

    <div class="button-group">
        <a href="technician_add.php">Add Technician</a>
        <a href="/COMP3541_A3_Samar_Chauhan/index.php">Home</a>
    </div>
</body>
</html>