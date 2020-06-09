<div class="container-fluid">

  <div class="row justify-content-center">
    <div class="col-sm-9" style="background-color:     #292929; color: white;">
      <h1>library</h1>


    <?php
      include("dbconect.php");
      // select most recent 20 songs
      $userID=$_SESSION['admin'];
      $music_sql = "SELECT * FROM music WHERE userID=$userID ORDER BY musicID DESC LIMIT 20";
      //looks in the array and if there are no songs it will say no songs in libary else it will fetch them.
      $music_qry = mysqli_query($dbconect, $music_sql);
      if(mysqli_num_rows($music_qry)==0) {
        echo "<p>No songs in library yet</p>";
      } else {
      $music_aa = mysqli_fetch_assoc($music_qry);
      //setting variables
      do {
        $title = $music_aa['title'];
        $filename = $music_aa['filename'];
        $image = $music_aa['image'];

        ?>
        <!--displaying the music image and titel in a card -->
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
        //while there is stuff in the arrar it will do the do area
      } while ($music_aa = mysqli_fetch_assoc($music_qry));
    }
     ?>
    </div>

  </div>
</div>
