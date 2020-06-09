<div class="col p-5">
<?php
//Here we are defining a function called custom_echo, this function takes in string and a specified length
function custom_echo($x, $length){
  if(strlen($x)==$length){
    // If the length of the string is equal to the length set then the function echos out the string
    echo "<h6>$x</h6>";
  }
  else {
    // code...
    // If not then the string is substitued to the set length and then echoed out
    $y=substr($x,0,$length) . '...';
    echo "<h6>$y</h6>";
  }
}
//Here we are checking if the userID is set in the session, if it is then the user is logged in
if (isset($_SESSION['userID'])) {
  // code...
  //Here we are setting the variable userID equal to the userID set in the session
  $userID = $_SESSION['userID'];
  //Here we are quering the database and selecting the groupID from the following table where the userID is set to that of the user logged in
  //Therefore this will return the groupIDs that belong to the userID
  $following_sql="SELECT groupID FROM following WHERE userID = $userID";
  $following_qry=mysqli_query($dbconnect, $following_sql);
  $following_aa=mysqli_fetch_assoc($following_qry);

  //Here we are setting up a do while loop
  //Here we are first checking that the number of rows returned by the following qry is greater than zero
  if (mysqli_num_rows($following_qry)>0) {
    // code...
    do {
      // code...
      //We will repeat this code as long as there are more rows returned by the following qry
      $groupID=$following_aa['groupID'];
      $followedgroups_sql="SELECT groups.groupname, groups.groupDescription, groups.upvotes, groups.date, users.userImage, users.userName FROM groups JOIN users ON groups.userID=users.userID WHERE groupID=$groupID";
      $followedgroups_qry=mysqli_query($dbconnect, $followedgroups_sql);
      $followedgroups_aa=mysqli_fetch_assoc($followedgroups_qry);
      if (mysqli_num_rows($followedgroups_qry)>0) {
        // code...
        //If there are more than zero groups that are followed by the user then we do the following
        do {
          //This do while loop is what dynamically displays the groups that the user is following on the page
          // code...

          //Here are some variables that hold information that we want to display on this page, they contain information gather from the $followedgroups_aa associative array
          $title = $followedgroups_aa['groupname'];
          $groupDescription = $followedgroups_aa['groupDescription'];
          $upvotes = $followedgroups_aa['upvotes'];
          $date = $followedgroups_aa['date'];
          $userName = $followedgroups_aa['userName'];
          $userImage = $followedgroups_aa['userImage'];

          //Here we are getting the latest post belonging to the group
          $latest_sql="SELECT posts.title FROM posts WHERE posts.groupID=$groupID ORDER BY date DESC LIMIT 1 ";
          $latest_qry= mysqli_query($dbconnect, $latest_sql);
          $latest_aa = mysqli_fetch_assoc($latest_qry);

          //Here we are getting the number of posts in the group
          $numPosts_sql="SELECT COUNT(*) AS TOTAL FROM posts JOIN groups ON groups.groupID = posts.groupID WHERE groups.groupID=$groupID";
          $numPosts_qry = mysqli_query($dbconnect, $numPosts_sql);
          $numPosts_aa = mysqli_fetch_assoc($numPosts_qry);
          $numPosts = $numPosts_aa['TOTAL'];

          $latest = $latest_aa['title'];
          ?>
          <!-- This is the card where we display the information about the followed groups-->
          <a class="nostyle" href="index.php?page=group&group=<?php echo "$groupID"; ?>">
          <div class="row p-4">
            <div class="card mt-3" style="width:100%;">
              <div class="card-header p-2" style="background-color:#A9A9A9;">
                <div class="row">
                  <div class="col-8">
                    <div class="row">
                      <div class="col-3 pl-2">
                        <div class="row pl-5">
                          <?php echo "<h5 class: card-header>$title</h5>"; ?>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="row pr-5">
                          <?php echo "<h7 class: card-header>Created by $userName </h7>";
                           echo "<img class: card-header src=images/$userImage alt= profile picture>"; ?>
                        </div>
                      </div>
                      <div class="col-6">

                      </div>

                    </div>
                  </div>
                  <div class="col-2">
                    <div class="row justify-content-center">
                      <h7>Posts</h7>
                    </div>
                    <div class="row justify-content-center">
                      <h6 style="margin-left:2px;"><?php echo "$numPosts";?></h6>
                    </div>
                  </div>
                  <div class="col-2">
                    <div class="row justify-content-center">
                      <h7>Latest</h7>
                    </div>
                    <div class="row justify-content-center">
                      <?php custom_echo($latest, 15);?>
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
                        <a href="index.php?page=upvote&upvotegroup=<?php echo "$groupID"; ?>"><img class="upvote" src="images/up.png" alt="" style="width:40%; margin-left:18%"></a>
                      </div>
                      <div class="row ml-4">
                        <?php
                        echo "<h3>$upvotes</h3>"
                        ?>
                      </div>
                    </div>
                    <a class="nostyle" href="index.php?page=group&group=<?php echo "$groupID"; ?>">
                    <div class="col" style="margin-left:-3%;" >
                      <?php
                      echo "<p>$groupDescription...</p>";
                       ?>
                    </div>
                  </div>
                </blockquote>
              </div>
            </div>
          </div>
          </a>
          <?php
        } while ($followedgroups_aa=mysqli_fetch_assoc($following_qry));
      }
    } while ($following_aa=mysqli_fetch_assoc($following_qry));
  }else {
    // code...
    // Else the user is not following any groups so we display a form for them to fill out where they can follow groups
    echo "<h3>You are not following any groups would you like to follow one?</h3>";
    ?>
    <form action="index.php?page=followingsubmit" method="post">
      <div class="form-group">
        <label>Groups</label>
        <select multiple class="form-control" name="groupID" required>
          <?php
          //This is getting all the groups from the groups table and storing the groupName and groupID in the groups_aa assosciative array
          $groups_sql = "SELECT groupName, groupID FROM groups";
          $groups_qry = mysqli_query($dbconnect, $groups_sql);
          $groups_aa = mysqli_fetch_assoc($groups_qry);
          if (mysqli_num_rows($groups_qry)>0) {
            // code...
            //Here we are setting up another do while loop for the number of rows from the groups table
            do {
              // code...
              //We are displaying a select option for every row in the groups table
            $groupName = $groups_aa['groupName'];
            $groupID = $groups_aa['groupID'];
            echo"<option value='$groupID' name='groupID'>$groupName</option>";

          } while ($groups_aa=mysqli_fetch_assoc($groups_qry));
          } ?>
        </select>
      </div>
      <button type="submit" name="following-submit" class="btn-lg btn-primary">Submit</button>
    </form>
    <?php
  }
}else{
?>
    <div class="row pb-5 justify-content-center">
      <h2>To see groups you are following you must first log in</h2>
    </div>
    <div class="row pb-5 mb-5">
      <div class="col">
      </div>
      <div class="col">
        <a href="index.php?page=login" class="btn-primary btn-block btn">Login</a>
      </div>
      <div class="col">
      </div>
    </div>
    <div class="row pb-5 mb-2">

    </div>
  </div>
  <?php
}
 ?>
