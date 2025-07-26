<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assign Technician</title>
    <link rel="stylesheet" href="/COMP3541_A3_Samar_Chauhan/css/main.css">
</head>
<body>
    <!-- Header -->
    <header class="app-header">
        <img src="/COMP3541_A3_Samar_Chauhan/images/logo.png" alt="SportsPro Logo" class="logo">
    </header>

    <div class="form-box">
        <h1>Assign Technician</h1>

        <?php if (!empty($error_message)) : ?>
            <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
        <?php elseif (!empty($success_message)) : ?>
            <p class="success"><?php echo htmlspecialchars($success_message); ?></p>
        <?php else : ?>
            <div class="form-details" style="text-align: left; margin-bottom: 1.5rem;">
                <p><strong>Incident:</strong> <?php echo htmlspecialchars($incident['title']); ?></p>
                <p><strong>Description:</strong> <?php echo htmlspecialchars($incident['description']); ?></p>
            </div>

            <form method="post" action="">
                <input type="hidden" name="incidentID" value="<?php echo $incident['incidentID']; ?>">

                <label for="techID">Select Technician:</label>
                <select name="techID" id="techID" required>
                    <option value="">-- Select Technician --</option>
                    <?php foreach ($technicians as $tech) : ?>
                        <option value="<?php echo $tech['techID']; ?>">
                            <?php echo htmlspecialchars($tech['firstName'] . ' ' . $tech['lastName']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <div class="incident-buttons">
                    <input type="submit" value="Assign Technician" class="btn">
                    <a href="/COMP3541_A3_Samar_Chauhan/controller/incident_selector.php" class="btn-link">Cancel</a>
                </div>
            </form>
        <?php endif; ?>
    </div>

    <footer class="footer">
        &copy; 2025 SportsPro Inc.
    </footer>
</body>
</html>