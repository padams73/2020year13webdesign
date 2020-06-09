<?php
  //In this page we connect to the database
  //First we connect to the database and store it as a variable to be used later
  $dbconnect = mysqli_connect("localhost", "root", "", "bounding salmon");

  //If the connection fails the code will throw an error
  if (!$dbconnect) {
    // code...
    die("Connection failed: ".mysqli_connect_error());
  }
 ?>
