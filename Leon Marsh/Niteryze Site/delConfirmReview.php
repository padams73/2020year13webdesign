<?php

// checks to see if the admin session is set, if not it boots them to index
if(!isset($_SESSION['admin'])) {
  header("Location: index.php");
}
// gets the review id sent from the delReview page and puts it into a variable
$reviewID = $_GET['reviewID'];
// then deletes all conten within that variable from the database
$delete_sql = "DELETE FROM reviews WHERE reviewID=$reviewID";
$delete_qry = mysqli_query($dbconnect, $delete_sql);
// then puts the user back onto the adminpanel
header("Location:index.php?page=adminpanel");
?>

<p>Review deleted</p>
