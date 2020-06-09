<?php
//This is the login inclusion page, in this page we run through the php and sql code needed to log the user in
if (isset($_POST['login-submit'])) {
  // code...
  //Since the user is actually visting this page and it is not included on a page where dbconnect is set, we need to require it on this page so that this page has access to the database
  require 'dbconnect.php';

  //Here we are setting the username and password equal to what the user has sent through the post array via the log in form
  $username = $_POST['username'];
  $password = $_POST['password'];

  //Here we are going to go through a series of error trials
  //First we are checking if the user has sent completed and filled out the form
  if (empty($username) || empty($password)) {
    // code...
    //If not then we are sending the user back to the login page with an error
    header("Location: index.php?page=login&error=emptyfields");
    exit();
  }
  else {
    // code...
    // If not then we are querying the database, however we are setting the usernames value to a placeholder
    // We are doing this to protect from mysqli injections that may try to hack our database
    $sql = "SELECT * FROM users WHERE username=? ";
    // Here we are initating a statement
    $stmt = mysqli_stmt_init($dbconnect);
    // Here we are checking if the statment fails
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      // code...
      // If the stament is not safe then we redirect them back to the login page with an error
      header("Location: index.php?page=login&error=sqlerror");
      exit();
    }
    else {
      // code...
      // else we are binding the placeholder to a string = to the value of $username
      mysqli_stmt_bind_param($stmt, "s", $username);
      // now we are executing the orignial sql query
      mysqli_stmt_execute($stmt);
      // We are now getting the results of it and storing it as the variale $result
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        // code...
        // Here we are comparing the user's entered password to the stored hashed password of the user
        $passwordCheck = password_verify($password, $row['password']);
        if ($passwordCheck == false) {
          // code...
          // If the entered password does not equal the hashed password then the user is sent back to the login screen with a wrongpassword error
          header("Location: index.php?page=login&error=wrongpassword");
          exit();
        }
        elseif ($passwordCheck == True) {
          // code...
          // If the enetered password does match the stored password then we do the following
          // First we start the session so that can store some variables
          session_start();
          // Here we are storing some information about the user in the session
          $_SESSION['userID'] = $row['userID'];
          $_SESSION['username'] = $row['username'];
          $_SESSION['userImage'] = $row['userImage'];
          $_SESSION['admin'] = $row['admin'];

          // Finally we send them back to the index page and they are now succesfully logged in
          header("Location: index.php?login=success");
          exit();

        }else {
          // code...
          // Here I have decided to have the else statement not to log the user in just incase anything goes wrong
          header("Location: index.php?error=wrongpassword");
          exit();
        }
      }
      else {
        // code...
        // If there is no such user then we send them back to the login page with an error
        header("Location: index.php?page=login&error=nouser");
        exit();
      }
    }
  }
}
else {
  // code...
  // If the user has not even clicked the login button and has got to this page some other way then we send them back to the login page
  header("Location: index.php?page=login");
}




 ?>
