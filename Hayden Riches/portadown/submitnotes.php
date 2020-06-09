<?php
// this page loads the updated notes into the database

// connecting to the database
include("dbconnect.php");

// making sure a logged in user is accessing the page
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
}

// checking that new notes have been submitted
if (!isset($_POST['notes'])) {
  header("Location: stock.php?alert=error");
} else {
  $notes = $_POST['notes'];
}

// checking that a stockID is set
if (!isset($_POST['stockID'])) {
  header("Location: stock.php?alert=error");
} else {
  $stockID = $_POST['stockID'];
}

// query to update notes
$notes_sql = "UPDATE stock SET notes = '$notes' WHERE stockID = $stockID";
$notes_qry = mysqli_query($dbconnect, $notes_sql);
// redirecting back to the stock page with an alert to display that the query was successful
header("Location: stock.php?alert=notes") ?>
