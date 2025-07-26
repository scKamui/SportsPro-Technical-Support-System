<?php
session_start();
session_unset(); // clear session variables
session_destroy(); // destroy the session

// Redirect to technician login page
header("Location: /COMP3541_A3_Samar_Chauhan/view/technicians/login_technician.php");
exit();