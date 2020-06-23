 <?php
 // name, username, and password of localhost database set into variables
 $servername = "localhost";
 $username = "root";
 $password = "";
 // Create connection between batebases
 $dbconnect = mysqli_connect($servername, $username, $password, '2020year13_omrikepes');
 // Check connection success
 if (!$dbconnect) {
     die("Connection failed: " . mysqli_connect_error());
 }
 ?>
