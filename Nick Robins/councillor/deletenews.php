<!-- This is the Page Displaying the News -->

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

<? include('dbconnect.php') ?> <!-- Including DB Connect (connecting to Database) -->
<?php include('navbar.php') ?> <!-- including Navbar to site -->

<div class="container-fluid">
<h2>Click on news headline to delete</h2>
  <div class="row mt-3">

<?php
$news_sql = "SELECT * from news ORDER BY newsID DESC LIMIT 3"; // Selecting everything from the news table in the database
$news_query = mysqli_query($dbconnect,$news_sql);
$news_rs = mysqli_fetch_assoc($news_query);
 ?>

  <?php
  // Going through the items that are in the news
do {

  $headline = $news_rs['headline'];
  $content = $news_rs['content'];
  $date = $news_rs ['date'];
  ?>

  <!-- Using Variables to grab the details from the database -->

 <!-- Displaying the news info from the database in cards -->
    <a href="delete.php?newsID=<?php echo $news_rs['newsID']; ?>">
<?php echo $headline; ?></h5>

</div>
<?php
} while ($news_rs = mysqli_fetch_assoc($news_query));
   ?>
</div> <!-- col-lg-3 -->



  </div> <!-- row mt-3 -->
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
