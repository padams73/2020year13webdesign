<?php
//encrypts the password  to give the user privacy
$hash = password_hash("password", PASSWORD_DEFAULT);
echo $hash;
 ?>
