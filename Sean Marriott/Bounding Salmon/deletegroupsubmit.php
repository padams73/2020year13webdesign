<?php
if (isset($_POST['deletegroupsubmit'])) {
  //Here we are checking if been deletegroupsubmit has been set in the post array which means that the user has actually pressed the delete group button on the delete group page
  // code...

  //Here we are requiring the dbconnect page which is similar to include except the code will not continue to run without the page
  require 'dbconnect.php';

  //Here we are setting a variable called groupID set to the groupID that was sent over in the post array
  $groupID = $_POST['groupID'];

  //This variable sql is set to the query which we want to use on the database, the query deletes the group from the groups table that is equal to the groupid that is sent through the post array from the other page
  $sql = "DELETE FROM groups WHERE groupID = '$groupID'";
  //This takes the sql variable and querys the database
  $result = $dbconnect->query($sql);

  //Here we send them back to the index page
  header("Location: index.php");
}




 ?>
