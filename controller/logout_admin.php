<?php
session_start();

// Unset all session variables and destroy the session
$_SESSION = [];
session_destroy();

// Redirect to admin login page
header("Location: /COMP3541_A3_Samar_Chauhan/home.php");
exit();