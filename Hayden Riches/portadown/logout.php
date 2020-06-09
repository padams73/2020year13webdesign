<?php
// logs the user out
session_start();
unset($_SESSION['admin']);
// redirects to the login page
header("Location: login.php");
?>
