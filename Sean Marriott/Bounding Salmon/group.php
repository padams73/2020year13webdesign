<?php
//Here we are checking if sortby has been set in the get array this is the sorting order (in hindsight I should have swapped the variables $sortby and $sortorder)
if (isset($_GET['sortby'])) {
  // code...
  //Setting the variable sortBy with the value of sortby in the group array
  $sortBy = $_GET['sortby'];
}else {
  // code...
  // else the sortby order is set to descending by default
  $sortBy = 'DESC';
}
//Here we are checking if sortorder has been set in the get array this is the sorting method
if (isset($_GET['sortorder'])) {
  // code...
  //Setting the variable sortOrder with the value of sortOrder in the group array
  $sortOrder=$_GET['sortorder'];
}else {
  // code...
  // else the sortOrder is set to upvotes by default
  $sortOrder = 'upvotes';
}
//Here we are checking if the group is set in the get array
if (isset($_GET['group'])) {
  // code...
  //If it is then $groupID is set to the value of group in the get array
  $groupID = $_GET['group'];

  //Here we are setting up a query that will return information about the posts, groups, and users belonging to the group that has been set
  $posts_sql="SELECT posts.groupID, posts.postID, posts.title, posts.date, posts.postContents, posts.upvotes, groups.groupName, users.username, users.userImage  FROM posts JOIN groups ON posts.groupID=groups.groupID JOIN users ON posts.userID = users.userID WHERE groups.groupID=$groupID ORDER BY posts.$sortOrder $sortBy";
  $posts_qry=mysqli_query($dbconnect, $posts_sql);
  $posts_aa=mysqli_fetch_assoc($posts_qry);

  $postID=$posts_aa['postID'];

  //Here we are getting the number of posts from the posts table
  $numPosts = mysqli_num_rows($posts_qry);

  //Here we are setting up a query that will return the groupname from the groups table where the groupID is equal to the groupID that the user has set
  $groups_sql="SELECT groupname FROM groups WHERE groupID=$groupID";
  $groups_qry=mysqli_query($dbconnect, $groups_sql);
  $groups_aa=mysqli_fetch_assoc($groups_qry);
  $groupName=$groups_aa['groupname'];

}else {
  //else the user is returned to the index page as the user has accessed the page without the group being set
  header("Location:index.php");
}

 ?>
 <div class="col">
   <div class="row pt-3 ml-4 mr-4 border-bottom border-dark">
     <div class="col-9">
       <div class="row">
       <?php echo "<h3>$groupName</h3>";

         if (isset($_SESSION['admin'])) {
         // code...
         if ($_SESSION['admin']==1) {
           // code...
           //Here we are checking if the user is a admin, if they are then a delete button is displayed allowing the admin to delete the group
           ?>
           <a href="index.php?page=deletegroup&groupID=<?php echo $groupID; ?>"  class="ml-3 btn btn-danger">Delete</a>
           <?php
         }
       } ?>
     </div>
     </div>
     <div class="col-3">
       <div class="dropdown pl-2" style="float:right;">
         <!--Here we are allowing the user to sort the posts by different methods-->
         <button class="btn btn-square btn-secondary dropdown-toggle" style="float:right; background-color:#A9A9A9;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           ORDER
         </button>
         <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
           <!--When the user chooses a sorting method, this method is put in the get array along with the groupID-->
           <a class="dropdown-item" href="index.php?page=group&group=<?php echo "$groupID";?>&sortorder=upvotes">Most Upvotes</a>
           <a class="dropdown-item" href="index.php?page=group&group=<?php echo "$groupID";?>&sortby=ASC">Least Upvotes</a>
           <a class="dropdown-item" href="index.php?page=group&group=<?php echo "$groupID";?>&sortorder=date">Latest</a>
         </div>
       </div>
       <h4 style="float:right;">SORT BY:</h4>
       <?php echo "<h4 style='float-right;'> POSTS: $numPosts" ?>
     </div>
   </div>
   <?php
   //Here we are starting a do while loop
   //$numPosts is equal to mysqli_num_rows($posts_qry)
   if ($numPosts>0) {
     // code...
     do {
       // code...
       //Setting variables from the posts_aa associative array
       $postName=$posts_aa['title'];
       $postAuthor=$posts_aa['username'];
       $userImage=$posts_aa['userImage'];
       $date=$posts_aa['date'];
       $postsUpvotes=$posts_aa['upvotes'];
       $postsContents=$posts_aa['postContents'];
       $postID=$posts_aa['postID'];

       //Here we are getting the number of comments belonging to the individual posts
       $numComments_sql = "SELECT COUNT(*) AS TOTAL FROM comments JOIN posts ON posts.postID=comments.postID WHERE posts.postID = $postID ";
       $numComments_qry = mysqli_query($dbconnect, $numComments_sql);
       $numComments_aa = mysqli_fetch_assoc($numComments_qry);
       $numComments = $numComments_aa['TOTAL'];

    ?>
    <!-- Here we are displaying the posts, they are also links to the posts pages where they can read and make comments on them -->
    <a class="nostyle" href="index.php?page=post&postID=<?php echo "$postID"; ?>">
    <div class="row p-4">
      <div class="card mt-3" style="width:100%;">
        <div class="card-header p-2" style="background-color:#A9A9A9;">
          <div class="row">
            <div class="col-10">
              <div class="row">
                <div class="col-4 pl-2">
                  <div class="row pl-5">
                    <?php echo "<h5 class: card-header>$postName</h5>"; ?>
                  </div>
                </div>
                <div class="col-5">
                  <div class="row pr-5">
                    <?php echo "<h7 class: card-header>Created by $postAuthor </h7>";
                     echo "<img class: card-header src=images/$userImage alt= profile picture>"; ?>
                  </div>
                </div>
                <div class="col-3">
                </div>
              </div>
            </div>
            <div class="col-2">
              <div class="row justify-content-center">
                <h7>Comments</h7>
              </div>
              <div class="row justify-content-center">
                <h6 style="margin-left:2px;"><?php echo "$numComments";?></h6>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body p-1 pl-2">
          <blockquote class="blockquote mb-0">
            <div class="row">
              <div class="col-1">
                <div class="row">
                </a>
                  <a href="index.php?page=upvote&upvotepost=<?php echo "$postID"; ?>&groupIDlast=<?php echo "$groupID"; ?>"><img class="upvote" src="images/up.png" alt="" style="width:40%; margin-left:18%"></a>
                </div>
                <div class="row ml-4">
                  <?php
                  echo "<h3>$postsUpvotes</h3>"
                  ?>
                </div>
              </div>
              <a class="nostyle" href="index.php?page=post&postID=<?php echo "$groupID"; ?>">
              <div class="col pt-1" style="margin-left:-3%;" >
                <?php
                echo "<p>$postsContents...</p>";
                 ?>
              </div>
            </div>
          </blockquote>
        </div>
      </div>
    </div>
    </a>
 <?php   } while ($posts_aa = mysqli_fetch_assoc($posts_qry));
} else {
  ?>
  <div class="col p-5">
    <h2>No Posts Yet!</h2>
    <!-- Else there are no posts in the groups so we inform the user -->
    <img src='images/empty.jpg' alt='Nopost' width=540 height=450>
  </div>
<?php } ?>
</div>
