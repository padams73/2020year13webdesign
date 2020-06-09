<?php
  //vote for the selected player
  $playerID = $_GET['playerID'];
  $sql = "INSERT INTO vote (playerID, date) VALUES ($playerID,CURRENT_DATE())";
      $qry=mysqli_query($dbconnect, $sql);
header("Location:index.php");
 ?>
