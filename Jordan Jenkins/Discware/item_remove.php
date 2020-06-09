<?php
// starting the session
session_start();
// connecting to the database
include("dbconnect.php");
// getting the listings id
$remove_id = $_GET['id'];
// setting up the sql query
$remove_sql = "DELETE FROM listing WHERE listID=$remove_id";
// connecting and querying the database
mysqli_query($dbconnect, $remove_sql);
// sending the user to the home page
header("Location: index.php");
?>