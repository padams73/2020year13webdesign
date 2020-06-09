<?php
// check to see if the session has been set
session_start();
// if the session isn't set (no userID), then redirect to the login page with the error message
if(!isset($_SESSION['userID'])){
  header("Location: index.php?page=login&error=notsetMyAccount");
}
?>
<!-- setting up coloums and rows from bootstrap for leaderboard -->
<div class="container-fluid mt-5">
  <div class="row">
    <div class="col-lg-4 order-lg-last col-md-4 order-md-last col-sm-12 order-sm-first welcomeSection bg-transparent">
        <?php
        // if the session is set to admin, display the admin panel
        if (isset($_SESSION['admin'])) {
          ?>
         <h4>Admin Panel</h4>
         <p>Welcome to the admin panel. Please check the below links to the following pages.</p>
         <!-- admin page links -->
         <p>View all pending events: <a href="index.php?page=pendingEvents">here</a></p>
         <p>View submitted results: <a href="index.php?page=submittedResults">here</a></p>
         <p>Manage current user accounts: <a href="index.php?page=userListAdmin">here</a></p>
         <p>Manage Admin accounts: <a href="index.php?page=adminAccounts">here</a></p>
         <p>Create a new challenge: <a href="index.php?page=makechallenge">here</a> </p>
         <hr></hr>
         <p style="color: red; font-weight:bold;">
         <?php
         if (isset($_GET['error'])) {
           $message = $_GET['error'];
           if ($message=="eventAdded") {
             echo "*Event has been successfully created.";
           }else
           echo "wrong message";
         }else
         echo "no messages";
         ?></p>


         <?php
       } elseif (isset($_SESSION['user'])){
         // else if the session is set to user
       ?>
       <!-- display user info -->
       <div class="welcomeUser" style="text-align: center;">
         <h4>Welcome to ChallengeMe!</h4>
         <p style="margin-top: 5%;"> - Here you can challenge your friends, be challenged by other users, or even bet on the Up And Coming challenges!</p>
         <p> - The leaderboard displays the current rankings, which will change as challenges go on, and betting continues</p>
         <p> - Challenge a user to increase your wins, or bet on a challenge to increase your points!</p>
         <?php
         if (isset($_GET['error'])) {
           ?><hr>
          <p style="color: green; font-weight: bold;">
          <?php
          $message = $_GET['error'];
           if ($message=="eventAdded") {
             echo "*Event has been successfully created.";
             ?> <p>*After your request has been accepted we'll added you to the <a style="color: black; text-decoration: underline;" href="index.php?page=UpAndComing">Up And Coming</a> page!</p> <?php
           }elseif($message=="winnerEntered"){
             echo "*Winner has been successfully submitted for approval.";?>
             <p>*Points and results will be updated automatically after your results have been moderated. Click <a style="color:black; text-decoration: underline;" href="index.php?page=leaderboard">here</a> to view the leaderboard!</p> <?php
           }else{?>
            <p>Hmm something weird happened! We're looking into it! :(</p>
            <p>Please try again in a sec!</p>
            <?php
           }
         };
          ?>
         </p>
       </div>
     <?php }?>
    </div>
    <div class="col-lg-7 offset-lg-1 order-lg-first col-md-8 offset-md-0 order-md-first col-sm-12 order-sm-last bg-transparent leaderboard">
      <div class"row bg-info">
        <div class="col-lg-12 leaderboardTitle">
          <h2>leaderboard</h2>
        </div>
      </div>
        <!-- Table of users and their rank. Setting up different sections etc-->
      <div class="row leaderboardTable ml-md-3 mr-sm-2 ml-sm-2">
        <div class="col-lg-12"style="background-color: #F3F3F3;"></div>
          <div class="col-lg-12">
            <div class="row toprow">
              <div class="col-3">
                <h6 class=" toprowtext">POSITION</h6>
              </div>
              <div class="col-4">
                <h6 class=" toprowtext">USERNAME</h6>
              </div>
              <div class="col-3">
                <h6 class=" toprowtext">POINTS</h6>
              </div>
              <div class="col-2">
                <h6 class=" toprowtext">WINS</h6>
              </div>
            </div>
                <?php
                // select everything from the coloum 'user' and order the info in descending order depending on how many wins that user has had
                $user_sql="SELECT * FROM `user` where level!=1 ORDER BY `userWins` desc LIMIT 5";
                // run sql query
                $user_qry=mysqli_query($dbconnect, $user_sql);
                // postion set to 0 before while statement, allowing for corosponding position (ranks)
                $position = 0;
                // select the userName of the user when the variable postion remains less than or eqaul too 5 (onyl top 5)
                while ($user_aa = mysqli_fetch_assoc($user_qry) and $position<=5){
                  // set variables for the username, points, wins and userID of each top 5 user
                  $username= $user_aa['username'];
                  $userPoints = $user_aa['userPoints'];
                  $userWins = $user_aa['userWins'];
                  $userID = $user_aa['userID'];
                  // increase the variable position by 1 every time the code runs the while statment (allwoing for 2nd, 3rd etc)
                  $position = $position + 1;
                  ?>
        <!-- Username and corosponding points, wins etc -->
            <div class="row">
              <div class="col-3 rank"style="margin-bottom: 10px;">
                <!-- display the variable 'position' for the users rank -->
                <p style="color: black;"><?php echo $position; ?></p>
              </div>
              <div class="col-4">
                <div class="username" style="margin-bottom: 10px;">
                  <a class="username" href="index.php?page=selectUser&userID=<?php echo $userID; ?>">
                      <?php
                      // if the sessioned userID (e.g. logged in userID) is equal to the userID of one of the top 5
                      if ($_SESSION['userID']==$userID) {?>
                        <!-- display their username in red -->
                        <p style="color: red;"><?php echo $username;?></p> <?php
                      }else {
                      // else just display the username of that ranked user
                      echo $username;
                      }?>
                  </a>
                </div>
              </div>
              <div class="col-3">
                <div class="userPoints"style="margin-bottom: 10px;">
                    <?php
                    // if the sessioned userID (e.g. logged in userID) is equal to the userID of one of the top 5
                    if ($_SESSION['userID']==$userID) {?>
                      <!-- display their points in red -->
                      <p style="color: red;"><?php echo $userPoints;?></p> <?php
                    }else {
                    // else, display points
                    echo $userPoints;
                    }?>
                </div>
              </div>
              <div class="col-2 ">
                <div class="score"style="margin-bottom: 10px;">
                    <?php
                    // if logged in user, display userWins in red
                    if ($_SESSION['userID']==$userID) {?>
                      <p style="color: red;"><?php echo $userWins;?></p> <?php
                    }else {
                    // else display in normal white
                    echo $userWins;
                    }?>
                </div>
              </div>
            </div>
                <?php }?>
        <!-- side section, where admin panel or info about site is -->
            <div class="row">
              <div class="col-12">
                <div class="loadmore" style="margin-bottom: 15px;">
                  <a role=button style="text-decoration: none; color: red;" href="index.php?page=leaderboard">view all</a>
                </div>
              </div>
            </div>
          </div>
        <div class="col-lg-4"style="background-color: #F3F3F3;"></div>
      </div>
    </div>
  </div>
</div>

<!-- bootsrap code for up and coming -->
<div class="container-fluid mt-5 mb-3">
  <div class="row upAndComingTitle">
    <div class="col-lg-8 offset-lg-1 col-md-8 offset-md-0 col-9">
      <h2 >"Up and Coming" challenges</h2>
    </div>
    <div class="col-lg-2 text-lg-center ml-lg-3 col-md-4 text-md-right col-3 text-right">
      <h3><a style="color:red;" href="index.php?page=upAndComing">see all</a></h3>
    </div>
  </div>
</div>
  <div class="container-fluid">
    <div class="row upAndComing mr-sm-2 ml-sm-2">
      <div class="col-lg-1 col-md-0"style="background-color: #F3F3F3;"></div>
      <div class="col-lg-10">
        <div class="row toprow">
          <div class="col-3">
            <h6 class="toprowtext">DATE</h6>
          </div>
          <div class="col-6 text-center">
            <h6 class="toprowtext">FIGHTERS</h6>
          </div>
          <div class="col-3 text-center">
            <h6 class="toprowtext">BETS</h6>
          </div>
        </div>
        <!-- select the date, challenge ID, userOneid, userTwoID, userOne and userTwo from the database where the status is 1 (e.g. has been accepted and is upandcoming) and only dispaly the top two results in ascending order -->
        <?php
        $user_sql="SELECT c.date,c.challengeID, c.userOneID, c.userTwoID, c.status, (SELECT user.username FROM challenges JOIN user on user.userID=challenges.userOneID WHERE challenges.challengeID=c.challengeID) as userOne, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.userTwoID WHERE challenges.challengeID=c.challengeID) as userTwo FROM challenges c WHERE (`status`=1) ORDER BY c.date asc LIMIT 2";
        // select everything from the coloum 'user' and order the info in descending order depending on how many wins that user has had
        // run sql query
        $user_qry=mysqli_query($dbconnect, $user_sql);
        // select the userName of the user
        // run a while statement for the two users
        while ($user_aa = mysqli_fetch_assoc($user_qry)){
          // assign the results from the assosicated array to the variables below
          $userOne= $user_aa['userOne'];
          $userTwo = $user_aa['userTwo'];
          $date = $user_aa['date'];
          $challengeID= $user_aa['challengeID'];
          $userOneID = $user_aa['userOneID'];
          $userTwoID = $user_aa['userTwoID'];

        ?>
        <div class="row bg-danger mb-3">
          <div class="col-12">
            <h6 class="secondrowtext"><?php echo $date; ?></h6>
          </div>
        </div>
<!-- Username and corosponding points, wins etc -->
        <div id="container-fluid">
          <div class="row">
            <div class="col-2 text-left">
              <!-- send the challengID as well -->
              <a style="color: black;" href="index.php?page=selectEvent&challengeID=<?php echo $challengeID;?>">More</a>
            </div>
            <div class="col-3 text-right col-md-2 text-md-left">
              <div class="userOne" style="text-align: right;">
              <?php
              // if the logged in user is eqaul to one of the next upandcoming users, display in red
              if ($_SESSION['userID']==$userOneID) {?>
                <p style="color: red;"><?php echo $userOne;?></p> <?php
              }else {
                echo $userOne;
              }
              ?>
              </div>
            </div>
            <div class="text-md-right col-2 ml-lg-4 ml-md-4 ml-sm-0 text-sm-center">
              <h3>
                <a class="VStext" style="color: #FF0000;" href="index.php?page=selectEvent&challengeID=<?php echo $challengeID;?>">VS</a>
              </h3>
            </div>
            <div class="col-3 text-md-center">
              <div class="userTwo">
                <?php
                // if the logged in user is eqaul to one of the next upandcoming users, display in red
                if ($_SESSION['userID']==$userTwoID) {?>
                  <p style="color: red;"><?php echo $userTwo;?></p> <?php
                }else {
                  echo $userTwo;
                }
                ?>
              </div>
            </div>
            <div class="col-2 ml-lg-3 text-center">
              <div class="score">
                  <?php
                  // forming variable for the bets for userOne
                  $betsOne_sql="SELECT count(pickedID), pickedID FROM `bets` WHERE challengeID=$challengeID and pickedID=$userOneID GROUP BY pickedID";
                  $betsOne_qry=mysqli_query($dbconnect, $betsOne_sql);
                  // run while statement repeating the events
                  $betsOne_aa = mysqli_fetch_assoc($betsOne_qry);
                  // assign variable 'countUserOne' which holds the number of votes for userOne
                  $countUserOne = $betsOne_aa['count(pickedID)'];
                  // forming the variable for the bets for user two
                  $betsTwo_sql="SELECT count(pickedID), pickedID FROM `bets` WHERE challengeID=$challengeID and pickedID=$userTwoID GROUP BY pickedID";
                  $betsTwo_qry=mysqli_query($dbconnect, $betsTwo_sql);
                  // run while statement repeating the events
                  $betsTwo_aa = mysqli_fetch_assoc($betsTwo_qry);
                  // assign variable 'countUserOne' which holds the number of votes for userOne
                  $countUserTwo = $betsTwo_aa['count(pickedID)'];
                  // resetting variable values if they return no results (e.g. no one voted for userOne, so value is 0)
                  if ($countUserOne==null) {
                    $countUserOne=0;
                  };
                  if($countUserTwo==null){
                    $countUserTwo=0;
                  };
                  // if both users have no bets, display message
                  if ($countUserOne==null and $countUserTwo == null){
                    echo "No bets";
                  }else{
                    // display the bets on screen
                    echo $countUserOne?>/<?php echo $countUserTwo;
                  }
                   ?>
              </div>
            </div>
          </div>
          <hr>
        </div>
      <?php } ?>
      </div>
      <div class="col-lg-1 col-md-0"style="background-color: #F3F3F3;"></div>
    </div>
  </div>
