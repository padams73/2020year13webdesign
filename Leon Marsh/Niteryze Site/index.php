<?php
  // include the dbconnect.php file so we can connect to the database
  include("dbconnect.php");
  session_start();
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Niteryse</title>
    <link href="https://fonts.googleapis.com/css?family=Comic+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="darkmode.css">
  </head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="darkmode.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- favicon for browser tab -->
  <link rel='shortcut icon' type='image/png' href='images/favicon.png' />
<!-- this code detects what page the user is on and changes the background of the site, for example when the user is on the home page it will -->
<!-- display the man with the skateboard, and on any other page it will display the black and grey graphic.-->
  <body <?php if(!isset($_GET['page'])) { ?>class= "mainpage" <?php } else { ?>class="body1" <?php } ?>>

      <?php
      // including the navbar on all pages
        include 'navbar.php';

        // check if we are on the home page.
        // if so, include home.php, otherwise include another page
        if(isset($_GET['page'])) {
          $page = $_GET['page'];
          include("$page.php");
        } else {
          include("home.php");
        }

       ?>
    <?php
    // including footer on all pages
    include ("footer.php");
     ?>

</html>
