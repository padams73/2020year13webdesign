<?php
// check to see if sesion is set
session_start();
// if not, send user to the login page
if(!isset($_SESSION['userID']) or isset($_SESSION['admin'])){
  header("Location: index.php?page=login&error=notsetMyAccount");
}

$challengeID = $_GET['challengeID'];
$pickedID = $_GET['userID'];
$userID = $_SESSION['userID'];

$insert_sql = "INSERT INTO bets (challengeID, pickedID,userID) VALUES ('$challengeID', '$pickedID', '$userID')";
$insert_qry = mysqli_query($dbconnect, $insert_sql);
Header("Location: index.php?page=upAndComing");
