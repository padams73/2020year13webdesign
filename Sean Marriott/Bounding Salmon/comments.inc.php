<?php
//This is the comments inclusion page it contains many functions to do with the comment section
//Here we are starting an output buffer to save things to be used later
ob_start();

//Here we are defining the setComments function, we have to include the $dbconnect function through the functions parameters so that the function has access to the database
function setComments($dbconnect){
  //Here we are checking if the commentSubmit button has actually been pressed and been set in the post array
  if (isset($_POST['commentSubmit'])) {
    // code...
    //If it has then we are setting some variables = to information set by the user and stored in the post array
    $userID = $_POST['userID'];
    $postID = $_POST['postID'];
    $date = $_POST['date'];
    $content = $_POST['comment'];

    //Here we are saving the sql query in the $sql variable
    //This query is uploading a comment to the database with the values set to what is stored in the variables set by the user
    $sql = "INSERT INTO comments (userID, postID, date, comment) VALUES ('$userID', '$postID', '$date', '$content') ";
    //Here we are sending the sql query to the database and saving the result of the query as $result
    $result = $dbconnect->query($sql);
  }
}

//Here we are defining the getComments function
//In this function along with $dbconnect we also have to pass through articleID so that the function knows which article it is getting the comments for
function getComments($dbconnect, $postID){
  //Starting the code that will connect to the database and return comments
  $comments_sql="SELECT comments.comment, users.username, comments.commentID, users.userImage, comments.userID, comments.date FROM comments JOIN users ON comments.userID = users.userID WHERE postID=$postID ORDER BY date DESC LIMIT 5";
  $comments_qry = mysqli_query($dbconnect, $comments_sql);
  //Here we are saving the number of rows which are the number of results as $queryResult
  $queryResult = mysqli_num_rows($comments_qry);
  //Here we are saving the result of the qry into an associative array
  $comments_aa = mysqli_fetch_assoc($comments_qry);

  //Here we are checking that the number of comments we get from the database is greater than one so we know whether or not to display the comment template
  if ($queryResult > 0) {
    // code...

    //If there are more than 0 results then we start a do while loop
    do {
          //This code will cycle through storing the different columns of the comment into variables while the while condtion is true
          $comment = $comments_aa['comment'];
          $avatar = $comments_aa['userImage'];
          $userID = $comments_aa['userID'];
          $date = $comments_aa['date'];
          $commentID = $comments_aa['commentID'];
          $username = $comments_aa['username']


    ?>

    <!--Here we are starting the comment_section div tag-->
    <div class="comment_section">
    <!-- Starting the comments div tag -->
    <div class="comments">
      <?php //Here we are displaying the users avatar/profile picture
      echo "<img src='images/$avatar' alt='User Avatar'>" ?>
    <!--Starting the comment_field tag-->
    <div class="comment_field">
      <?php
      //Here we are displaying the author of the comment and the date it was written
      echo "<p class='author'>$username  |  $date</p>";
      echo "<p>$comment</p>";

    //Here we are checking if the user is logged in, we do this by checking if the userID has been set for the current session
    if (isset($_SESSION['userID'])) {
      // code...
      //If the user is logged in then we get the userID from the current session and check if it was equal to that of the comment
      if ($_SESSION['userID'] == $userID  || $_SESSION['admin'] == 1){
        // code...
        //If it is, meaning that the current user is the autor of the comment then the user is able to edit and delete the comment
        echo
            "<form class='delete_form 'method='POST' action = '".deleteComments($dbconnect, $postID)."'>
                    <input type='hidden' name='commentID' value='$commentID'>
                    <button type = 'submit' name = 'commentDelete'>Delete</button>
            </form>";
        echo "
            <form class='edit_form 'method='POST' action = 'index.php?page=editcomment'>
                    <input type='hidden' name='commentID' value='$commentID'>
                    <input type='hidden' name='userID' value='$userID'>
                    <input type='hidden' name='date' value='$date'>
                    <input type='hidden' name='comment' value='$comment'>
                    <input type='hidden' name='postID' value='$postID'>
                    <input type='hidden' name='avatar' value='$avatar'>
                    <button>Edit</button>
              </form>";
      }
    }
        ?>
  <!-- End of the comment field div tag-->
  </div>
  <!-- End of the comments div tag-->
  </div>
  <!-- End of the comments section div tag-->
  </div>
  <?php
  //This loop is cycling through for every comment associated with the article
 } while ($comments_aa = mysqli_fetch_assoc($comments_qry));
}
  }

//Here we are defining the editComments function we have to pass through both $dbconnect and $articleID in the parameters
function editComments($dbconnect, $postID){
  //Here we are checking if the user has actually clicked the comment submit button
  if (isset($_POST['commentSubmit'])) {
    // code...
    // If they have clicked the comment submit button then we run this code
    // First we set variables = to what the user submited in the edit comments form
    $commentID = $_POST['commentID'];
    $userID = $_POST['userID'];
    $date = $_POST['date'];
    $content = $_POST['comment'];

    // This $sql variable is storing the sql query that is updating the comment's content with the new content that the user has submited
    $sql = "UPDATE comments SET comment = '$content' WHERE commentID = '$commentID' ";
    //Here we are sending the sql query to the database and saving the result of the query as $result
    $result = $dbconnect->query($sql);
    // Now we need to send the user back to the article page that the user was previously on
    header("Location:index.php?page=post&postID=$postID");
  }

}

// Here we are defining the deleteComments function we have to pass through both $dbconnect and $articleID in the parameters
function deleteComments($dbconnect, $postID){
  //Here we are checking if the user has clicked on the commentDelete button by checking if it is set in the post array
  if (isset($_POST['commentDelete'])) {
    // code...
    //If it is then we are saving the commentID that the user has passed through the form to delete
    $commentID = $_POST['commentID'];

    // This $sql variable is storing the sql query that is deleteing the comment that the user has selected
    $sql = "DELETE FROM comments WHERE commentID = '$commentID' ";
    //Here we are sending the sql query to the database and saving the result of the query as $result
    $result = $dbconnect->query($sql);
    // Now we need to send the user back to the article page that the user was previously on
    header("Location: index.php?page=post&postID=$postID");
  }
}

// This function gets the number of comments on the selected article
function getnumComments($dbconnect, $postID){
  $sql = "SELECT * FROM comments WHERE postID = '$postID'";
  $result = mysqli_query($dbconnect, $sql);
  $queryResult = mysqli_num_rows($result);

  //We are returning the number of the comments
  //This means that the value of getnumComments is = to the number of comments there are
  return $queryResult;
}
