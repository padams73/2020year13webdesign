<?php $userid=$_GET['userid'];//This is the get array used to fetch the specific userid on the session.
$confirm_sql="SELECT * FROM user WHERE userid = '$userid'";//This is the select query used to select everything from the database, relating to the user in the session.
$confirm_qry=mysqli_query($databaseconnect, $confirm_sql);//This is the query that is run.
$confirm_aa=mysqli_fetch_assoc($confirm_qry);//This fetches all the results from the database to the confirm_aa.
$emailaddress = $confirm_aa['emailaddress'];?><!--This adds the user's email address to the confirm_aa.-->
<p>Are you sure you want to delete <?php echo "$emailaddress"; ?>? This action cannot be undone.</p><!--This appears as text on the website.-->
<a href="deleteaccount.php?userid=<?php echo $confirm_aa['userid']; ?>"><button class="btn btn-primary">Yes</button></a>
<a href="personalindex.php?page=account"><button type="confirm" class="btn btn-primary">No</button></a><!--These two buttons are used as yes and no buttons to confirm whether the user wants to delete their account.-->
