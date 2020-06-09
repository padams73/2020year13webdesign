<?php
//conect to data base
  include('dbconect.php');
//start sesion and setting the variables
  session_start();
  $username = $_POST['username'];
  $password = $_POST['password'];


//verifying if the input they put in is a password in the database and if there username is in the data base.
  $verify_sql = "SELECT userID, username, password FROM user
  WHERE username = '$username'";
  $verify_qry = mysqli_query($dbconect, $verify_sql);
  $verify_aa = mysqli_fetch_assoc($verify_qry);
//hashing the password so you can see if the hash passwords in the data XMLDiff\Base
  $hash = $verify_aa['password'];
//if the username and password is right it will log them in
  if(password_verify($password,$hash)){
    $_SESSION['admin'] = $verify_aa['userID'];
//then it will send them to the admin page
    header("Location: index.php?page=admin");
//if you get it wrong it will send you back to the log in page
  }else {
    header("Location: index.php?page=login&error=error");
  }

 ?>
