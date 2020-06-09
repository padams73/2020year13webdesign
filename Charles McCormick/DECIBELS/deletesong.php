<?php
//gets title
$musicID = $_GET['musicID'];
  //Runs a query to remove file from the data base
  $del_sql = "DELETE FROM music WHERE musicID=$musicID";
  $del_qry=mysqli_query($dbconnect, $del_sql);
  //optional redirect to me.php
 ?>
 <div class="mainaccount">
 <h1 style="text-align:center;, margin-top: 20px;">Song deleted</h1>
 <a href="index.php?page=me"> <h2 style="text-align:center;">Return To Profile</h2> </a>
 </div>
