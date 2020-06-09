<?php if (!isset($_GET['lessonid'])) {
  header("Location: personalindex.php");
  //If the user types in a page in their website bar that does not exist, they are redirected to their personal home page.
}

  $lessonid=$_GET['lessonid'];//This fetches the lessonid from the database, according to the lesson the user clicked on.
  $activity_sql = "SELECT lesson, information FROM lessons WHERE lessonid = '$lessonid'";//This is the select query that will display everything from the database that is part of the lesson the user clicked on.
$activity_qry = mysqli_query($databaseconnect, $activity_sql);//This is the query that will run.
$activity_aa = mysqli_fetch_assoc($activity_qry);//This fetches the specific lesson the user chose from the database.
$activity = $activity_aa['lesson'];//This adds the lesson name to the activity_aa.
echo "<h2>$activity</h2>";//This displays the name of the lesson on the page.

 $information = $activity_aa['information'];//This adds the lesson information to the activity_aa.
echo "<p>$information</p>"; ?><!--This displays the lesson information on the page.-->
