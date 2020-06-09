<div class="results"><!--The results div tag begins here.-->


<?php if (!isset($_GET['standardid'])) {
  header("Location: personalindex.php");//If the user types in a page in their website bar that does not exist, they are redirected to their personal home page.

}
  $standardid=$_GET['standardid'];//This fetches the standardid from the database.
  $lesson_sql = "SELECT lessons.*, standard.standard AS standard, standard.code AS code, standard.credits AS credits, standard.assessment AS assessment FROM lessons JOIN standard ON lessons.standardid=standard.standardid WHERE lessons.standardid = $standardid";//This is the select query used to select all the lessons and standard criteria that are part of the particular standard the user clicked on.
$lesson_qry = mysqli_query($databaseconnect, $lesson_sql);//This is the query that is run.
$lesson_aa = mysqli_fetch_assoc($lesson_qry);//This fetches all the lessons part of the standard the user clicked on.
$standardtitle = $lesson_aa['standard'];
$codenumber=$lesson_aa['code'];
$creditnumber=$lesson_aa['credits'];
$assessmenttime=$lesson_aa['assessment'];
echo "Mathematics & Statistics ", " ", "$codenumber"," ", "$standardtitle", " ", "Credits: ", "$creditnumber", " ", "Assessment: ", "$assessmenttime";
do {
$lessonid = $lesson_aa['lessonid'];//This adds the lessonid to the lesson_aa.
$lesson = $lesson_aa['lesson'];//This adds the lesson name to the lesson_aa.
?>
<div class="card" ><!--The card div tag begins here.-->

    <a href="personalindex.php?page=activity&lessonid=<?php echo $lessonid; ?>" class="card-link"></a>

    <?php
    echo "<a href='personalindex.php?page=activity&lessonid=$lessonid'>$lesson</a>";?>
</div><!--The card div tag ends here.-->
</div><!--The results div tag ends here.-->
<?php
} while ($lesson_aa = mysqli_fetch_assoc($lesson_qry));

  ?>
</div><!--The results div tag ends here.-->
