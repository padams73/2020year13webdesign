<?php
  //This page takes the colour information and adds it to the colour table in our Database
  //get information from POST adrray and put into variables
  $newRGB = $_POST['colourRGB'];

  //set up and run the query to insert the colours
  $insert_sql = "INSERT INTO colours (RGB) VALUES ('$newRGB')";
  $insert_qry = mysqli_query($dbconnect, $insert_sql);


echo "<p class='info_aboutus'>New Colour Successfully Entered</p>"; ?>
<a class='clothing_availability' href="index.php?page=admin">Back to Admin Page</a>
