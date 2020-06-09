<!-- jumbotron -->
<div class="jumbotron">
  <img src="images/nbateams.png" class="img-fluid" alt="Responsive image"></a>
<h1 class="display-4">VOTE</h1>
<p class="lead"> vote for your favourite player this season</p>
<hr class="my-4">
<p>Search for your player and give them a thumbs up</p>

</div>
<div class="row px-5">
  <!-- Content here -->
  <div class="col-md-6 text-light">

    <div class= "text-light">
      <p>This is a list of mvp candidates from
    the 2020 season.To vote for your player
    click on the thumbs up by their
    name. This list changes in order based
    on howmany votes a player has at the time.</p>
    </div>

    <?php
    // this query allows the players to move up and on the table based on if the vote count has gone up it also limits the number of players to five on the home page//
    $player_sql = "SELECT player.*, (SELECT COUNT(playerID) FROM vote WHERE vote.playerID=player.playerID) AS votes FROM player ORDER BY votes DESC LIMIT 5
  ";
      $player_qry = mysqli_query($dbconnect, $player_sql);
    $player_aa = mysqli_fetch_assoc($player_qry);

// this is showing how the tables in the database link to the query and what it needs to do//
    do {
      $name = $player_aa['name'];
      $image = $player_aa['image'];
      $vote = $player_aa['votes'];
      $playerID = $player_aa['playerID'];
      ?>
<div class="row my-2">
  <div class="col-2">
    <img src="<?php echo"images/$image"; ?>" class="image-resize" alt="">
  </div>
  <div class="col-6">
    <?php echo "<p class='player-image'>$name</p>"; ?>
    <?php
      $fire_sql = "SELECT COUNT(playerID) AS fire FROM vote WHERE playerID=$playerID AND date > DATE_SUB(curdate(), INTERVAL 2 day)";
      $fire_qry = mysqli_query($dbconnect, $fire_sql);
      $fire_aa = mysqli_fetch_assoc($fire_qry);
      if($fire_aa['fire']>5) {
        echo "<img class='fire' src='images/fire.jpg'>";
      }
     ?>
     <!-- this is relinking the index page to the vote&playerID and adding the thumbs up image to the site -->
  </div>
  <div class="col-2">
    <a href="index.php?page=vote&playerID=<?php echo $player_aa['playerID']; ?>"><img src="images/thumbsup.jpg" class="image-resize" alt=""></a>
  </div>
  <div class="col-2">
    <!-- this is echoing the vote from the database and displays in columns beside the thumbs up -->
    <?php echo $vote = $player_aa['votes'];?> votes
  </div>
</div>


      <?php
// this telling the code what to do if it cannot echo anything from the datbase//
      } while ($player_aa = mysqli_fetch_assoc($player_qry))
    ?>
</div>

<!-- this is for the search engine and shows the method to search information from the database -->
  <div class="col-md-6">
    <form action="index.php?page=search" method="post">
  <div class="form-group">
    <div class="text-light">
    <label for="search">Search for you player</label>
    <input type="text" name="search" class="form-control" id="search" aria-describedby="search" placeholder="search">
    <small id="search" class="form-text text-muted">.</small>
  </div>


  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</div>
</div>
