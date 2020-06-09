<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>The Top Sneaker</title>
    <!-- title of the page that will be displayed in the browser when on the homepage -->
<?php include("dbconnect.php");
// connecting the dbconnect so I can draw from the database

session_start();
// starting the session

?>
<!-- Boostrap javascript so I can use boostrap on my site -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="styles.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <!-- includes nav-bar.php to index.php -->
    <?php include("nav-bar.php"); ?>




<div class="home-page">
<!-- Container for the homepage to sit inside -->


    <?php
  // setting up get array to to have index.php?page=
        if(isset($_GET['page'])) {
          $page=$_GET['page'];
          include("$page.php");
        } else {
          include("home.php");
        }

       ?>
       </div>







       <div class="footer">
         <!--Footer of page -->
         <div class="col text-center py-2">
         <span class='footer_text'>New Zealand © 2020 The Top Sneaker, Inc. All Rights Reserved</span>
         </div>
       </div>
  </body>
</html>
