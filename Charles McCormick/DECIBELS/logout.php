<?php
//ends the session
if (isset($_SESSION['beta'])) {
  unset($_SESSION['beta']);
  header("Location:index.php?page=home");

  // code...
}
  else {
    header("Location:index.php?page=home");

  }
?>
