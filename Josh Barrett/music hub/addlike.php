
<?php
  // if musicID is in the GET array it runs the code inside the if loop
  if(isset($_GET['musicID'])) {
    $musicID = $_GET['musicID'];
    $userID=$_SESSION['admin'];
    // reads everything in likes table that has the correct user and music ID
    $check_sql="SELECT FROM likes WHERE userID=$userID AND musicID=$musicID";
          // runs query for table that matches above
          $check_qry = mysqli_query($dbconect, $check_sql);
          // checks if the user has not already liked it
          if(mysqli_num_rows($check_qry)==0) {
            $addlike_sql="INSERT INTO likes (userID, musicID) VALUES ($userID, $musicID)";
            // adds a like to the song from the user
            $addlike_qry = mysqli_query($dbconect, $addlike_sql);
          }
  }
header("Location:index.php?page=likes");
 ?>
