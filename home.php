<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SportsPro - User Selection</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="content-box">
        <!-- Centered Logo -->
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="images/logo.png" alt="SportsPro Logo" class="logo" style="max-height: 100px;">
        </div>

        <h1>Welcome to SportsPro Technical Support</h1>
        <p class="welcome-text">Please choose your role to log in:</p>

        <div class="card-container">
            <div class="card">
                <h2>Administrator</h2>
                <p>Manage products, customers, and incidents.</p>
                <a href="view/auth/login_admin.php" class="btn">Admin Login</a>
            </div>

            <div class="card">
                <h2>Technician</h2>
                <p>View and update assigned incidents.</p>
                <a href="view/technicians/login_technician.php" class="btn">Technician Login</a>
            </div>

            <div class="card">
                <h2>Customer</h2>
                <p>Register products under your account.</p>
                <a href="view/auth/login_customer.php" class="btn">Customer Login</a>
            </div>
        </div>
    </div>

    <footer class="footer">&copy; 2025 SportsPro Inc. All rights reserved.</footer>
</body>
</html>