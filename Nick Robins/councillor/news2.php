<a name="news"></a>
<!-- This is the Page Displaying the News -->

<?php include('dbconnect.php') ?> <!-- Including DB Connect (connecting to Database) -->

<div class="container-fluid">


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
  <div class="col-lg-3 col-md-6">
    <div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title"><?php echo $headline; ?></h5>
    <h6 class="card-subtitle mb-2 text-muted"><?php echo $date; ?></h6>
    <p class="card-text"><?php echo $content; ?></p>
  </div>
</div>

</div>
<?php
} while ($news_rs = mysqli_fetch_assoc($news_query));
   ?>
</div> <!-- col-lg-3 -->



  </div> <!-- row mt-3 -->
</div>
