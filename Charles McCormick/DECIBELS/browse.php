<div class="main">
<h1 style="text-align: center"> BROWSE </h1>
<?php
  //This page displays all music uploaded to the website

  //takes all uploaded content from the music table and
  $music_sql = "SELECT * FROM music ORDER BY musicID DESC LIMIT 40";
  $music_qry = mysqli_query($dbconnect, $music_sql);
  $music_aa = mysqli_fetch_assoc($music_qry);

  do {
    $title = $music_aa['songName'];
    $filename = $music_aa['audioFile'];
    $image = $music_aa['coverArt'];
    ?>

<div class="row justify-content-center">
<div class="col-lg-6 col-md-8 mx-auto">


<div class="card" style="text-align: center; margin-bottom: 20px;">
<img src="images1/<?php echo $image; ?>" class="card-img-top" alt="...">
<div class="card-body">
<h1 class="card-title" style=""><?php echo $title; ?></h1>
<h1></h1>
<audio controls>
  <source src="songs/<?php echo $filename; ?>" type="audio/mpeg" />
</audio>
</div>
</div>
</div>
</div>


<?php
//resets the query and displays more content
} while ($music_aa = mysqli_fetch_assoc($music_qry))
?>
