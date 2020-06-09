<?php
//redirects user if they arent logged in
  if(!isset($_SESSION['beta'])) {
    header("Location: index.php?page=login");
  }

 ?>

 <div class="main">
 <h1 style="text-align: center"> MY UPLOADS </h1>

 <?php
 //selects all songs uploaded by the user who is logged in and displays them
 $UserID=$_SESSION['beta'];
   //only selects songs with a userID that matches whoever is logged in
   $music_sql = "SELECT * FROM music WHERE UserID = $UserID";
   $music_qry = mysqli_query($dbconnect, $music_sql);
   $music_aa = mysqli_fetch_assoc($music_qry);

   //creates variables to store data
   do {
     $title = $music_aa['songName'];
     $filename = $music_aa['audioFile'];
     $image = $music_aa['coverArt'];
     $musicID = $music_aa['musicID'];

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

 <a href="index.php?page=confirmdelete&musicID=<?php echo $musicID; ?>"><h1 class="card-title" style="">Remove</h1></a>

 </div>
 </div>
 </div>

 <?php
//resets the query
} while ($music_aa = mysqli_fetch_assoc($music_qry))
?>





?>
   </div>
