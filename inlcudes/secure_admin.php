<?php
// includes/secure_admin.php

session_start();

// Ensure connection is secure (HTTPS only) — optional but recommended
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
    // Redirect to HTTPS version of the page (optional for local development)
    // header("Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    // exit();
}

// Check if the user is logged in as an admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Not authorized — redirect to the main menu
    header("Location: /COMP3541_A3_Samar_Chauhan/home.php");
    exit();
}
?>