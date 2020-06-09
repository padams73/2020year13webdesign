<?php
session_start();//This begins the session for verifying that a user has logged in correctly.
include("databaseconnect.php");//This includes the databaseconnect page to the verify page, so that the verify page is connected to the database.
$username=$_POST['username'];//This posts the username the user typed in, using a POST array.
$password=$_POST['password'];//This posts the password the user typed in, using a POST array.
$user_sql="SELECT * FROM user WHERE username='$username'";//This is the select query used to detect whether there is a match between a user's details that they typed and a record in the database.
$user_qry=mysqli_query($databaseconnect, $user_sql);//This is the query that is run.
$user_aa=mysqli_fetch_assoc($user_qry);//This fetches any matched results from the user database.
$userid=$user_aa['userid'];//This adds the userid to the user_aa.
$hash=$user_aa['password'];//This query checks whether the username and password the user typed in is valid, also running it through the hash function.
if(password_verify($password, $hash)) {
  $_SESSION['user']="$userid";
   header("Location: personalindex.php");//If the username and password are both valid, the user is directed to their personal index page.
}else{
   header("Location: index.php?page=login&error=error");//If the username or password is invalid, the user is directed back to the login page at

}

 ?>
