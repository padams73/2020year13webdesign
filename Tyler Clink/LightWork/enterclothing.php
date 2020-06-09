<?php

$target_dir = "images/items/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
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
echo "Sorry, file already exists.";
$uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
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
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
  echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

  //This page takes the clothing information and adds it to the items table in our Database
  //get information from POST adrray and put into variables
  $clothingname = $_POST['clothingname'];
  $clothingprice = $_POST['clothingprice'];
  $image = $_FILES["fileToUpload"]["name"];
  //set up and run the query to insert the items
  $insert_sql = "INSERT INTO items (name, price, availability, image) VALUES ('$clothingname', '$clothingprice', 1, '$image')";
  $insert_qry = mysqli_query($dbconnect, $insert_sql);

  $select_sql = "SELECT itemID FROM items ORDER BY itemID desc limit 1";
  $select_qry= mysqli_query($dbconnect, $select_sql);
  $select_aa= mysqli_fetch_assoc($select_qry);

  $itemID = $select_aa['itemID'];





        if(!empty($_POST['size'])) {
          foreach($_POST['size'] as $sizeID) {
            $insert_sql = "INSERT INTO itemsize (itemID ,sizeID) VALUES ($itemID, $sizeID)";
            $insert_qry = mysqli_query($dbconnect,$insert_sql);
      }
    }

      if(!empty($_POST['colour'])) {
        foreach($_POST['colour'] as $colourID) {
          $insert_sql = "INSERT INTO itemcolours (itemID, colourID) VALUES ($itemID, $colourID)";
          $insert_qry = mysqli_query($dbconnect,$insert_sql);
  }
}



} else {
  echo "Sorry, there was an error uploading your file.";
}
}

echo "<p class='info_aboutus'>Item of Clothing Successfully Entered</p>"; ?>
<a class='admin-link' href="index.php?page=admin">Back to Admin Page</a>
