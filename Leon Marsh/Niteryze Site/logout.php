<?php
// unsets the session so the user will have to login again
  session_start();
  unset($_SESSION['admin']);
  // then puts them back on the index page
  header("Location: index.php");
 ?>
