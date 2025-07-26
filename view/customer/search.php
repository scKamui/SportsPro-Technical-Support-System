<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Search</title>
    <link rel="stylesheet" href="/COMP3541_A3_Samar_Chauhan/css/main.css">
</head>
<body>
    <div class="content-box">
        <h1>Customer Search</h1>

        <form method="post" action="/COMP3541_A3_Samar_Chauhan/controller/customer_search.php" class="form-inline">
            <label for="lastName">Last Name:</label>
            <input type="text" name="lastName" id="lastName" value="<?= htmlspecialchars($lastName) ?>" required>
            <input type="submit" value="Search" class="btn">
        </form>

        <?php if (!empty($customers)) : ?>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email Address</th>
                            <th>City</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($customers as $customer) : ?>
                            <tr>
                                <td><?= htmlspecialchars($customer['firstName'] . ' ' . $customer['lastName']) ?></td>
                                <td><?= htmlspecialchars($customer['email']) ?></td>
                                <td><?= htmlspecialchars($customer['city']) ?></td>
                                <td>
                                    <form method="post" action="/COMP3541_A3_Samar_Chauhan/controller/customer_edit.php">
                                        <input type="hidden" name="customerID" value="<?= $customer['customerID'] ?>">
                                        <input type="submit" value="Select" class="btn">
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
            <p class="error">No customers found with the last name "<strong><?= htmlspecialchars($lastName) ?></strong>".</p>
        <?php endif; ?>

        <div class="button-group">
            <a href="/COMP3541_A3_Samar_Chauhan/controller/customer_add.php" class="btn">Add New Customer</a>
            <a href="/COMP3541_A3_Samar_Chauhan/index.php" class="btn">Home</a>
        </div>
    </div>
</body>
</html>