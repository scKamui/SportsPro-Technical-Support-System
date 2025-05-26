<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SportsPro Technical Support</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <!-- Header with Logo -->
    <header class="app-header">
        <img src="images/logo.png" alt="SportsPro Logo" class="logo">
    </header>

    <!-- Main Title -->
    <h1>Technical Support Portal</h1>
    <p class="welcome-text">
        Welcome to the SportsPro support system. Use the tools below to efficiently manage products, technicians, customer accounts, or service incidents.
    </p>

    <!-- Optional Dashboard Stats -->
    <div class="dashboard-summary">
        <div class="summary-box">5 Products</div>
        <div class="summary-box">12 Technicians</div>
        <div class="summary-box">38 Customers</div>
        <div class="summary-box">16 Incidents</div>
    </div>

    <!-- Navigation Cards -->
    <div class="card-container">
        <div class="card">
            <h2>Manage Products</h2>
            <p>Add, delete, or view product records in the system.</p>
            <a href="product_manager.php" class="btn">Go</a>
        </div>

        <div class="card">
            <h2>Manage Technicians</h2>
            <p>Add or remove technical support agents from the database.</p>
            <a href="technician_manager.php" class="btn">Go</a>
        </div>

        <div class="card">
            <h2>Manage Customers</h2>
            <p>Search for customers and update their account info.</p>
            <a href="customer_search.php" class="btn">Go</a>
        </div>

        <div class="card">
            <h2>Register Product</h2>
            <p>Allow customers to register products under their accounts.</p>
            <a href="product_register/login.php" class="btn">Go</a>
        </div>

        <div class="card">
            <h2>Create Incident</h2>
            <p>Log support issues for registered products on behalf of customers.</p>
            <a href="incident_create/get_customer.php" class="btn">Go</a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        &copy; 2025 SportsPro Inc. All rights reserved.
    </footer>
</body>
</html>