<div class="results"><!--The results div tag begins here.-->
<?php $search = $_POST['search'];//This posts the search characters the user entered in.
$search_sql = "SELECT * FROM lessons WHERE lesson LIKE '%$search%'";//This is the select query used to display all search results.
$search_qry = mysqli_query($databaseconnect, $search_sql);//This is the query that is run.
$search_aa = mysqli_fetch_assoc($search_qry);//This fetches the search results from the database.
if (mysqli_num_rows($search_qry) == 0) {
  echo "Your search did not return any results. Check your spelling or try a different key word.";//This is if there are no search results.
} else {
  do {
  $lesson = $search_aa['lesson'];
  $lessonid = $search_aa['lessonid'];?>




<div class="card" >
  <div class="card-body">

    <a href="personalindex.php?page=activity&lessonid=<?php echo $lessonid; ?>" class="card-link"></a>

    <?php
    echo "<a href='personalindex.php?page=activity&lessonid=$lessonid'>$lesson</a>";?>
  </div>
</div>

<?php
}while ($search_aa = mysqli_fetch_assoc($search_qry));
}?>
</div>
