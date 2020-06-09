<?php
//Here we are including the post.inc.php page because it is where some of the functions we want to use are defined
include('post.inc.php');

//Here we are checking if the postID is set in the get array from the previous page
if (isset($_GET['postID'])) {
  //If it is set then we execute the following code
  // code...
  //Here we are setting a variable called postID that is equal to the postID in the get array
  //We need to do this because we need the postID for one of the sql queries
  $postID = $_GET['postID'];
  $groups_sql="SELECT groupName, groupID FROM groups";
  $groups_qry=mysqli_query($dbconnect, $groups_sql);
  $groups_aa=mysqli_fetch_assoc($groups_qry);

  $posts_sql="SELECT title, postContents FROM posts WHERE postID=$postID";
  $posts_qry=mysqli_query($dbconnect, $posts_sql);
  $posts_aa=mysqli_fetch_assoc($posts_qry);

  //Here we are setting some variables equal to some information in the posts_aa associative array
  $title = $posts_aa['title'];
  $postContents = $posts_aa['postContents'];
?>
<div class="col pb-5">
  <?php
    //Here we are setting the form action equal to a function defined on the post.inc.php page and we are passing through the dbconnect variable
    echo "<form method='post' action='".editPost($dbconnect)."'>"; ?>
    <div class="form-group">
      <label>Name of post</label>
      <input type="text" class="form-control" name="title" placeholder="<?php echo $title ?>" required>
      <?php echo "<input type='hidden' name='date' value='".date('Y-m-d')."'>"; ?>
      <?php echo "<input type='hidden' name='postID' value='$postID'>"; ?>
    </div>
    <div class="form-group">
      <label>Select a group</label>
      <select multiple class="form-control" name="groupID" required>
        <?php
        //Here we are setting up a loop
        //We are setting the variable $queryResult equal to the number of rows returned by the groups_qry
        $queryResult = mysqli_num_rows($groups_qry);
        if ($queryResult>0) {
          // code...
          //If there are more than one row returned by the groups query then we execute the following code

          do {
            // This loop executes the following code until the while condition is breached
            // code...
            // Here we are setting some variables
            $groupname = $groups_aa['groupName'];
            $groupID = $groups_aa['groupID'];
            echo "<option value='$groupID' name='groupID'>$groupname</option>";
          } while ($groups_aa = mysqli_fetch_assoc($groups_qry));
        }  ?>
      </select>
    </div>
    <div class="form-group">
      <label>Text area</label>
      <textarea class="form-control" rows="3" name="postContents" placeholder="<?php echo $postContents ?>" required></textarea>
    </div>
    <!-- This is the submit button, its name is set to editposts-submit in the post array-->
    <button type="submit" name="editposts-submit" class="btn-lg btn-primary">Submit</button>
  </form>
  <?php
}


 ?>
