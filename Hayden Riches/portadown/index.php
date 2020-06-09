<?php
// the index page is the main page of this site.
// the three main areas of the site are accessible through hebre
// as of the moment, only the stock area has been created.

// connecting to the database
include("dbconnect.php");

// checking that a logged in user is accessing the page
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
} ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Portadown</title>
    <!-- linking to the style sheet -->
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
      <!-- including the navbar -->
      <?php include("navbar.php") ?>
      <!-- including a banner image -->
      <img class="img-fluid" src="images/banner.png" alt="Banner image of cattle">
        <div class="container row col-12 m-auto pb-5">
        <!-- the first of three image links as cards. Goes to the irrigation page -->
        <!-- this link does not function yet therefore it reloads the index page. The irrigation page is yet to be created -->
        <div class="main col-lg-4 col-sm-10 my-lg-5 my-md-1 mx-auto">
          <a href="index.php">
          <div class="card mt-4">
            <img class="card-img-top" src="images/irrigation.png" alt="Irrigation Photo">
            <h1 class="index_link card-title mx-auto my-3">Irrigation</h1>
          </div>
          </a>
        </div> <!-- end of link #1 -->
        <!-- the second of three image links as cards. Goes to the paddocks page. -->
        <!-- this link does not function yet therefore it reloads the index page. The paddocks page is yet to be created -->
        <div class="main col-lg-4 col-sm-10 my-lg-5 my-md-1 mx-auto">
          <a href="index.php">
          <div class="card mt-4">
            <img class="card-img-top" src="images/paddocks.png" alt="Irrigation Photo">
            <h1 class="index_link card-title mx-auto my-3">Paddocks</h1>
          </div>
          </a>
        </div> <!-- end of link #2 -->
        <!-- the third of three image links as cards. Goes to the stock page -->
        <div class="main col-lg-4 col-sm-10 my-lg-5 my-md-1 mx-auto">
          <a href="stock.php">
          <div class="card mt-4">
            <img class="card-img-top" src="images/stock.png" alt="Irrigation Photo">
            <h1 class="index_link card-title mx-auto my-3">Stock</h1>
          </div>
          </a>
      </div> <!-- end of link #3 -->
    </div> <!-- end of container -->
      <?php include("footer.php") ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
