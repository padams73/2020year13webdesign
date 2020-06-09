<?php
// making sure the user is logged in
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
}

// connecting to the database
include("dbconnect.php");

// checking that the page is not being accessed without a stockID.
// If this is the case, the user will be sent to the stock page and an error message will display.
// If this is not the case, the page functions as expected and the stockID submitted is assigned to the variable stockID
if (!isset($_POST['stockID'])) {
  header("Location: stock.php?error=error");
} else {
  $stockID = $_POST['stockID'];
}

// this query deletes the selected animal from the stock table of the database.
$deletestock_sql = "DELETE FROM stock WHERE stockID = '$stockID'";
// this query removes the animals's weights from the weight table
$deletestockweights_sql = "DELETE FROM weight WHERE stockID = '$stockID'";
$qry = mysqli_query($dbconnect, $deletestock_sql);
$qry = mysqli_query($dbconnect, $deletestockweights_sql);
// redirects user to the stock page where a confirmation msg is displayed. 
header("Location: stock.php?alert=delete")
?>
