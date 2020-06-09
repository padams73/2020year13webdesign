<?php
// this page verifys a user as they try to login
// set the varibles username and password to the entered password and username
  $username = $_POST['username'];
  // protecting against sql injection
  $username = mysqli_real_escape_string($dbconnect, $username);
  $password = $_POST['password'];
  // protecting against sql injection
  $password = mysqli_real_escape_string($dbconnect, $password);

// select from the database where the username is the same as the entered username
  $user_sql = "SELECT * FROM user WHERE username='$username'";
  // run mysql query
  $user_qry = mysqli_query($dbconnect, $user_sql);
  // put results into an array
  $user_aa = mysqli_fetch_assoc($user_qry);
  // assign variables userID and has for the userID and password of that username (password is hashed)
  $userID = $user_aa['userID'];
  $hash = $user_aa['password'];
  // if the password is correct
  if(password_verify($password, $hash)) {
    // select from the database where the userID=the userID of that user
    $user_sql = "SELECT * FROM user WHERE userID='$userID'";
    // run mysql query
    $user_qry = mysqli_query($dbconnect, $user_sql);
    // put results into an array
    $user_aa = mysqli_fetch_assoc($user_qry);
    // assign variables for the results
    $level = $user_aa['level'];
    $username = $user_aa['username'];
    $activeUserID = $user_aa['userID'];
    // if the variable 'level' is ==0 then the account is a user
    if ($level==0) {
      // start a session where the username, userID and level are set
      session_start();
      // assign the values depending on the values selected earlier
      $_SESSION['username'] = "$username";
      $_SESSION['userID'] = "$activeUserID";
      $_SESSION['user'] = "$username";
      // send user to the home page
      header("Location:index.php?page=home");
      // elseif the level==1 the account is an admin
    } elseif ($level==1){
      // start session where the username, userID, and level are set
      session_start();
      //assign the session variables depending on the variables selected
      $_SESSION['admin'] = "$username";
      $_SESSION['userID'] = "$activeUserID";
      $_SESSION['username'] = "$username";
      // send user to the home page as an admin
      header("Location:index.php?page=home");
    } else {
      // else if wrong, send to login page with error message as 'incorrect'
      header("Location:index.php?page=login&error=incorrect");
    }
  } else {
    header("Location:index.php?page=login&error=incorrect");
  }

 ?>
