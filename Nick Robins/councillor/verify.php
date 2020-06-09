<!-- This page verifies the person logging into the site is authorized -->

<?php
  session_start(); // Starting the session for the login
  include("dbconnect.php"); // Connecting to database
  $username = $_POST['uname'];
  $password = $_POST['psw'];

// Setting up variables and sql

  $verify_sql = "SELECT username, password FROM user WHERE username='$username'";
  $verify_qry = mysqli_query($dbconnect, $verify_sql);
  $verify_aa = mysqli_fetch_assoc($verify_qry);

  $hash = $verify_aa['password']; // This checks the password entered against the hashed version

// This IF Statement checks if the person logging in is valid or not

  if (password_verify($password, $hash)) {
    $_SESSION['admin'] = "$username";
    header("Location: admin.php");

  } else{
     header("Location: login.php");



  }


 ?>
