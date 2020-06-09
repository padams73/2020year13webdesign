


<?php
// this code is on the home.php page//
  $player_sql = "SELECT name, image FROM player";
  $player_qry = mysqli_query($dbconnect, $player_sql);
  $player_aa = mysqli_fetch_assoc($player_qry);

  do {
    $name = $player_aa['name'];
    $image = $player_aa['image'];
    echo "<p class='player-image'>$name $image</p>";
    } while ($player_aa = mysqli_fetch_assoc($player_qry))
 ?>
