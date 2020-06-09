<?php
// starting a session
session_start();
// unsetting the variable '$_SESSION' which makes the user log out
unset($_SESSION['loggedin']);
unset($_SESSION['userid']);
// then the user gets sent to the home page using the header(Location:Index.php)
header("Location:index.php");
 ?>
