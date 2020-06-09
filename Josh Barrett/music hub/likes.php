

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-sm-9" style="background-color:     #292929; color: white;">
      <h1>likes</h1>

    <?php
      include("dbconect.php");
      // select most recent 20 songs
      $userID=$_SESSION['admin'];
      $music_sql = "SELECT music.* FROM likes JOIN music ON likes.musicID=music.musicID WHERE likes.userID=$userID";
      //looks in array if there are no songs it will say no songs in libary
      $music_qry = mysqli_query($dbconect, $music_sql);
      if(mysqli_num_rows($music_qry)==0) {
        echo "<p>No songs in library yet</p>";

      //what ever the sql qry reterns is put in to an assositve qry
      } else {
      $music_aa = mysqli_fetch_assoc($music_qry);
      //setting up variables
      do {
        $title = $music_aa['title'];
        $filename = $music_aa['filename'];
        $image = $music_aa['image'];

        ?>
        <!-- display liked images, music and filename in card -->
        <div class="row">
        <div class="col-6 mx-auto">
            <div class="card my-2" style="margin: 0 auto;">
                <h1 style="color:#808080;"><?php echo $title; ?></h1>
                <img src="<?php echo "pic/$image ";?>" class="card-img-top" alt="...">
                <div class="card-body" style="background-color:#808080;">
                    <h5 class="card-title"></h5>
                    <audio controls>
                    <source src="<?php echo "music/$filename "; ?>" type="audio/mpeg">
                    </audio>
                </div>
            </div>
        </div>
    </div>

        <?php
        //thie do while loop will contune to carry out while the music_aa assoitive array is equal to the reaslts of the music qry 
      } while ($music_aa = mysqli_fetch_assoc($music_qry));
    }
     ?>
    </div>

  </div>
</div>
