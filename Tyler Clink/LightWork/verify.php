<!--This page verifies the user's username and password-->

<?php
  session_start();
  $username = $_POST['username'];
  $password = $_POST['password'];

  //runs a sql query to get the username and password from the database based off the username they entered
  $verify_sql = "SELECT username, password FROM user WHERE username='$username'";
  $verify_qry= mysqli_query($dbconnect, $verify_sql);
  $verify_aa= mysqli_fetch_assoc($verify_qry);

  //hashes the password to see if matches what is in the database
  $hash = $verify_aa['password'];

  //if the username and password is correct then it grants access to the admin page, if it does not then it returns and error to the user
  if (password_verify($password, $hash)) {
    $_SESSION['admin'] = "$username";
    header("Location: index.php?page=admin");
  } else {
    header("Location: index.php?page=login&error=error");
    }
?>
