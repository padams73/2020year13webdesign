<?php

  $availability = $_POST['availability'];
  $itemID = $_GET ['itemID'];

  $update_sql = "UPDATE items SET availability = $availability WHERE itemID = $itemID";
  // echo $update_sql;
  $update_qry = mysqli_query($dbconnect, $update_sql);


header("Location: index.php?page=selectitem");



 ?>
