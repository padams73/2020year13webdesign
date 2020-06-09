<!--This page is a simple hash encryption so that we can protect our passwords on our database-->
<?php
  $hash = password_hash("123", PASSWORD_DEFAULT);
  echo $hash;
 ?>
