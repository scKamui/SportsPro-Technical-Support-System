<?php
session_start();
session_unset();
session_destroy();
header("Location: /COMP3541_A3_Samar_Chauhan/home.php");
exit();