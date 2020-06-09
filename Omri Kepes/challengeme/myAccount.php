<?php
// check to see of session is set
session_start();
// if session isn't set then redirect to the login page with error message
if (!isset($_SESSION['userID'])) {
  Header("Location: index.php?page=login&error=notsetMyAccount");
}elseif (isset($_SESSION['admin'])){
  Header("Location: index.php?page=myAccountEdit");
}
// assign the variable for the logged in userID as activeUserID
$activeUserID=$_SESSION['userID'];
// select all data from the database where the userID is the same as the logged in user
$user_sql = "SELECT * FROM user WHERE userID=$activeUserID";
// run mysql query
$user_qry = mysqli_query($dbconnect, $user_sql);
// put results into an assosicated array
$user_aa = mysqli_fetch_assoc($user_qry);
// assign variables below for the data collected (e.g. username, userID etc.)
$activeUserID = $user_aa['userID'];
$activeUsername = $user_aa['username'];
$activeUserFirstName = $user_aa['firstName'];
$activeUserLastName = $user_aa['lastName'];
$activeUserStatus = $user_aa['status'];
?>
<!-- basic html code for the display of the logged in users account dashboard -->
<div class="container-fluid">
  <div class="row" id=myAccountusername>
    <div class="col-12 text-right"style="color: white;">
      <!-- display the logged in users info -->
      <h2 style="color: black;"><?php echo $activeUsername; ?></h2>
    </div>
  </div>
  <div class="row"id=myAccountName>
    <div class="col-4 offset-2">
      <a type="button" class="btn btn-inline-danger bg-danger" href='index.php?page=Logout'style="color: white;">Logout</a>
    </div>
    <div class="col-6 text-right" style="color: white;">
      <!-- display the logged in users info -->
      <h4 style="color: black;"><?php echo$activeUserFirstName; ?> <?php echo $activeUserLastName; ?></h4>
    </div>
  </div>
  <hr id="userDash">
  <!-- sub navbar for the account section -->
  <div class="row">
  <div class="col-md-3 col-lg-3 col-4 offset-lg-1 offset-md-1 offset-0 bg-white mt-5" style="border: 1px solid black; height: 210px;">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="margin-top: 5%; margin-bottom: 5%;">
      <a class="nav-link active bg-danger" href="index.php?page=myAccount" role="tab" aria-controls="v-pills-home" aria-selected="true">Profile</a>
      <hr style="margin-top: 0px; margin-bottom:2%;">
      <?php
      // if the logged in user is an admin, don't display the events option on the subnav (as they are't in any events)
      if (!isset($_SESSION['admin'])){?>
        <a class="nav-link" style="color: black;" role="tab" aria-controls="v-pills-profile" aria-selected="false" href="index.php?page=myAccountEvents">Challenges</a>
        <hr style="margin-top: 0px; margin-bottom:2%;">
      <?php
      }else;
      ?>
      <a class="nav-link" style="color: black;" role="tab" aria-controls="v-pills-profile" aria-selected="false" href="index.php?page=myAccountEdit">Edit</a>
      <hr style="margin-top: 0px; margin-bottom:2%;">
      <a class="nav-link" style="color: black;" href="index.php?page=myAccountSettings" role="tab" aria-controls="v-pills-messages" aria-selected="false">Settings</a>
    </div>
  </div>
    <div class="col-6 offset-1 offset-md-1 bg-white mt-5" style="border: 1px solid black;">
      <div class="userText" style="margin: 3%; color: black;">
        <!-- display the logged in users info -->
        <h5>Status: "<?php echo $activeUserStatus; ?>"</h5>
            <div class="row">
              <div class="col-6">
                <h5 style="text-decoration: underline;">Wins</h5>
                <?php
                $wins_sql ="SELECT c.userOneID, c.userTwoID, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.userOneID WHERE challenges.challengeID=c.challengeID) as userOne, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.userTwoID WHERE challenges.challengeID=c.challengeID) as userTwo FROM challenges c WHERE (userOneID=$activeUserID or userTwoID=$activeUserID) and winnerID=$activeUserID";
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
                elseif ($userOneID==$activeUserID) {
                  // echo the other user (as this is who they won againts)
                  echo $userTwo;
                }elseif ($userTwoID==$activeUserID){
                  // otherwise echo userOne as they (selected user) must be user Two.
                  echo $userOne;
                }
                 ?>
              </div>
              <div class="col-6">
                <h5 style="text-decoration: underline;">Loses</h5>
                <?php
                $loses_sql ="SELECT c.userOneID, c.userTwoID, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.userOneID WHERE challenges.challengeID=c.challengeID) as userOne, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.userTwoID WHERE challenges.challengeID=c.challengeID) as userTwo FROM challenges c WHERE (userOneID=$activeUserID or userTwoID=$activeUserID) and winnerID!=$activeUserID";
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
                elseif ($userOneID==$activeUserID) {
                  // echo the other user (as this is who they won againts)
                  echo $userTwo;
                }elseif ($userTwoID==$activeUserID){
                  // otherwise echo userOne as they (selected user) must be user Two.
                  echo $userOne;
                }
                 ?>
              </div>
            </div>
          <h3 class="mt-3">Results:</h3>
            <p>You've won <?php echo $user_aa['userWins'];?> fight/s.</p>
            <?php
            $userLoses =$user_aa['totalChallenges'] - $user_aa['userWins'];
            if ($user_aa['totalChallenges']!=0) {
              $percentWon = ($user_aa['userWins'] / $user_aa['totalChallenges'])*100;
              $percentWonRound = sprintf('%0.2f', round($percentWon, 2));
            }else{
              $percentWonRound = "This user hasn't got any past events.";
            }
            ?>
            <p>You've lost <?php echo $userLoses;?> fight/s.</p>
            <p>Percentage won: <?php echo $percentWonRound; ?></p>
      </div>
    </div>
  </div>
</div>
