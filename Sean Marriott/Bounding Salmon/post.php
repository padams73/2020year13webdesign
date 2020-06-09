<?php
//Here we are including the comments.inc.php as some functions we are going to use on this page are defined there
include('comments.inc.php');
//Here we are checking that post ID has been set in the get array
if (isset($_GET['postID'])) {
  // code...
  // Here we are setting the variable postID to the postID that is set in the get array to use later
  $postID = $_GET['postID'];
  //Here we are Selecting information about the posts and users where the postID is equal to the postID set in the get array
  $post_sql="SELECT posts.title, posts.postContents, posts.upvotes, users.userImage, users.username FROM posts JOIN users ON posts.userID = users.userID WHERE posts.postID = $postID ";
  $posts_qry=mysqli_query($dbconnect, $post_sql);
  $posts_aa=mysqli_fetch_assoc($posts_qry);

  //Here we are setting some variables equal to the information we got from the posts query
  $title = $posts_aa['title'];
  $postContents = $posts_aa['postContents'];
  $userImage = $posts_aa['userImage'];
  $userName = $posts_aa['username'];
  $postUpvotes = $posts_aa['upvotes'];

  //Here we are getting the number of comments on the post and saving it as $numComments
  $numComments_sql = "SELECT COUNT(*) AS TOTAL FROM comments JOIN posts ON posts.postID=comments.postID WHERE posts.postID = $postID ";
  $numComments_qry = mysqli_query($dbconnect, $numComments_sql);
  $numComments_aa = mysqli_fetch_assoc($numComments_qry);
  $numComments = $numComments_aa['TOTAL'];



}else {
  // code...
  //If the postID is not set then we redirect the user back to the index page
  header("Location:index.php");
}

 ?>
 <a class="nostyle" href="index.php?page=post&postID=<?php echo "$postID;" ?>">
 <div class="col pb-4">
  <div class="row p-4 pr-5 pl-5">
    <div class="card mt-3" style="width:100%;">
      <div class="card-header p-2" style="background-color:#A9A9A9;">
        <div class="row">
          <div class="col">
            <?php
             echo "<h5 class: card-header>$title</h5>";
             echo "<img class: card-header src=images/$userImage alt= profile picture>";
             echo "<h7 class: card-header>Created by $userName </h7>";
             ?>
          </div>
          <div class="col">
            <div class="row justify-content-end">
              <h7 style="float:right; color:white; margin-right:2.5%">Comments</h7>
            </div>
            <div class="row justify-content-end">
              <div class="card-header-latest pr-4">
                <?php
                  echo "<h6>$numComments</h6>";
                  ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body p-1 pl-2">
        <blockquote class="blockquote mb-0">
          <div class="row">
            <div class="col-1">
            </a>
              <div class="row">
                <a class="nostyle" href="index.php?page=upvote&upvotepost=<?php echo "$postID"; ?>&postIDlast=<?php echo "$postID" ?>"><img src="images/up.png" alt="" class="upvote" style="width:40%; margin-left:18%"></a>
              </div>
              <div class="row ml-4">
                <?php
                echo "<h3>$postUpvotes</h3>"
                ?>
              </div>
            </div>
            <a class="nostyle" href="index.php?page=post&postID=<?php echo "$postID"; ?>">
            <div class="col" style="margin-left:-3%;" >
              <?php
              echo "<p>$postContents...</p>";
               ?>
            </div>
          </div>
        </blockquote>
      </div>
    </div>
  </div>
</a>
  <div class="comment_header">
    <!-- $num comments is equal to the number of comments for the article selected-->
    <?php echo"<h5>".$numComments." Comments</h5> " ?>
    <hr>
    <!-- This is the start of the enter_comment div this is section where users can write a comment-->
    <div class="enter_comment">
      <?php
      //Here we are checking if the avatar is set in the current session we are doing this as this checks also if the user is logged in or not
      if (isset($_SESSION['userImage'])) {
        // code...
        //If the users avatr is stored then we store it in the $avatar variable to be used later
        $userImage = $_SESSION['userImage'];
        //Here we are using the avatar variable that we set just before to display the users avatar in the comment section
        echo "<img src='images/$userImage' alt='Avatar failed to load'>";
      }//If the user is not logged in then the avatar turns to a deafult profile picture indicating to the user that they are not logged in
      else {
        // code...
        echo "<img src='images/default.png' alt='Avatar failed to load'>";
      }?>

      <!-- This is the text_field variable this is where the user can eneter there comments -->
      <div class="text_field">
        <?php
        //Here we are checking again if the user is logged in and the userID is set in the session we need the userID for when the user comments
        if (isset($_SESSION['userID'])) {
          // code...
          //If the user is logged in then we can execute this code and display the comment form
          echo "
           <form method='POST' action='".setComments($dbconnect)."'>
            <input type='hidden' name='userID' value='".$_SESSION['userID']."'>
            <input type='hidden' name='postID' value='$postID'>
            <input type='hidden' name='date' value='".date('Y-m-d')."'>
            <textarea name='comment' placeholder='Enter comment....''></textarea>
            <button type='submit' name='commentSubmit'>Submit</button>
          </form>";
        }//If the user is not logged in then it will display the following
        else {
          echo "<p class='comment-error'>You must be logged in to comment!</p>";
        }

        ?>
      </div>
    </div>
  </div>
  <?php //This code ca;;s the function getComments so that we can display the comments
  getComments($dbconnect, $postID) ?>
</div>
