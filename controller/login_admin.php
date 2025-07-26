<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === 'admin' && $password === 'sesame') {
        $_SESSION['admin_logged_in'] = true;
        header("Location: /COMP3541_A3_Samar_Chauhan/index.php");
        exit();
    } else {
        header("Location: /COMP3541_A3_Samar_Chauhan/view/auth/login_admin.php?error=1");
        exit();
    }
} else {
    header("Location: /COMP3541_A3_Samar_Chauhan/view/auth/login_admin.php");
    exit();
}