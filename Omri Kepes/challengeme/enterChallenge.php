<?php
// check to see if a session is already set
session_start();
// if the session isn't set (no userID), send to the login page
if(!isset($_SESSION['userID'])){
  header("Location: index.php?page=login&error=notsetMyAccount");
}?>
 <!-- Either can enter a new challenge, setting its status to 0 (pending event ready to be responded to), or can complete a challenge (sets status to 2) -->
<?php
// get the status and assign it to the variable status
// status is the current level of the event e.g. completed, submitted etc.
$status = $_GET['status'];
// if status isn't already set, put the event into the pending status (set status as 0)
// creating a challenge
if ($status=='create') {
  // check the level of the creator (if an admin or user has created the challenge)
  $level = $_GET['level'];
  // if the level is set =1, then the creator is an admin (thus has sent two userIDs)
  if ($level == 1) {
    // getting both of the users involved
    $userOneID = $_POST['userOneID'];
    $userTwoID = $_POST['userTwoID'];
    $creatorID = $_GET['creatorID'];
    $date = $_POST['date'];
    $status = 0;
    // if userone and two have the same id (thus the same user) event can't be created. Send back to makechallenge page with an error message
    if ($userOneID==$userTwoID) {
      Header("Location: index.php?page=makechallenge&error=sameUsers");
      // else if the two userID are different the event can be created
    }elseif ($userOneID!=$userTwoID){
        // set up and run the query to insert the student
        $insert_sql = "INSERT INTO challenges (userOneID,userTwoID,date, status, creatorID)
        VALUES ('$userOneID', '$userTwoID','$date','$status','$creatorID')";
        // run and insert query
        $insert_qry = mysqli_query($dbconnect, $insert_sql);
        // check to see if the query worked
        if (!$insert_qry) {
        ?>
        <!-- error message and ability to return via the link -->
        <h5>Sorry an error occured while adding this Challenge.</h5>
        <p>Please click <a style="color: black;" href="index.php?page=makechallenge">here</a>, or visit the admin panel to try again. </p>
        <?php
      }else{
          // if success the send admin back to home page with error message
          Header("Location: index.php?page=home&error=eventAdded");
        }
      }
    // else if the level =0 then the creator is a user, and has sent one userID (and they are the other)
  }elseif ($level==0){
  // userTwoID is always the creator (as userTwo is the session)
  // setting the varibales for userOneID (either from a post or get)
  if (isset($_POST['userOneID'])) {
  $userOneID = $_POST['userOneID'];
  }else{
  $userOneID = $_GET['userOneID'];
  };
  // setting the variables for userTwOID (either post or get)
  if (isset($_SESSION['userID'])) {
    $userTwoID = $_SESSION['userID'];
  }else{
  $userTwoID = $_GET['userTwoID'];
  };
  // checking to make sure challegne doesn't involve an admin account
  $user_sql = "SELECT * FROM user WHERE userID=$userTwoID";
  $user_qry = mysqli_query($dbconnect, $user_sql);
  $user_aa = mysqli_fetch_assoc($user_qry);
  $level = $user_aa['level'];
  if ($level==1) {
    // error message and ability to send user back to leaderboard via link
    echo 'sorry you are unable to challenge an admin';
    ?><p>Return to the home page <a style="color: black;" href="index.php?page=home">here</a>.</p><?php
  }else
  $date = $_POST['date'];
  $status = 0;
  $creatorID = $userTwoID;
  // set up and run the query to insert the student
  $insert_sql = "INSERT INTO challenges (userOneID,userTwoID,date, status, creatorID)
  VALUES ('$userOneID', '$userTwoID','$date','$status','$creatorID')";

  $insert_qry = mysqli_query($dbconnect, $insert_sql);
  if (!$insert_qry) {
    echo '404 error. Sorry an error occured while creating your challenge.';
    ?>
    <p>Please click <a style="color: red;"href="index.php?page=home">here</a> to return to the home page</p>
    <?php
  }else{
    Header("Location: index.php?page=home&error=eventAdded");
    }
  }
}
// else if the status is set to 'submit' it means a users or admin have selected a winner for an event.
// this means updating it's challenge status to 2
// completing a challenge
elseif ($status=='submit'){
  $location = $_GET['edit'];
  // check if the location comes form an admin
  if ($location=='admin') {
    $winnerID = $_POST['newWinnerID'];
    echo $winnerID;
    $challengeID = $_GET['challengeID'];
    $insert_sql = "UPDATE `challenges` SET `winnerID`=$winnerID WHERE challengeID=$challengeID";
    $insert_qry = mysqli_query($dbconnect, $insert_sql);
    if (!$insert_qry) {
      echo '404 error. Sorry an error occured while trying to edit the winner. Please try again.';
      ?><p>Click <a style="color: black; text-decoration: underline;"href="index.php?page=submittedResults">here</a> to return to the submitted results page.</p><?php
    }else
    Header("Location: index.php?page=submittedResults&error=accepted");
    // if it isn't already set then it must be a user adding a result in
  }elseif ($location=='null'){
    $winnerID = $_POST['exampleRadios'];
    $challengeID = $_GET['challengeID'];
    $status = 2;
    $insert_sql = "UPDATE `challenges` SET `status`=$status, `winnerID`=$winnerID WHERE challengeID=$challengeID";
    $insert_qry = mysqli_query($dbconnect, $insert_sql);
    if (!$insert_qry) {
      echo '404 error. Sorry an error occured while trying to submit the winner. Please try again.';
      ?><p>Click <a style="color: black;"href="index.php?page=selectEvent&challengeID=<?php echo $challengeID;?>">here</a> to return to the challenge you selected.</p><?php
    }else
    Header("Location: index.php?page=home&error=winnerEntered");
}
// check if the status variable is set to confirm
// if it is, then results have been submitted, and are waiting approval from an admin.
// admin must accept the challenge results
}elseif ($status=='confirm'){
  // if so, set variable for the challengeID
  $challengeID = $_GET ['challengeID'];
  // select all info about the challenge
  $user_sql = "SELECT * FROM challenges WHERE challengeID=$challengeID";
  $user_qry = mysqli_query($dbconnect, $user_sql);
  $user_aa = mysqli_fetch_assoc($user_qry);
  $userOneID = $user_aa['userOneID'];
  $userTwoID = $user_aa['userTwoID'];
  $winnerID = $user_aa['winnerID'];
  // set status as 3 (e.g. completed)
  $status = 3;
// if the userOneID is the same as the winnerID then update the winner ID and status
// here we are updating the winners points and total challenges
  if ($userOneID == $winnerID) {
    $insert_sql = "UPDATE `challenges` SET `status`=$status WHERE challengeID=$challengeID";
    $insert_qry = mysqli_query($dbconnect, $insert_sql);
    if (!$insert_qry) {
      Header("Location: index.php?page=submittedResults&error=failed");
    }else;

    $insert_sql = "UPDATE `user` SET `userWins`=userWins++1,`totalChallenges`=totalChallenges++1 WHERE userID=$userOneID";
    $insert_qry = mysqli_query($dbconnect, $insert_sql);
    if (!$insert_qry) {
      Header("Location: index.php?page=submittedResults&error=failed");
    }else;

    $insert_sql = "UPDATE `user` SET `totalChallenges`=totalChallenges++1 WHERE userID=$userTwoID";
    $insert_qry = mysqli_query($dbconnect, $insert_sql);
    // check to see if query worked
    if (!$insert_qry) {
      Header("Location: index.php?page=submittedResults&error=failed");
    }else;

    // else if usertwoid is the same as winnerid, then update accordingly
  }elseif ($userTwoID==$winnerID){
    $insert_sql = "UPDATE `challenges` SET `status`=$status WHERE challengeID=$challengeID";
    $insert_qry = mysqli_query($dbconnect, $insert_sql);
    // check to see if query worked
    if (!$insert_qry) {
      Header("Location: index.php?page=submittedResults&error=failed");
    }else;

    $insert_sql = "UPDATE `user` SET `userWins`=userWins++1,`totalChallenges`=totalChallenges++1 WHERE userID=$userTwoID";
    $insert_qry = mysqli_query($dbconnect, $insert_sql);
    if (!$insert_qry) {
      Header("Location: index.php?page=submittedResults&error=failed");
    }else;

    $insert_sql = "UPDATE `user` SET `totalChallenges`=totalChallenges++1 WHERE userID=$userOneID";
    $insert_qry = mysqli_query($dbconnect, $insert_sql);
    if (!$insert_qry) {
      Header("Location: index.php?page=submittedResults&error=failed");
    }else;
  }else;
  // update bets and user points
  // update 'winnerID' in bets, set equal to $winnerID for that challenge
  $insert_sql = "UPDATE `bets` SET `winnerID`=$winnerID WHERE challengeID=$challengeID";
  $insert_qry = mysqli_query($dbconnect, $insert_sql);
  // check to see if query worked
  if (!$insert_qry) {
    Header("Location: index.php?page=submittedResults&error=failed");
  }else;
  // once winners have been entered, and wins/totals have been updated, update the bets and userpoints for those who bet
  // select all from bets for that $challengeID
  $user_sql = "SELECT * FROM bets WHERE challengeID=$challengeID";
  $user_qry = mysqli_query($dbconnect, $user_sql);
  // put results in an array and run while loop repeating code below
    while ($user_aa = mysqli_fetch_assoc($user_qry)){
      echo $user_aa['pickedID'];
      // set variables for the userID of the 'picked' winner, and the ID if the user who bet for them (userID)
      $pickedID = $user_aa['pickedID'];
      $userID = $user_aa['userID'];
      // if pickedID is the same as the winnerID then bet was right
      if ($pickedID==$winnerID) {
        // select from user the points
        $user_sql = "SELECT * FROM user WHERE userID=$userID";
        $user_qry = mysqli_query($dbconnect, $user_sql);
        // Put results into an array
        while ($user_aa = mysqli_fetch_assoc($user_qry)){
        // set variables for points for that user
        $userPoints = $user_aa['userPoints'];
        // increase points by 10 (as they were right)
        $updatedPoints = $userPoints + 10;
        $insert_sql = "UPDATE `user` SET `userPoints`=$updatedPoints WHERE userID=$userID";
        $insert_qry = mysqli_query($dbconnect, $insert_sql);
        // check to see if query worked
        if (!$insert_qry) {
          Header("Location: index.php?page=submittedResults&error=failed");
        }
      }
        // else, bet was wrong
      }
    }
    Header("Location: index.php?page=submittedResults&error=completed");
  }
