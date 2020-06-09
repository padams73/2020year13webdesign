<?php
// tells the page it will be using sessions
session_start();

// connects to the database
include("dbconnect.php");

// gets the variables from the post array
$username = $_POST['user'];
$password = $_POST['password'];

// query to select the details from the users table for the entered username
$login_sql = "SELECT username, password FROM users WHERE username = '$username'";
$login_qry = mysqli_query($dbconnect, $login_sql);
$login_aa = mysqli_fetch_assoc($login_qry);

// hashs the entered password
$hash = $login_aa['password'];

// verifys the password
// redirects back to the login page with an error message
if (password_verify($password, $hash)) {
  $_SESSION['admin'] = "$username";
  header("Location: index.php");
} else {
  header("Location: login.php?error=error");
}
?>
