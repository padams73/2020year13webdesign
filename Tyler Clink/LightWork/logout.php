<!--This page is to log the user out of the admin page-->

<!--End the session and returns them to the index page (home) and if the user try to log back in they need a username and password-->
<?php
  session_start();
  unset($_SESSION['admin']);
  header("Location:index.php");
 ?>
