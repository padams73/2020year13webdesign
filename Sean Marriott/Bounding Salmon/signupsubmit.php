<?php
// This is the signup inclusion page, this page contains all of the php and sql code to sign a new user up to the website and store them in our database
// First we need to include the dbconnect page so that this page can access the database
include("dbconnect.php");
// Next we check if the user has actually hit the signup submit button
if (isset($_POST['signup-submit'])) {
  // code...
  // If the user has then we store the required information about the user in some variables
  $username = $_POST['username'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirm-password'];
  $profilePicture = $_POST['profile-picture'];
  // Signing a user up through the website will mean that they do not have admin privilleges
  $admin = 0;

  // We now send the information enetered through a series of checks
  // First we check that the user has acutally entered something in for the required fields
  if (empty($username) || empty($password) || empty($confirmPassword) || empty($profilePicture)) {
    // code...
    // If not then the user is redirected to the signup page with an error stating that they have emptyfields
    header("Location: index.php?page=signup&error=emptyfields");
    exit();
  }
  //Next we check if the username is allowed characters
  elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username )) {
    // code...
    // If it is not then we send them back to the signup page with an error stating that they have entered an invalid username
    header("Location: index.php?page=signup&error=invalidusername");
    exit();
  }
  // Next we check if the user has entered the csame password twice
  elseif ($password !== $confirmPassword) {
    // code...
    // If not then we send them back to the signup page with an error stating that they have enetred different passwords
    header("Location: index.php?page=signup&error=passwordcheck");
    exit();
  }
  else {
    // code...
    // If they pass these checks then we start to prepare the query for the database that will check if the username is taken
    // First we set up a variable that contains the sql query that we will send to the database
    // We set up the query with a placeholder first
    $sql = "SELECT username FROM users WHERE username=?";
    // We will send over a statement frst to protect from mysqli injections
    $stmt = mysqli_stmt_init($dbconnect);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      // code...
      // If the stament fails then we send them back to the signup page with an error stating that they have an sql error
      header("Location: index.php?page=signup&error=sqlerror");
      exit();
    }
    else {
      // If the query is safe then we bind the enetered username to the placeholder
      mysqli_stmt_bind_param($stmt, "s", $username);
      // We then exceute the statment and store the results
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      // We then store the number of results as $resultCheck
      $resultCheck = mysqli_stmt_num_rows($stmt);
      if ($resultCheck > 0) {
        // code...
        // If there are more than 0 results then we send them back to the signup pagge with an error stating that the username is taken
        header("Location: index.php?page=signup&error=usertaken");
        exit();
      }
      else {
        // code...
        // If the username is not taken then prepare a statement with placeholders to send to the database
        $sql = "INSERT INTO users (username, password, userImage, admin) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($dbconnect);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          // code...
          header("Location: index.php?page=signup&error=sqlerror");
          exit();
        }
        else {
          // code...
          // We then hash the password
          $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

          // We then finally bind the users entered values to the palceholders an enter them into the database
          mysqli_stmt_bind_param($stmt, "sssi", $username, $hashedPassword, $profilePicture, $admin);
          mysqli_stmt_execute($stmt);
          // We also send them back to the signup page with a message saying success
          header("Location: index.php?page=signup&signup=success");
          exit();


        }
      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($dbconnect);
}
else {
  // code...
  // If they havent clicked the button then we send them back to the signup page
  header("index.php?page=signup");
  exit();
}
  ?>
