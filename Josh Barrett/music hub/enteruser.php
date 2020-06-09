<?php
include('dbconect.php');

$username = $_POST['username'];
$password = $_POST['password'];

$hash = password_hash($password, PASSWORD_DEFAULT);
// run the insert query to create a new user
$add_sql="INSERT INTO user (username,password) VALUES('$username','$hash')";
$add_qry = mysqli_query($dbconect,$add_sql);

// success message
echo "HOORAY";
// include the login form
include("login.php");

 ?>
