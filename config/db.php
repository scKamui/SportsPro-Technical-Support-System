<?php
$dsn = 'mysql:host=localhost;dbname=tech_support';
$username = 'root';
$password = '';

try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo "Database error: " . $error_message;
    exit();
}
?>