<?php
// starts session
 session_start();
 // connects to the database
 include("dbconnect.php");
 // pulls the username and password entered on the login page using post
 $username = $_POST['username'];
 $password = $_POST['password'];
 // selects all data from the user table where the username = the entered username
 $user_sql = "SELECT * FROM user WHERE username='$username'";
 $user_qry = mysqli_query($dbconnect, $user_sql);
 $user_aa = mysqli_fetch_assoc($user_qry);
 //gets the password
 $hash = $user_aa['password'];
 // if username and password are correct then it will allow the user into the admin panel
 if(password_verify($password, $hash)) {
   $_SESSION['admin'] = "$username";
   header("Location:index.php?page=adminpanel");
 } else {
   // if the user gets the name or password wrong they will be booted to index
  header("Location:index.php");
 }
 ?>
