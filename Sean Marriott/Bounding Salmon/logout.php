<?php
// This is the logout page, this page logs the user out, unsets all the session variables, destroys the session and finally sends them back to the login page
session_start();
session_unset();
session_destroy();
header("Location: index.php?page=login")
 ?>
