<?php
  session_start();
  if(!isset($_SESSION['admin'])) {
    header("Location:index.php");
  }

  $itemID = $_GET['itemID'];
  $item_sql = "SELECT itemID, name FROM items WHERE itemID = $itemID";

  $item_qry = mysqli_query($dbconnect, $item_sql);
  $item_aa = mysqli_fetch_assoc($item_qry);

  $name = $item_aa['name'];

    echo "<p class='info_admin'>Confirm Deletion</p>";
    echo "<p class='info_admin'>Are you sure you want to delete that item?</p>";
    echo "<p class='info_admin'>$name</p>";
 ?>

 <a class='confirm-link' href="index.php?page=deleteitem&itemID=<?php echo $item_aa['itemID'];?>">Yes Delete it.</a> | <a class='select-link' href="index.php?page=admin">No, go back to admin panel</a>
