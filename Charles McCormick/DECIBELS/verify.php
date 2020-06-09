<?php
  //this page checks to see if the account entered exists in the database
  $username = $_POST['username'];
  $password = $_POST['password'];

  $user_sql = "SELECT * FROM users WHERE Username = '$username'";
  $user_qry = mysqli_query($dbconnect, $user_sql);
  $user_aa = mysqli_fetch_assoc($user_qry);

  $hash = $user_aa['Password'];

  //Begins a session if the username and password are correct
  if (password_verify($password, $hash)) {
  $_SESSION['beta'] = $user_aa['UserID'];
  header("Location:index.php?page=home");

  }

  else {
    //if account doesnt exist error
    header("Location:index.php?page=login&error");
  ?> <p>failed to enter password</p> <?php
  }

 ?>
