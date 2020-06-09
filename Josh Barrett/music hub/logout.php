<?php
//this logs the user out, we are unsetting the admin variable and then puting them back to index
  session_start();
  unset($_SESSION['admin']);
  header("Location: index.php");
 ?>
