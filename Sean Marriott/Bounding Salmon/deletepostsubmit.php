<?php
//Here we are checking if the user actually hit the deletepostsubmit button
if (isset($_POST['deletepostsubmit'])) {
  //If the user did hit the deletepostsubmit then we run the following code
  // code...
  //Here we have to require the dbconnect page as this page is not included on the index page and so the dbconnect page is not included
  require 'dbconnect.php';
  //Here we are setting the postID variable as the postID that is set in the post we need this so we know which post to actually delete
  $postID = $_POST['postID'];
  //This sql code deletes the post from the posts table where postID equals the variable postID which is equal to the postID sent through the post array
  $sql = "DELETE FROM posts WHERE postID = '$postID'";
  $result = $dbconnect->query($sql);

  //After all this code is executed the page redirects them to the login page
  header("Location: index.php?page=login");
}




 ?>
