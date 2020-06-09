<?php
//This page upvotes different groups or posts by adding 1 to there upvotes column in the database
  if (isset($_GET['upvotegroup'])) {
    // code...
    //Here we are getting the groupID that the user wants to upvote
    $groupID = $_GET['upvotegroup'];
    //This query updates the upvotes column by getting the value and adding 1 to it
    $upvote_sql="UPDATE groups SET upvotes = upvotes +1 WHERE groupID = $groupID ";
    $upvote_qry = mysqli_query($dbconnect, $upvote_sql);
    //Redirect back to the home page
    header("Location: index.php?page=home");
  }elseif (isset($_GET['upvotepost'])) {
    // code...
    //If the upvotegroup is not set in the group array and upvotepost is instead then we exceute the same code but for the posts table
    $postID = $_GET['upvotepost'];
    $upvote_sql="UPDATE posts SET upvotes = upvotes +1 WHERE postID=$postID";
    $upvote_qry=mysqli_query($dbconnect, $upvote_sql);

    //Since upvotes can occur on groups or posts pages then we have to redirect them to the pages that they were originally on
    if (isset($_GET['groupIDlast'])) {
      // code...
      $groupIDlast = $_GET['groupIDlast'];
      header("Location: index.php?page=group&group=$groupIDlast");
    }elseif (isset($_GET['postIDlast'])) {
      // code...
      $postIDlast = $_GET['postIDlast'];
      header("Location: index.php?page=post&postID=$postIDlast");
    }else {
      // code...
      header("Location: index.php?page=home");
    }
  }

  else {
    // code...
    header("Location: index.php?page=home");
  }


 ?>
