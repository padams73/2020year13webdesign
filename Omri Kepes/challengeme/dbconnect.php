 <?php
 // name, username, and password of localhost database set into variables
 $servername = "localhost";
 $username = "root";
 $password = "root";
 // Create connection between batebases
 $dbconnect = mysqli_connect($servername, $username, $password, 'challengeme');
 // Check connection success
 if (!$dbconnect) {
     die("Connection failed: " . mysqli_connect_error());
 }
 ?>
