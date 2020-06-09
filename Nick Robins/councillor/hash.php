<!-- This page allows you to check what the hashed password is -->

<?php
$hash = password_hash("password", PASSWORD_DEFAULT);
echo $hash;


 ?>
