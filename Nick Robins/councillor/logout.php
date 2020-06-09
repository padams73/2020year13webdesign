<!-- This page logs you out of the site -->

<?php
  session_start();
  unset($_SESSION['admin']); // Unsetting the session/shutting it down
  header("Location: index.php");



 ?>
