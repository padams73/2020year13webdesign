<?php
// check to see of session is set
session_start();
// if session isn't set then redirect to the login page with error message
if (!isset($_SESSION['userID'])) {
  Header("Location: index.php?page=login&error=notsetMyAccount");
}else{
// unset the current session and destory it (log out)
session_unset();
session_destroy();
// send the user to the login page
header("Location: index.php?page=login");
}
 ?>
