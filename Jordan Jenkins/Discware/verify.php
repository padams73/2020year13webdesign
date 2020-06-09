<?php
// including a connection to the database
include("dbconnect.php");
//starting the session to pass session info on and keep the user logged in
session_start();
// $_POST arrays to recieve information from the login page
$username = $_POST['user-username'];
$password = $_POST['user-password'];
// setting up the sql statement to get all the user info
$user_sql = "SELECT * FROM user WHERE userName = '$username'";
// querying the database
$user_qry = mysqli_query($dbconnect, $user_sql);
// putting the database response into an array
$user_aa = mysqli_fetch_assoc($user_qry);
// creating a variable to store the password for hashing
$hash = $user_aa['userPass'];
// storing the user ID
$userID = $user_aa['userID'];
// checking the input password from the login page matches the hash from the database
if(password_verify($password, $hash)) {
	// establishing the userID session variable
	$_SESSION['userID'] = $userID;
	// this sends the user back to the profile page
	header("Location: index.php?page=user");
// if the users password doesn't match, the user is directed to the login page
} else {
	header("Location: index.php?page=login");
}
?>