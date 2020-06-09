<?php
//Here we are checking if the following submit button has acutally been pressed by checking if it has been set in the post array
if (isset($_POST['following-submit'])) {
  // code...
  //If it has been set then we set up some variables
  //UserID is coming from the session and is the userID of the logged in user
  $userID = $_SESSION['userID'];
  //GroupID is coming from the post array and was set on the previous page it is equal to the groupID of the group the user wants to follow
  $groupID = $_POST['groupID'];

  //This sql query inserts the users userID and the groupID of the group they want to follow and inserts them into the database
  $sql = "INSERT INTO following (userID, groupID) VALUES ('$userID', '$groupID')";
  $result = $dbconnect->query($sql);

  //This then sends them back to the following page
  header("Location: index.php?page=following");

}else {
  // code...
  //Else the user has no hit the following submit button and has accessed the page some other way so is sent back to the index page
  header("Location: index.php");
}

 ?>
