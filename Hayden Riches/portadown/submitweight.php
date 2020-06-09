<?php

// connecting to the database
include("dbconnect.php");

// making sure a logged in user is accessing the page
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
}

// getting the variables from the POST array and the GET variable
$tag_number = $_POST['tag_number'];
$weight = $_POST['weight'];
$year = $_POST['year'];
$breed = $_POST['breed'];

// selects the stock that meet the entered requirements
$stockID_sql = "SELECT stockID FROM stock JOIN herd on herd.herdID=stock.herdID WHERE tag_number = $tag_number AND herd_year = $year";
$stockID_qry = mysqli_query($dbconnect, $stockID_sql);
$stockID_aa = mysqli_fetch_assoc($stockID_qry);

// checks that the tag number was linked to a stockID
if (empty($stockID = $stockID_aa['stockID'])) {
  header("Location: stock.php?alert=error");
} else {
  // gets the stock ID where the tag number and herd were the same
  $stockID = $stockID_aa['stockID'];

  // inserts in the weight
  $weightentry_sql = "INSERT INTO weight (stockID, weight, date) VALUES ($stockID, $weight, CURDATE())";
  $qry=mysqli_query($dbconnect, $weightentry_sql);
  // redirecting to the enter weights page to enter more weights
  header("Location: enterweights.php?breed=$breed&year=$year");
} ?>
