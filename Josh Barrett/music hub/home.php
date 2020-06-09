<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-sm-9" style="background-color:     #292929;color: white;">
      <h1>home</h1>

    <?php
      include("dbconect.php");
      // select most recent 20 songs
      $music_sql = "SELECT * FROM music ORDER BY musicID DESC LIMIT 20";
      $music_qry = mysqli_query($dbconect, $music_sql);
      $music_aa = mysqli_fetch_assoc($music_qry);

      do {
        //picking out indivual items from the array.
        $title = $music_aa['title'];
        $filename = $music_aa['filename'];
        $image = $music_aa['image'];
        $musicID = $music_aa['musicID'];
        ?>
        <!--here i made the card and it is echoed the image,music and title -->
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
                    <?php
                    //when you are loged in the like button will appare
                    if (isset($_SESSION['admin'])) { ?>
                        <a href="index.php?page=addlike&musicID=<?php echo $musicID; ?>" class="btn btn-primary">Like</a>
                    <?php }

                     ?>

                </div>
            </div>
        </div>
    </div>

        <?php
        //while there is stuff in the array it will do stuff in the do area
      } while ($music_aa = mysqli_fetch_assoc($music_qry))
     ?>
    </div>

  </div>
</div>
