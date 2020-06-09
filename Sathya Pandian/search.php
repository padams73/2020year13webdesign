
<?php
//this page selects the playerID from the database for the search engine//
  $search = $_POST['search'];
// if the playerID isn't in the database then it will display the text "No results found please click NBA FANS MVP VOTING to return home"//
  $search_sql = "SELECT * FROM player WHERE name LIKE '%$search%'";
  $search_qry = mysqli_query($dbconnect, $search_sql);
  if(mysqli_num_rows($search_qry)==0) {
    echo "<p class='text-light'>No results found please click on NBA FANS MVP VOTING to return to home page</p>";
  } else {
  $search_aa = mysqli_fetch_assoc($search_qry);
// this is showing the players name and image as well as echos the image from the database and resizes it to fit the column//
  do {
    $name = $search_aa['name'];
    $image = $search_aa['image'];?>
<div class="row my-2">
<div class="col-2">
  <img src="<?php echo "images/$image"; ?>" class="image-resize" alt="">
</div>
<div class="col-6">
  <!-- this echos the player image from the sql database -->
  <?php echo "<p class='player-image'>$name</p>"; ?>
</div>
<div class="col-2">
  <!-- this links the vote and playerID and echos it from the database and puts it in the same row as the thumbs up image as well as resizing everything to fit the column -->
  <a href="index.php?page=vote&playerID=<?php echo $search_aa['playerID']; ?>"><img src="images/thumbsup.jpg" class="image-resize" alt=""></a>
</div>
<div class="col-2">
  votes
</div>
</div>


    <?php
  } while ($search_aa = mysqli_fetch_assoc($search_qry));
}
?>
