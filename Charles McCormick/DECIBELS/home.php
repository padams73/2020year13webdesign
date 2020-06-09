<div class="main">
<div class="row justify-content-center">


<h2 style="text-align: center"> What We Do</h2>

<p style="text-align: center;, font-size: 19;, margin-top: 20px; margin-left: 30px; margin-right: 30px; padding-bottom: 20px;">

Decibels is an audio streaming service designed for artists to share and discover new music.
It is a comfortable platform for aspiring artists to get their name out there, all you have to
do is make an account and your ready to embark on your audio streaming journey. All you have to
do now is get started hit the upload button to begin sharing or the browse button to scout out
the competition. Unlimited uploads and streaming at the small cost of FREE.99.
</div>

    <?php
      //displays the 3 most recent songs taking content from the database
      $music_sql = "SELECT * FROM music ORDER BY musicID DESC LIMIT 3";
      $music_qry = mysqli_query($dbconnect, $music_sql);
      $music_aa = mysqli_fetch_assoc($music_qry);
      //creating variables to hold the data
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

    <audio controls>
      <source src="songs/<?php echo $filename; ?>" type="audio/mpeg" />
    </audio>
  </div>
</div>
  </div>
</div>

<?php
//resets the query
} while ($music_aa = mysqli_fetch_assoc($music_qry))
?>
