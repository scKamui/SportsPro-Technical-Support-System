
<?php
include($_SERVER['DOCUMENT_ROOT'] . '/COMP3541_A3_Samar_Chauhan/includes/secure_admin.php');
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: /COMP3541_A3_Samar_Chauhan/view/auth/login_admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/COMP3541_A3_Samar_Chauhan/css/main.css">
</head>
<body>
    <div class="content-box">
        <h1>Welcome, Admin</h1>
        <p class="welcome-text">You are logged in as the administrator.</p>

        <div class="card-container">
            <div class="card">
                <h2>Manage Products</h2>
                <a href="/COMP3541_A3_Samar_Chauhan/controller/product_manager.php" class="btn">Go</a>
            </div>

            <div class="card">
                <h2>Manage Technicians</h2>
                <a href="/COMP3541_A3_Samar_Chauhan/controller/technician_manager.php" class="btn">Go</a>
            </div>

            <div class="card">
                <h2>Manage Customers</h2>
                <a href="/COMP3541_A3_Samar_Chauhan/controller/customer_search.php" class="btn">Go</a>
            </div>

            <div class="card">
                <h2>View All Incidents</h2>
                <a href="/COMP3541_A3_Samar_Chauhan/view/incidents/view_assigned_incidents.php" class="btn">Go</a>
            </div>
        </div>

        <div class="button-group">
            <a href="/COMP3541_A3_Samar_Chauhan/controller/logout_admin.php" class="btn">Logout</a>
        </div>
    </div>
</body>
</html>