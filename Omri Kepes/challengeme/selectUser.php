<?php
// check so see if session is set
session_start();
// if session isn't set, redirect to the login page
if(!isset($_SESSION['userID'])){
  header("Location: index.php?page=login&error=notsetMyAccount");
};
// get the userID of the selected user, and assign it to the variable 'userID'
$userID=$_GET['userID'];
// if the logged in user has the same ID as the slected user, direct to the MyAccount page
if ($userID==$_SESSION['userID']) {
  Header('Location: index.php?page=myAccount');
}else;
// select everything from the database where the userID is the same as the selected userID (and the user isn't an admin)
$selectUser_sql = "SELECT * FROM user WHERE userID=$userID and (level!=1)";
// run mysql statement
$selectUser_qry = mysqli_query($dbconnect, $selectUser_sql);
// put results into an assoiciated array
$selectUser_aa = mysqli_fetch_assoc($selectUser_qry);
// if userID isn't valid, or returns no real results
if ($selectUser_aa==null) {
  // send back to leaderboard
  Header("Location: index.php?page=leaderboard");
  // else display the info for that user
}else{?>
<!-- basic html code for the select user page -->
<div class="top" style="margin-top: 20px;">
  <a style="color: black; text-decoration: underline; margin-left: 5%;" href="index.php?page=home">Home</a>
</div>
<div class="container-fluid selectUser">
  <div class="row mt-5">
    <div class="col-8 offset-2">
      <div class="row">
        <div class="col-6">
            <h4 class="font-weight-bold">
              <!-- displays selected users info -->
              <?php echo $selectUser_aa['username'] . "<br>";?>
            </h4>
            <p>
              <!-- displays selected users info -->
              <?php echo $selectUser_aa['firstName'];?>
              <?php echo $selectUser_aa['lastName'];?>
            </p>
        </div>
        <div class="col-6 text-right">
          <?php
          // set varibles activerID to the logged in userID
          $activeID = $_SESSION['userID'];
          // select from database where the userID is the same as the logged in user
          $activeUser_sql = "SELECT * FROM user WHERE userID=$activeID";
          // run mysql
          $activeUser_qry = mysqli_query($dbconnect, $activeUser_sql);
          // put results into an array
          $activeUser_aa = mysqli_fetch_assoc($activeUser_qry);
          // set the variable 'level'= to the level of the logged in user
          $level = $activeUser_aa['level'];
          // if the users level is not 0, then they are an admin (and thus can't request a fight) but are able to delete the account
          if ($level!=0) {?>
            <button type="button" class="btn btn-danger" style="margin-top:5%;">
              <!-- send the userID (which user will be deleted), and the 'type' e.g. that an admin is deleting a user, not another admin account -->
              <a href="index.php?page=userListAdmin&selectedUserID=<?php echo $userID;?>&type=user" style="color: white;">Delete users account.</a>
            </button><?php
            // if the users level is 0, they are a user, and thus can't delete other accounts, but can request a fight
          }elseif ($level==0){?>
            <button type="button" class="btn btn-danger" style="margin-top:5%;">
              <a href="index.php?page=makeChallenge&level=0&path=known&userOneID=<?php echo $userID;?>" style="color: white;">Request a fight!</a>
            </button><?php
          };
          ?>
        </div>
      </div>
    </div>
    <div class="col-2"></div>
  </div>
</div>

<hr id="userDash" style="color: black;">
<!-- html code for the stats section of the selected user -->
<div class="container-fluid selectUser">
  <div class="row ">
    <div class="col-2"></div>
    <div class="col-8 selectUserBorder" style="background-color: #DFDFDF; border-radius: 30px;">
      <div class="mt-4 selectUserText">
        <h3>Status: </h3>
        <h5>-"<?php echo $selectUser_aa['status'];?>"</h5>
        <h3>People fought:</h3>
          <div class="row">
            <div class="col-6">
              <h5>Wins</h5>
              <?php
              $wins_sql ="SELECT c.userOneID, c.userTwoID, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.userOneID WHERE challenges.challengeID=c.challengeID) as userOne, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.userTwoID WHERE challenges.challengeID=c.challengeID) as userTwo FROM challenges c WHERE (userOneID=$userID or userTwoID=$userID) and winnerID=$userID";
              // select all from user where either the userOne or userTwo ID is the same as the selected users ID, and they won
              // run query
              $wins_qry=mysqli_query($dbconnect, $wins_sql);
              // put results into an array
              $wins_aa = mysqli_fetch_assoc($wins_qry);
              // set variables for both userOne and Two ID
              $userOneID = $wins_aa['userOneID'];
              $userTwoID = $wins_aa['userTwoID'];
              $userOne = $wins_aa['userOne'];
              $userTwo = $wins_aa['userTwo'];
              // if the query returns no results, display message below
              if ($wins_aa==null) {
                echo "This user hasn't won yet.";
              }
              // if userOne has the same ID as the selected user
              elseif ($userOneID==$userID) {
                // echo the other user (as this is who they won againts)
                echo $userTwo;
              }elseif ($userTwoID==$userID){
                // otherwise echo userOne as they (selected user) must be user Two.
                echo $userOne;
              }
               ?>
            </div>
            <div class="col-6">
              <h5>Loses</h5>
              <?php
              $loses_sql ="SELECT c.userOneID, c.userTwoID, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.userOneID WHERE challenges.challengeID=c.challengeID) as userOne, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.userTwoID WHERE challenges.challengeID=c.challengeID) as userTwo FROM challenges c WHERE (userOneID=$userID or userTwoID=$userID) and winnerID!=$userID";
              // select all from user where either the userOne or userTwo ID is the same as the selected users ID, and they won
              // run query
              $loses_qry=mysqli_query($dbconnect, $loses_sql);
              // put results into an array
              $loses_aa = mysqli_fetch_assoc($loses_qry);
              // set variables for both userOne and Two ID
              $userOneID = $loses_aa['userOneID'];
              $userTwoID = $loses_aa['userTwoID'];
              $userOne = $loses_aa['userOne'];
              $userTwo = $loses_aa['userTwo'];
              // if the query returns no results, display message below
              if ($loses_aa==null) {
                echo "This user hasn't lost yet.";
              }
              // if userOne has the same ID as the selected user
              elseif ($userOneID==$userID) {
                // echo the other user (as this is who they won againts)
                echo $userTwo;
              }elseif ($userTwoID==$userID){
                // otherwise echo userOne as they (selected user) must be user Two.
                echo $userOne;
              }
               ?>
            </div>
          </div>
        <h3>Results:</h3>
          <p><?php echo $selectUser_aa['firstName'];?> has won <?php echo $selectUser_aa['userWins'];?> fight/s.</p>
          <?php
          $userLoses =$selectUser_aa['totalChallenges'] - $selectUser_aa['userWins'];
          if ($selectUser_aa['totalChallenges']!=0) {
            $percentWon = ($selectUser_aa['userWins'] / $selectUser_aa['totalChallenges'])*100;
            $percentWonRound = sprintf('%0.2f', round($percentWon, 2));
          }else{
            $percentWonRound = "This user hasn't got any past events.";
          }
          ?>
          <p><?php echo $selectUser_aa['firstName'];?> has lost <?php echo $userLoses;?> fight/s.</p>
          <p>Percentage won: <?php echo $percentWonRound; ?></p>
      </div>
    </div>
  </div>
</div>
<?php } ?>
