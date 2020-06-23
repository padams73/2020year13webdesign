
<?php
// conneting to database
$dbconnect = mysqli_connect("localhost", "root", "", "niteryse");
// selects all from reviews
$review_sql =  "SELECT * FROM reviews";
$review_qry = mysqli_query($dbconnect, $review_sql);
$review_aa = mysqli_fetch_assoc($review_qry);
 ?>
 <div class="title">

 </div>
 <div class="content1">
<h2>Select Review to delete.</h2>

<?php
// puts all content from reviews into variables
do {
  $name = $review_aa['name'];
  $review = $review_aa['review'];
  $reviewID = $review_aa['reviewID']
  ?>
  <!-- displays all variable content as links that can be clicked on -->
    <a href="index.php?page=delConfirmReview&reviewID=<?php echo $reviewID; ?>" ?><?php echo("<p>☰    $review - $name</p>") ?> <a/>

<?php
} while ($review_aa = mysqli_fetch_assoc($review_qry))
 ?>
</div>
