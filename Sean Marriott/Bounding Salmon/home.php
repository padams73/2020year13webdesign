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
if (isset($_GET['sortby'])) {
  // code...
  // If they have then we need to sort the results via the set method
  // So we set the variable $sortBy to what method was set e.g. DESC
  $sortBy = $_GET['sortby'];
}// By default the sorting method is descending
else {$sortBy = 'DESC';}
//Here we are checking if sortorder has been set in the get array this is the sorting method
if (isset($_GET['sortorder'])) {
  // code...
  //Setting the variable sortOrder with the value of sortOrder in the group array
  $sortOrder=$_GET['sortorder'];
}
// else the sortOrder is set to upvotes by default
else {$sortOrder = 'upvotes';}
//Here we are querying the groups and users tables and returning information about said groups and users
$groups_sql="SELECT groups.groupname, groups.groupID, groups.groupDescription, groups.upvotes, groups.date, users.userImage, users.userName FROM groups JOIN users ON groups.userID=users.userID ORDER BY $sortOrder $sortBy LIMIT 3";
$groups_qry= mysqli_query($dbconnect, $groups_sql);
$groups_aa = mysqli_fetch_assoc($groups_qry);

//Here we are setting up arrays
$trendingGroup = array();
$trendingGroupDescription = array();
$trendingGroupID = array();
$trendingGroupName = array();

//Here we are querying the groups table and returning information about the groups we have to LIMIT the number of rows to 3 so when we display them we have enough room
$trending_sql="SELECT groups.groupImage, groups.groupDescription, groups.groupID, groups.groupname FROM groups ORDER BY upvotes DESC LIMIT 3";
$trending_qry = mysqli_query($dbconnect, $trending_sql);
$trending_aa = mysqli_fetch_assoc($trending_qry);

do {
  // code...
  // We now have to push the information gathered by the trending_sql into their setup arrays
  //I have chosen to use arrays because I am displaying three different types of formats for the information
  array_push($trendingGroup, $trending_aa['groupImage']);
  array_push($trendingGroupDescription, $trending_aa['groupDescription']);
  array_push($trendingGroupID, $trending_aa['groupID']);
  array_push($trendingGroupName, $trending_aa['groupname']);
} while ($trending_aa = mysqli_fetch_assoc($trending_qry));



?>
  <body>
    <div class="col">
      <div class="row p-1">
        <h6 style="margin-left:21%;">Trending Groups Today</h6>
      </div>
      <div class="row p-1 justify-content-center">
        <div class="responsive-1">
          <div class="gallery-1">
            <a href="index.php?page=group&group=<?php echo "$trendingGroupID[1]";  ?>"><img src="images/<?php echo "$trendingGroup[1]"; ?>" alt="" width="400" height="200"></a>
            <!-- We are displaying information from the arrays we have to specify which entry into the arrays we want-->
            <div class="desc"><?php echo"$trendingGroupName[1]: $trendingGroupDescription[1]" ?>
            </div>
          </div>
        </div>
          <div class="responsive-2">
            <div class="gallery-2 mt-2">
              <a href="index.php?page=group&group=<?php echo "$trendingGroupID[0]";  ?>"><img src="images/<?php echo "$trendingGroup[0]";  ?>" alt="" width="600" height="225"></a>
              <div class="desc"><?php echo"$trendingGroupName[0]: $trendingGroupDescription[0]" ?>
              </div>
            </div>
          </div>
            <div class="responsive-1">
              <div class="gallery-1">
                <a href="index.php?page=group&group=<?php echo "$trendingGroupID[2]";  ?>"><img src="images/<?php echo "$trendingGroup[2]" ?>" alt="" width="400" height="200"></a>
                <div class="desc"><?php echo"$trendingGroupName[2]: $trendingGroupDescription[2]" ?>
                </div>
              </div>
            </div>
          </div>


      <div class="row p-1 pt-3 pl-2">
        <div class="col-6">
          <h3>Groups</h3>
        </div>
        <div class="col-6">
          <div class="dropdown pr-2">
            <button class="btn btn-square btn-secondary dropdown-toggle" style="float:right; background-color:#A9A9A9;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Sort By
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="index.php?sortorder=upvotes">Most Upvotes</a>
              <a class="dropdown-item" href="index.php?sortby=ASC">Least Upvotes</a>
              <a class="dropdown-item" href="index.php?sortorder=date">Latest</a>
            </div>
          </div>
        </div>

      </div>
      <?php
      $queryResult = mysqli_num_rows($groups_qry);
      if ($queryResult>0) {
        // code...
        //We are setting up a new do while loop that displays different groups
        do {
          // code...
          $title = $groups_aa['groupname'];
          $groupDescription = $groups_aa['groupDescription'];
          $upvotes = $groups_aa['upvotes'];
          $date = $groups_aa['date'];
          $userName = $groups_aa['userName'];
          $userImage = $groups_aa['userImage'];
          $groupID = $groups_aa['groupID'];

          $latest_sql="SELECT posts.title FROM posts WHERE posts.groupID=$groupID ORDER BY date DESC LIMIT 1 ";
          $latest_qry= mysqli_query($dbconnect, $latest_sql);
          $latest_aa = mysqli_fetch_assoc($latest_qry);

          $numPosts_sql="SELECT COUNT(*) AS TOTAL FROM posts JOIN groups ON groups.groupID = posts.groupID WHERE groups.groupID=$groupID";
          $numPosts_qry = mysqli_query($dbconnect, $numPosts_sql);
          $numPosts_aa = mysqli_fetch_assoc($numPosts_qry);
          $numPosts = $numPosts_aa['TOTAL'];

          $latest = $latest_aa['title'];

          ?>
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

        } while ($groups_aa = mysqli_fetch_assoc($groups_qry));
      } ?>

    </div>

</html>
