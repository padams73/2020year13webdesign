<?php
  session_start();//This begins the session of logging out a user.
  unset($_SESSION['user']);//This stops the session of the user.
  header("Location:index.php");//This directs the user back to the index page.

 ?>
