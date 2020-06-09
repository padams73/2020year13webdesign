<?php
session_start();//This begins the session of deleting a user's account.
include("databaseconnect.php");//This includes the database connect page to the delete account page.
$userid = $_SESSION['user'];//The userid is added to the user section.
$delete_sql="DELETE FROM user WHERE userid = '$userid'";//This is the delete query that deletes a user's account from the database.
$delete_qry=mysqli_query($databaseconnect, $delete_sql);//This is the query that is run.
unset($_SESSION['user']);//This stops the session of the user.
header("Location:index.php");//This directs the user back to the index page.?>
