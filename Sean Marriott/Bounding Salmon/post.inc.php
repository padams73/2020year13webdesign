<?php
//Here we are setting a function called setPost, this function adds posts to the posts table
function setPost($dbconnect){
  //First we have to check that the user has actually clicked the addpost-submit button
  if (isset($_POST['addpost-submit'])) {
    // code...
    //If they have then we set some variables sent through on the create post page
    $userID = $_SESSION['userID'];
    $title = $_POST['title'];
    $groupID = $_POST['groupID'];
    $postContents = $_POST['postContents'];
    $date = $_POST['date'];

    if (strlen($postContents)>100){
      header("Location: index.php?page=addpost&error=contentLong");
      exit();
    }else {
      // code...
      $sql = "INSERT INTO posts (userID, title, groupID, postContents, date ) VALUES ('$userID', '$title', '$groupID', '$postContents', '$date')";
      $result = $dbconnect->query($sql);
      header('Location: index.php?page=addpost&status=success');
    }
  }
}

function editPost($dbconnect){
  if (isset($_POST['editposts-submit'])) {
    // code...

    $postID = $_POST['postID'];
    $title = $_POST['title'];
    $date = $_POST['date'];
    $groupID = $_POST['groupID'];
    $postContents = $_POST['postContents'];


    $sql = "UPDATE posts SET title = '$title', date = '$date', groupId = '$groupID', postContents = '$postContents' WHERE postID= $postID";
    $result = $dbconnect->query($sql);

    header("Location:index.php?page=login");



  }
}

function deletePosts($dbconnect){
  if (isset($_POST['deletepost-submit'])) {
    // code...
    $postID = $_POST['postID'];
    $sql = "DELETE FROM posts WHERE postID = '$postID'";
    $result = $dbconnect->query($sql);


  }
}





 ?>
