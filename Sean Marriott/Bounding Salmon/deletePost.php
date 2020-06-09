<?php
  // Here I am checking if the postID is set in the get array, this will be used to identify which post to delete
  if (isset($_GET['postID'])) {
  // code...
  // We are storing the postID in the get array as the variable postID so it easier to use later
  $postID = $_GET ['postID'];
  //The post_sql variable is a mysql query that we have saved, this query takes information from the posts and users tables where the postID is equal to the one that was sent through the get array
  $posts_sql="SELECT posts.title, posts.postContents, posts.upvotes, users.userImage, users.username FROM posts JOIN users ON posts.userID = users.userID WHERE posts.postID = $postID ";
  //This takes the posts sql query and queries the database with the dbconnect variable and stores it as the posts_qry variable
  $posts_qry=mysqli_query($dbconnect, $posts_sql);
  //Here we are setting the results of the posts qry in an associative array called posts_aa
  $posts_aa=mysqli_fetch_assoc($posts_qry);
  //Here we are setting some variables equal to the results of the post qry stored in the posts assosciative array, to use later
  $title = $posts_aa['title'];
  $postContents = $posts_aa['postContents'];
  $userImage = $posts_aa['userImage'];
  $userName = $posts_aa['username'];
  $postUpvotes = $posts_aa['upvotes'];
  //See above, same for num comments
  $numComments_sql = "SELECT COUNT(*) AS TOTAL FROM comments JOIN posts ON posts.postID=comments.postID WHERE posts.postID = $postID ";
  $numComments_qry = mysqli_query($dbconnect, $numComments_sql);
  $numComments_aa = mysqli_fetch_assoc($numComments_qry);
  $numComments = $numComments_aa['TOTAL'];
} ?>
<!-- We are using a modified card template from the bootstrap website to display the results-->
<div class="col">
 <div class="row p-4 pr-5 pl-5">
   <div class="card mt-3" style="width:100%;">
     <div class="card-header p-2" style="background-color:#A9A9A9;">
       <div class="row">
         <div class="col">
           <?php
           //Here we are displaying some information from the database that we previously set in some variables
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
   <div class="row mb-5 pb-2">
     <div class="col">
     <div class="row justify-content-center">
       <!-- Here we are double checking that the user wants to delete the post as this action is irreversible-->
       <h4>Are you sure you want to delete this post?</h4>
     </div>
     <div class="row">
       <div class="col p-5">
         <form action="deletepostsubmit.php" method="post">
           <input type="hidden" name="postID" value="<?php echo $postID ?>">
           <!-- If the user hits the yes button then they are redirected to the deletepostsubmit page which runs the sql-->
           <button type="submit" name="deletepostsubmit" class="btn btn-block btn-danger">Yes</button>
         </form>
       </div>
       <div class="col p-5">
         <!-- If the user hits the no button then they are redirected to the login page which is where they access the page from originally-->
         <form action="index.php?page=login" method="post">
           <button type="submit" name="button" class="btn btn-block btn-primary">No</button>
         </form>
       </div>
     </div>
     </div>
   </div>
</div>
