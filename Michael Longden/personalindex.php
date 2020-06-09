<?php
  session_start();//This begins the session of confirming that a user has logged in.
  if(!isset($_SESSION['user'])) {
    header("Location:index.php");//If the user tries to get on this page when they have not logged in, they are directed to the index page.
  }

 ?>

<!DOCTYPE html><!--The html document tag organises the code on this page effectively in sections.-->
<html lang="en" dir="ltr">
  <head><!--This section displays links to stylesheets and the title of the website.-->
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"><!--This links the personal index page to the Bootstrap stylesheet.-->

      <link rel="stylesheet" href="stylesheet.css"><!--This links the personal index page to the stylesheet.-->
    <title>HELP!!!</title><!--This is the title that will appear on the tab on the web browser.-->
  </head><!--This section ends here.-->
  <body><!--This displays everything that appears on the page.-->
    <?php include("banner2.php");//This includes the banner to the personal index page.
    include("navbar2.php");//This includes navbar 2 to the personal index page.
    if(isset($_GET['page'])) {
      $page = $_GET['page'];
      if(file_exists("$page.php")) {
        include("$page.php");//If the user clicks on a level and standard, this standard page will be included on the page, using a get array.
      } else {
        include("account.php");
      }
      } else {
      include("account.php");//If the user clicks on the account link, the account page is included on the page.
    }

    ?>

</body><!--This section ends here.-->


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script><!--This javascript is necessary for the index page to successfully be linked to the Bootstrap stylesheet.-->

</html><!--This ends the html tag.-->
