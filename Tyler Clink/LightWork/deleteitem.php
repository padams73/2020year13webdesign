<?php
  session_start();
  if(!isset($_SESSION['admin'])) {
    header("Location:index.php");
  }

  $itemID = $_GET['itemID'];
  $delete_sql = "DELETE FROM items WHERE itemID=$itemID";
  $delete_qry = mysqli_query($dbconnect, $delete_sql);

  $delete_sql = "DELETE FROM itemcolours WHERE itemID=$itemID";
  $delete_qry = mysqli_query($dbconnect, $delete_sql);

  $delete_sql = "DELETE FROM itemsize WHERE itemID=$itemID";
  $delete_qry = mysqli_query($dbconnect, $delete_sql);

  echo "<p class='info_admin'>Item Successfully Deleted</p>";
 ?>
 <a class='admin-link' href="index.php?page=admin">Back to Admin Page</a>
