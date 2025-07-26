<!DOCTYPE html>
<html>
<head>
    <title>Incidents by Product</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <h1>View Incidents by Product</h1>

    <form method="post" action="../../controller/incidents_by_product.php">
        <label>Select Product:</label>
        <select name="productCode">
            <option value="">-- Choose a Product --</option>
            <?php foreach ($products as $product): ?>
                <option value="<?php echo $product['productCode']; ?>"
                    <?php if ($productCode === $product['productCode']) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($product['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="View Incidents">
    </form>

    <?php if ($error_message): ?>
        <p style="color:red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <?php if (!empty($incidents)): ?>
        <h2>Incidents for Product</h2>
        <table border="1">
            <tr>
                <th>Customer Name</th>
                <th>Title</th>
                <th>Date Opened</th>
            </tr>
            <?php foreach ($incidents as $incident): ?>
                <tr>
                    <td><?php echo htmlspecialchars($incident['firstName'] . ' ' . $incident['lastName']); ?></td>
                    <td><?php echo htmlspecialchars($incident['title']); ?></td>
                    <td><?php echo htmlspecialchars($incident['dateOpened']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <p><a href="/COMP3541_A3_Samar_Chauhan/index.php">Home</a></p>
</body>
</html>