<?php
// connecting to the data base
include("dbconnect.php");
// turning the password and username from the $_POST array into varibales
$user_name = $_POST['user-username'];
$user_pass = $_POST['user-password'];
// if statement checking for blank fields
if(empty($user_name) || empty($user_pass)) {
	// blank field directs the user back to the register page
	header("Location:index.php?page=register");
} else {
	// hashing the input password for added security
	$new_hash = password_hash("$user_pass", PASSWORD_DEFAULT);
	// connecting to the database and inserting the new user's info
	mysqli_query($dbconnect, "INSERT INTO user (userID, userName, userPass, userAdmin) VALUES (NULL, '$user_name', '$new_hash', '0')");
	// directing the user to the login page to login
	header("Location: index.php?page=log_in");
}
?>