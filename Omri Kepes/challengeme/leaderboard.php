<?php
// check to make sure session is set
session_start();
// if session isn't set (no userID), send back to login page
if(!isset($_SESSION['userID'])){
  header("Location: index.php?page=login&error=notsetMyAccount");
}
?>

<!-- html for leaderboard section -->
<div class="top" style="margin-top: 20px;">
  <a style="color: black; text-decoration: underline; margin-left: 5%;" href="index.php?page=home">Home</a>
</div>
<div class="container-fluid mt-5 mb-4">
  <div class="row">
    <div class="col-lg-9 col-md-12 text-md-center ml-3">
      <h2 class="leaderboardTitle">ChallengeMe leaderboard</h2>
    </div>
    <div class="col-lg-3 col-md-0"></div>
  </div>
</div>
<!-- Table of users and their rank. Inside a jumbotron with different sections for points etc -->
  <div class="container-fluid">
    <div class="row leaderboard bg-white mb-5 ml-lg-3 mr-md-3 ml-md-3 mr-sm-2 ml-sm-2">
      <div class="col-lg-9 col-md-12">
        <div class="row toprow">
          <div class="col-8">
            <h6 class=" toprowtext">Username</h6>
          </div>
          <div class="col-1">
            <h6 class=" toprowtext">W</h6>
          </div>
          <div class="col-1">
            <h6 class=" toprowtext">L</h6>
          </div>
          <div class="col-1">
            <h6 class=" toprowtext">Points</h6>
          </div>
          <div class="col-1 text-center" style="color: white; font-weight: bold; font-size: 15px;">
            <h6 class="totalFightsLeaderborad">Total fights</h6>
          </div>
        </div>
        <!-- Getting users data from databass (username, points, wins etc)-->
        <?php
        // select everything from the coloum 'user' and order the info in descending order depending on how many wins that user has had
        $user_sql="SELECT * FROM `user` where level!=1 ORDER BY `userPoints` desc";
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
            <div class="col-8">
              <div class="name">
                <a id=userNameLink href="index.php?page=selectUser&userID=<?php echo $userID;?>">
                  <?php
                  // if the logged in user is the same as a user displayed on the leaderbaord, display text in red
                  if ($_SESSION['userID']==$userID) {?>
                    <p style="color: red;"><?php echo $username;?></p> <?php
                  }else {
                    echo $username;
                  }
                  ?>
                </a>
              </div>
            </div>
            <div class="col-1">
              <div class="score userWins">
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
              <div class="score">
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
            </div>
            <div class="col-1">
              <div class="score userPoints">
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
              <div class="score userTotal">
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
          </div>
          <hr>
        </div>
        <?php } ?>
      </div>
      <div class="col-3"style="background-color: #F3F3F3;"></div>
    </div>
  </div>
