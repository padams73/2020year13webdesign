<!DOCTYPE html><!--The html document tag organises the code on this page effectively in sections.-->
<html lang="en" dir="ltr">
  <head><!--This section displays links to stylesheets and the title of the website.-->
    <meta charset="utf-8">

      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"><!--This links the index page to the Bootstrap stylesheet.-->

    <link rel="stylesheet" href="stylesheet.css"><!--This links the index page to the stylesheet.-->
    <title>HELP!!!</title><!--This is the title that will appear on the tab on the web browser.-->
  </head><!--This section ends here.-->
  <body><!--This displays everything that appears on the page.-->



<?php include("banner.php");//This includes the banner page to the index page.
include("navbar1.php"); ?><!--This includes the navbar page to the index page.-->
<div class="info"> <!--The info class begins here.-->



<?php if(isset($_GET['page'])) {
  $page = $_GET['page'];//This fetches the page the user clicked on, using a GET array.
  if(file_exists("$page.php")) {
    include("$page.php");//If the user clicks on a level and standard, this standard page will be included on the page, using a get array.
  }else {
    include("home.php");
}} else {
  include("home.php"); //This includes the home page to the index page.
}


?>

</body><!--This section ends here.-->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script><!--This javascript is necessary for the index page to successfully be linked to the Bootstrap stylesheet.-->
</html><!--This ends the html tag.-->
