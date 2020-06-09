<div class="main">

<?php
//puts the image in the images1 folder
$target_dir = "images1/";
$target_file = $target_dir . basename($_FILES["imageToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["imageToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {

  $uploadOk = 2;
}

// Check file size
if ($_FILES["imageToUpload"]["size"] > 5000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {


$target_dir = "songs/";
$target_song_file = $target_dir . basename($_FILES["songToUpload"]["name"]);
$uploadOk = 1;
$songFileType = strtolower(pathinfo($target_song_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = filesize($_FILES["songToUpload"]["tmp_name"]);
  //getimagesize, getfilesize
  if($check !== false) {
    echo "File is a song - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an song.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_song_file)) {

  $uploadOk = 3;
}

// Check file size
if ($_FILES["songToUpload"]["size"] > 900000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($songFileType != "mp3" && $songFileType != "wav") {
  echo "Sorry, only MP3 and WAV files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
}  else {
  if($uploadOk==1) {
    move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], $target_file);
    move_uploaded_file($_FILES["songToUpload"]["tmp_name"], $target_song_file);
  } else if ($uploadOk==2) {
      move_uploaded_file($_FILES["songToUpload"]["tmp_name"], $target_song_file);
  } else {
    move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], $target_file);
  }



      // runs insert query to add a new record to the music table
      $UserID = $_SESSION['beta'];
      $songname = $_POST['Songname'];
      $imagename = $_FILES["imageToUpload"]["name"];
      $filename = $_FILES["songToUpload"]["name"];

      $insert_sql = "INSERT INTO music (coverArt, audioFile, songName, UserID)
      VALUES (  '$imagename', '$filename', '$songname', $UserID)";
      $insert_qry = mysqli_query($dbconnect, $insert_sql);

      header("Location: index.php?page=home");
  }


}


?>
</div>
