<?php
// check to see if sesion is set
session_start();
// if not, send user to the login page
if(!isset($_SESSION['userID'])){
  header("Location: index.php?page=login&error=notsetMyAccount");
}
?>
<div class="top" style="margin-top: 20px;">
  <a style="color: black; text-decoration: underline; margin-left: 5%;" href="index.php?page=home">Home</a>
</div>
<!-- bootsrap code for up and coming -->
<div class="main container-fluid mt-5 ">
  <div class="row">
    <div class="col-lg-3 order-lg-last order-md-first mr-md-2 ml-md-2">
      <div class="eventExplain">
        <h4>Event Betting.</h4>
        <p>How to bet.</p>
        <p> - If you're not involved in an event, you're able to bet on which user is likely to win. This can be done by clicking the 'vote' button beside the users name.<br>A successful bet will win you 10 points, while unsuccessful returns no gain.</p>
        <p>Why?</p>
        <p> - Betting increases your user points, helping boost your profiles image to other users. This, along with your challenge win rate, positions you on the <a style="color: black; text-decoration: underline;"href="index.php?page=leaderboard">ChallengeMe Leaderbaord.</a> <br><br> - You're only able to vote once on any challenge, so pick carefully! View the users player profile for a more indepth descion.</p>

      </div>
    </div>
  <div class="col-lg-8 offset-lg-1 upAndComingTitlePage mr-md-2 ml-md-2">
      <h2 >Up and Coming challenges</h2>
    <div class="upAndComing">
      <div class="col-lg-12">
        <div class="row toprow">
          <div class="col-3">
            <h6 class=" toprowtext">DATE</h6>
          </div>
          <div class="col-6 text-center">
            <h6 class="toprowtext">FIGHTERS</h6>
          </div>
          <div class="col-3 text-center">
            <h6 class=" toprowtext">BETS</h6>
          </div>
        </div>
            <?php
            $event_sql="SELECT c.date, c.challengeID, c.userOneID, c.userTwoID, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.userOneID WHERE challenges.challengeID=c.challengeID) as userOne, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.userTwoID WHERE challenges.challengeID=c.challengeID) as userTwo FROM challenges c WHERE status !=0 and status !=2 and status !=3 ORDER BY c.date asc LIMIT 5";
            // select everything from the coloum 'user' and order the info in descending order depending on how many wins that user has had
            // SELECT count(pickedID), pickedID FROM `bets` WHERE challengeID=44 GROUP BY pickedID
            // run sql query
            $event_qry=mysqli_query($dbconnect, $event_sql);
            // run while statement repeating the events
            while ($event_aa = mysqli_fetch_assoc($event_qry)){
              // assign varibles to the results in the assoiciated array
              $userOne= $event_aa['userOne'];
              $userTwo = $event_aa['userTwo'];
              $date = $event_aa['date'];
              $challengeID=$event_aa['challengeID'];
              $userOneID = $event_aa['userOneID'];
              $userTwoID = $event_aa['userTwoID'];?>
          <div class="row secondrow mb-3">
            <div class="col-12 bg-danger">
              <!-- display event data -->
              <h6 class="secondrowtext"><?php echo $date; ?></h6>
            </div>
          </div>
    <!-- Username and corosponding points, wins etc -->
          <div id="container-fluid">
            <div class="row">
              <div class="col-2">
                <a style="color: black;" href="index.php?page=selectEvent&challengeID=<?php echo $challengeID;?>">More</a>
              </div>
              <div class="col-3 text-center">
                <div class="userOne">
                    <?php
                    $activeUserID=$_SESSION['userID'];
                    $bets_sql = "SELECT * FROM bets where userID=$activeUserID and challengeID = $challengeID";
                    $bets_qry=mysqli_query($dbconnect, $bets_sql);
                    $bets_aa=mysqli_fetch_assoc($bets_qry);
                    if ($bets_aa==null) {
                      // if the logged in userID is the same as userOneID then display in red with no ability to vote (can't vote on event involved in)
                      if ($_SESSION['userID']==$userOneID) {?>
                        <p style="color: red;"><?php echo $userOne;?></p>
                          <?php
                        // if the logged in userID is the same as userTwoID then display in black with no ability to vote (can't vote on event involved in) - same for admins who can't vote on anything
                        }elseif ($_SESSION['userID']==$userTwoID or isset($_SESSION['admin'])) {
                        echo $userOne;
                        // if the logged in userID isn't the same as any of the userID's involved then display userTwo and votting button
                        }else{
                        echo $userOne;?>
                        <button type="button" onclick="OnevoteFuncation('<?php echo $userOneID; ?>', '<?php echo $userOne; ?>', '<?php echo $challengeID; ?>')" class="btn btn-outline-danger">Vote</button><?php
                      }
                    }else{
                      echo $userOne;
                    }?>
                    <!-- java begines for votefuncation -->
                    <script>

                    // when the funcation is started run the code below
                    function OnevoteFuncation(userID, name, cID) {
                      // set a variable (confirmText) and display message e.g. confirmation message
                      var confirmText = confirm("Are you sure you want to vote for "+name+"?\nYou will be unable to change this.");
                      // if the 'ok' button is pressed, and thus confirmTxt variable is 'true'
                      if (confirmText == true) {
                        // send user to userBets page with the challengeID
                        window.location=("index.php?page=userBet&challengeID="+cID+"&userID="+userID+"");
                        // else, do nothing (as the user doesn't want to vote for this person anymore
                      }
                    }
                    // end of java script
                    </script>
                </div>
              </div>
              <div class="col-2 text-center">
                <h3>
                  <a class="VStext" style="color: #FF0000;" href="index.php?page=selectEvent&challengeID=<?php echo $event_aa['challengeID'];?>">VS</a>
                </h3>
              </div>
              <div class="col-3">
                <div class="userTwo">
                  <?php
                  $activeUserID=$_SESSION['userID'];
                  $bets_sql = "SELECT * FROM bets where userID=$activeUserID and challengeID = $challengeID";
                  $bets_qry=mysqli_query($dbconnect, $bets_sql);
                  $bets_aa=mysqli_fetch_assoc($bets_qry);
                  if ($bets_aa==null) {
                    // if the logged in userID is the same as userOneID then display in red with no ability to vote (can't vote on event involved in)
                    if ($_SESSION['userID']==$userTwoID) {?>
                      <p style="color: red;"><?php echo $userTwo;?></p>
                        <?php
                      // if the logged in userID is the same as userTwoID then display in black with no ability to vote (can't vote on event involved in) - same for admins who can't vote on anything
                    }elseif ($_SESSION['userID']==$userOneID or isset($_SESSION['admin'])) {
                      echo $userTwo;
                      // if the logged in userID isn't the same as any of the userID's involved then display userTwo and votting button
                      }else{
                      echo $userTwo;?>
                      <button type="button" onclick="OnevoteFuncation('<?php echo $userTwoID; ?>', '<?php echo $userTwo; ?>', '<?php echo $challengeID; ?>')" class="btn btn-outline-danger">Vote</button><?php
                    }
                  }else{
                    echo $userTwo;
                  }?>
                  <!-- java begines for votefuncation -->
                  <script>
                  // when the funcation is started run the code below
                  function TwovoteFuncation(userID, name, cID) {
                    // set a variable (confirmText) and display message e.g. confirmation message
                    var confirmText = confirm("Are you sure you want to vote for "+name+"?\nYou will be unable to change this.");
                    // if the 'ok' button is pressed, and thus confirmTxt variable is 'true'
                    if (confirmText == true) {
                      // send user to userBets page with the challengeID
                      window.location=("index.php?page=userBet&challengeID="+cID+"&userID="+userID+"");
                      // else, do nothing (as the user doesn't want to vote for this person anymore
                    }
                  }
                  // end of java script
                  </script>
                </div>
              </div>
              <div class="col-2">
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
      </div>
    </div>
  </div>
</div>
<!-- basic html code for the display of the 'later' upandcoming events -->
<div class="container-fluid">
  <div class="row mainHeader mt-5">
    <div class="col-lg-10 text-center offset-lg-1 col-md-10 text-center offset-md-1 upAndComingTitlePage">
      <h2>More events to come!</h2>
        <div class="row toprow">
          <div class="col-4">
            <h6 class=" toprowtext">DATE</h6>
          </div>
          <div class="col-4">
            <h6 class=" toprowtext">USERNAMES</h6>
          </div>
          <div class="col-4">
            <h6 class=" toprowtext">BETS</h6>
          </div>
        </div>
        <div class="row">
          <?php
          $user_sql="SELECT c.date, c.challengeID, c.userOneID, c.userTwoID, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.userOneID WHERE challenges.challengeID=c.challengeID) as userOne, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.userTwoID WHERE challenges.challengeID=c.challengeID) as userTwo FROM challenges c WHERE status !=0 and status !=2 and 'level'!=1 ORDER BY c.date asc LIMIT 100 OFFSET 5";
          // select everything from the coloum 'user' and order the info in descending order depending on how many wins that user has had
          // run sql query
          $user_qry=mysqli_query($dbconnect, $user_sql);
          // while loop. Take results, while in an array, and assign them to the variables set below. Code below repeats for all results found
          while ($user_aa = mysqli_fetch_assoc($user_qry)){
            $userOne= $user_aa['userOne'];
            $userTwo = $user_aa['userTwo'];
            $date = $user_aa['date'];
            $challengeID=$user_aa['challengeID'];
            $userOneID = $user_aa['userOneID'];
            $userTwoID = $user_aa['userTwoID'];
          ?>
          <div class="col-2 offset-1 text-center">
            <?php echo $user_aa['date']; ?>
          </div>
          <div class="col-2">
            <div class="userOne" style="text-align: right;">
              <?php
              // if the logged in user has the same ID as userone, display in red
              if ($_SESSION['userID']==$userOneID) {?>
              <p style="color: red;"><?php echo $userOne;?></p> <?php
              }else {
              echo $userOne;
              }
              ?>
            </div>
          </div>
          <div class="col-2 text-center">
            <h3>
              <a class="VStext" style="color: #FF0000;" href="index.php?page=selectEvent&challengeID=<?php echo $user_aa['challengeID'];?>">VS</a>
            </h3>
          </div>
          <div class="col-2">
            <div class="userTwo">
              <?php
              // if the logged in user has the same ID as usertwo, display in red
              if ($_SESSION['userID']==$userTwoID) {?>
              <p style="color: red;"><?php echo $userTwo;?></p> <?php
              }else {
              echo $userTwo;
              }
              ?>
            </div>
          </div>
          <div class="col-2 text-center">
            <div class="score">
              <span title="Betting hasn't opened for this event yet. Please come back later" style="text-decoration: underline;">Closed</span>
            </div>
          </div>
        <?php }; ?>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 text-center">
      <br>
      <p style="text-align: center; color: black;">No more results to see here!</p>
    </div>
  </div>
</div>
