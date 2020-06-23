<?php
// starts session and connects to the database, then draws the name and review from the product page
 session_start();
 $dbconnect = mysqli_connect("localhost", "root", "", "niteryse");
 // puts the name and review into variables
 $name = $_POST['name'];
 $review = $_POST['review'];
// sql that insers submitted review to the database
$sql = "INSERT INTO reviews (review, name) VALUES ('$review','$name')";
// error catching incase the sql cand be completed
// if it succeeds then it takes them back to the product page
if (mysqli_query($dbconnect, $sql)) {
  header("Location:index.php?page=product");
} else {
  echo "ERROR: could not execute $mysqli_query".mysqli_error($dbconnect);
}

?>
