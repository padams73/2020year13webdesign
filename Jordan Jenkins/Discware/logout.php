<?php
// when the user clicks logout, session is destroyed, and all the variables are cleared
session_destroy();
// the user is then redirected to the home page after the session is destroyed
header("Location: index.php");
?>