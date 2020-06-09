<?php
//This page allows users to edit their comments

//First we need to include the comments.inc.page in which the function editComments is defined
include('comments.inc.php');

//Here we are checking if the articleID has been set in the post array for this code to use
if (isset($_POST['postID'])) {
  // code...
  //Here we are setting up variables to use from the post array
  $postID = $_POST['postID'];
  $userID = $_POST['userID'];
  $commentID = $_POST['commentID'];
  $date = $_POST['date'];
  $comment = $_POST['comment'];
  $avatar = $_POST['avatar'];
  ?>

  <!-- This is the start of the comment section code -->
    <!-- This is the start of the comment_header div-->
    <div class="comment_header pb-5 mb-5">
      <h5>Comments</h5>
      <hr>
      <div class="enter_comment">
        <!-- Here we are setting the avatar to the users profile picture-->
        <?php echo "<img src='images/$avatar' alt='Profile picture failed to load'> "; ?>
        <!-- Here the text_field div tag starts this is where the user types in there edited comment-->
        <div class="text_field">
          <?php
          //This is the edit comment form
          echo "
           <form method='POST' action='".editComments($dbconnect, $postID)."'>
            <input type='hidden' name='userID' value='$userID'>
            <input type='hidden' name='commentID' value='$commentID'>
            <input type='hidden' name='postID' value='$postID'>
            <input type='hidden' name='date' value='$date'>
            <textarea name='comment'>$comment</textarea>
            <button type='submit' name='commentSubmit'>Edit</button>
          </form>";
          ?>
          <!-- This is the end of the text_field div tag-->
        </div>
        <!-- This is the end of the enter_comment div tag-->
      </div>
      <!-- This is the end of the comment_header div -->
    </div>
<?php
}//IF the articleID is not set then the user is sent back to the home page
else {
    header("Location:index.php?home.php");
  }
?>
