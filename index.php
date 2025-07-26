<?php
session_start();
if (
    !isset($_SESSION['admin_logged_in']) &&
    !isset($_SESSION['techName']) &&
    !isset($_SESSION['customerName'])
) {
    header("Location: home.php");
    exit();
}

$loggedInMessage = '';
$showLogout = false;
$role = '';

// Determine the login status
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']) {
    $loggedInMessage = "Logged in as Administrator";
    $showLogout = true;
    $role = 'admin';
} elseif (isset($_SESSION['techName'])) {
    $loggedInMessage = "Logged in as Technician: " . htmlspecialchars($_SESSION['techName']);
    $showLogout = true;
    $role = 'technician';
} elseif (isset($_SESSION['customerName'])) {
    $loggedInMessage = "Logged in as Customer: " . htmlspecialchars($_SESSION['customerName']);
    $showLogout = true;
    $role = 'customer';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SportsPro Technical Support</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<header class="app-header">
    <div style="text-align: right;">
        <?php if ($showLogout): ?>
            <a href="controller/logout.php" class="btn">Logout</a>
        <?php endif; ?>
    </div>
</header>

<h1>Technical Support Portal</h1>
<p class="welcome-text">
    Welcome to the SportsPro support system.
</p>

<?php if ($loggedInMessage): ?>
    <p class="status-message"><?= $loggedInMessage ?></p>
<?php endif; ?>

<div class="card-container">
    <?php if ($role === 'admin'): ?>
        <div class="card"><h2>Manage Products</h2><a href="controller/product_manager.php" class="btn">Go</a></div>
        <div class="card"><h2>Manage Technicians</h2><a href="controller/technician_manager.php" class="btn">Go</a></div>
        <div class="card"><h2>Manage Customers</h2><a href="controller/customer_search.php" class="btn">Go</a></div>
        <div class="card"><h2>Assign Incidents</h2><a href="controller/incident_selector.php" class="btn">Go</a></div>
    <?php endif; ?>

    <?php if ($role === 'admin' || $role === 'technician'): ?>
        <div class="card"><h2>View Incidents</h2><a href="view/incidents/view_assigned_incidents.php" class="btn">Go</a></div>
    <?php endif; ?>

    <?php if ($role === 'admin' || $role === 'customer'): ?>
        <div class="card"><h2>Register Product</h2><a href="view/registration/get_customer.php" class="btn">Go</a></div>
        <div class="card"><h2>Create Incident</h2><a href="controller/get_customer.php" class="btn">Go</a></div>
    <?php endif; ?>
</div>

<footer class="footer">&copy; 2025 SportsPro Inc. All rights reserved.</footer>
</body>
</html>