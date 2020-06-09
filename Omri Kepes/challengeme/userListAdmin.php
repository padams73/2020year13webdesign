<?php
// check to make sure session is set to admin
session_start();
// if session isn't set (not an admin account), send back to home page
if(!isset($_SESSION['userID'])){
  header("Location: index.php?page=login&error=notsetMyAccount");
}elseif (!isset($_SESSION['admin'])){
  header("Location: index.php?page=home");
}
?>
<!-- html for displaying all the users in order of userID desc (e.g. most resently added first) -->
<div class="top" style="margin-top: 20px;">
  <!-- link back to home page -->
  <a style="color: black; text-decoration: underline; margin-left: 5%;"href="index.php?page=home">Back</a>
</div>
<div class="container-fluid mt-3 mb-4">
  <div class="row">
    <div class="col-lg-12 col-md-12 text-center ml-3">
      <h2 class="">ChallengeMe User List</h2>
    </div>
  </div>
<!-- Table of users and their rank. Inside a jumbotron with different sections for points etc -->
    <div class="row leaderboard bg-white mb-5 ml-lg-3 mr-md-3 ml-md-3 mr-sm-2 ml-sm-2">
      <div class="col-lg-12 col-md-12">
        <div class="row toprow">
          <div class="col-4">
            <h6 class="toprowtext">Username</h6>
          </div>
          <div class="col-1">
            <h6 class="toprowtext">Wins</h6>
          </div>
          <div class="col-1">
            <h6 class="toprowtext">Loses</h6>
          </div>
          <div class="col-1">
            <h6 class="toprowtext">Points</h6>
          </div>
          <div class="col-2">
            <h6 class="toprowtext">Total fights</h6>
          </div>
          <div class="col-1">
            <h6 class="toprowtext">Action</h6>
          </div>
          <?php
          // if a message arrives from deletMyAccount page, display text below
          if (isset($_GET['message'])) {
            // set message equal to a variable 'message'
            $message = $_GET['message'];
            // if the message is 'deleted'
            if ($message=="deleted") {?>
              <!-- display 'successful deletion message' -->
              <div class="col-2">
                <h6 style="color: red;">*account was deleted*</h6>
              </div><?php
              // else do nothing (no account deleted)
            }else;
          }else;
          ?>
          <div class="col-1">

          </div>
        </div>
        <!-- Getting users data from databass (username, points, wins etc)-->
        <?php
        // select everything from the coloum 'user' and order the info in descending order depending on how many wins that user has had
        $user_sql="SELECT * FROM `user` where level!=1 ORDER BY `userID` asc";
        // run sql query
        $user_qry=mysqli_query($dbconnect, $user_sql);
        // select the userName of the user
        // run while statement for leaderborad (repeating the code for each new user)
        while ($user_aa = mysqli_fetch_assoc($user_qry)){
          // assign the data to the variables below
          $username= $user_aa['username'];
          $userWins = $user_aa['userWins'];
          $userPoints = $user_aa['userPoints'];
          $userID = $user_aa['userID'];
          $userTotal = $user_aa['totalChallenges'];
           ?>
<!-- Username and corosponding points, wins etc -->
        <div id="container-fluid">
          <div class="row">
            <div class="col-4">
              <div class="name">
                <a id=userNameLink href="index.php?page=selectUser&userID=<?php echo $userID;?>">
                  <?php
                  // if the userID has been selected (from the select user page) then display their name in orange (highlighting it for deletion from the admin)
                  if (isset($_GET['selectedUserID'])) {
                    // if selectedUserID (which was set back on the select user page), is equal to te userID of a user on the userlistadmin page, color it red
                    if ($_GET['selectedUserID']==$userID) {?>
                      <p style="color: orange; font-weight: bold;"><?php echo $username;?></p> <?php
                      // otherwise, color all other names black
                    }else{
                      echo $username;
                    }
                  }else {
                    echo $username;
                  }
                  ?>
                </a>
              </div>
            </div>
            <div class="col-1">
              <div class="userWins">
                <?php
                // if the logged in user is the same as a user displayed on the leaderbaord, display text in red
                if ($_SESSION['userID']==$userID) {?>
                  <p style="color: red;"><?php echo $userWins;?></p> <?php
                }else {
                  echo $userWins;
                }
                ?>
              </div>
            </div>
            <div class="col-1">
                <?php
                // calculate userLoses by taking the totals - the wins
                $userLose = $userTotal - $userWins;
                // if the logged in user is the same as a user displayed on the leaderbaord, display text in red
                if ($_SESSION['userID']==$userID) {?>
                  <p style="color: red;"><?php echo $userLose;?></p> <?php
                }else {
                  echo $userLose;
                }
                ?>
            </div>
            <div class="col-1">
              <div class="userPoints">
                <?php
                // if the logged in user is the same as a user displayed on the leaderbaord, display text in red
                if ($_SESSION['userID']==$userID) {?>
                  <p style="color: red;"><?php echo $userPoints;?></p> <?php
                }else {
                  echo $userPoints;
                }
                ?>
              </div>
            </div>
            <div class="col-1">
              <div class="userTotal text-center">
                <?php
                // if the logged in user is the same as a user displayed on the leaderbaord, display text in red
                if ($_SESSION['userID']==$userID) {?>
                  <p style="color: red;"><?php echo $userTotal;?></p> <?php
                }else {
                  echo $userTotal;
                }
                ?>
              </div>
            </div>
            <div class="col-1 offset-1">
              <div class="deleteAccount">
                <a href="index.php?page=deleteMyAccount&userID=<?php echo $userID;?>&type=user">delete</a>
              </div>
            </div>
          </div>
          <hr>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
