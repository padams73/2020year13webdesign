<?php
// check to make sure session is set to admin
session_start();
// if session isn't set (not an admin account), send back to home page
if(!isset($_SESSION['userID'])){
  header("Location: index.php?page=login&error=notsetMyAccount");
}elseif (!isset($_SESSION['admin'])){
  header("Location: index.php?page=upAndComing");
}
?>
<!-- displays selected event and allows admin to change the winner -->
<div class="container-fluid">
  <div class="row mt-5">
    <div class="col-lg-5 offset-lg-1 col-md-6 offset-md-0 upAndComingTitle">
      <h3>Completed challenges!</h3>
    </div>
    <div class="col-lg-1 col-md-6">
      <a style="color: black; text-decoration: underline;" href="index.php?page=submittedResults">Back</a>
    </div>
  </div>
</div>
  <div class="toprow row">
    <div class="col-lg-1 col-0" style="background-color: #F3F3F3;"></div>
    <div class="col-2 text-center">
      <h6 class="toprowtext">DATE</h6>
    </div>
    <div class="col-5 text-center">
      <h6 class=" toprowtext">USERNAMES</h6>
    </div>
    <div class="col-3 col-lg-2 text-center">
      <h6 class=" toprowtext">WINNER</h6>
    </div>
    <div class="col-2"style="background-color: #F3F3F3;">
    </div>
  </div>
    <?php
    // gets the challengeID which has been set and asigns it to the variable
    $challengeID = $_GET['challengeID'];
    ?>
    <!-- selects the from the coloum 'user' and order the data in decreasing order depending on the number of wins that user has -->
    <!-- select the date of the event, winner, userOneID, userTwoID, userOne (useroneUsername), and userTwo (usertwoUsername) -->
    <!-- only select events where the status is set = 2 (e.g. result has been submitted but not approved) -->
    <?php
    $user_sql="SELECT c.date, c.winnerID, c.userOneID, c.userTwoID, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.userOneID WHERE challenges.challengeID=c.challengeID) as userOne, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.userTwoID WHERE challenges.challengeID=c.challengeID) as userTwo, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.winnerID WHERE challenges.challengeID=c.challengeID) as winner FROM challenges c WHERE status =2 and challengeID=$challengeID ORDER BY c.date asc";
    // run a mysql query
    $user_qry=mysqli_query($dbconnect, $user_sql);
    // put the results collected into an asssosiated array
    $user_aa = mysqli_fetch_assoc($user_qry);
    // set the variables for the data collected
      $userOne= $user_aa['userOne'];
      $userTwo = $user_aa['userTwo'];
      $date = $user_aa['date'];
      $userOneID = $user_aa['userOneID'];
      $userTwoID = $user_aa['userTwoID'];
      $winner = $user_aa['winner'];
      $winnerID = $user_aa['winnerID'];
    ?>
      <div class="row">
        <div class="col-2 offset-lg-1 text-center">
          <?php echo $user_aa['date']; ?>
        </div>
        <div class="col-2">
          <div class="userOne" style="text-align: right;">
          <?php echo $user_aa['userOne']; ?>
          </div>
        </div>
        <div class="col-1 text-center">
          <h3>
            <a class="VStext" href="index.php?page=selectEvent&challengeID=<?php echo $challengeID;?>">VS</a>
          </h3>
        </div>
        <div class="col-2">
          <div class="userTwo">
            <?php echo $userTwo ?>
          </div>
        </div>
        <div class="col-lg-2 col-3 text-center">
          <div class="editWinner" style="text-align: left;">
            <!-- a form that displays both users in the event, allowing the admin to select one as a new winner -->
            <form class="editWinnerForm" action="index.php?page=enterChallenge&status=submit&edit=admin&challengeID=<?php echo $challengeID?>" method="post">
              <select class="form-control form-control-sm"name='newWinnerID'>
                <option value="<?php echo $userOneID; ?>"><?php echo $userOne; ?></option>
                <option value="<?php echo $userTwoID; ?>"><?php echo $userTwo; ?></option>
              </select>
              <br>
          </div>
        </div>
        <div class="col-2 text-center">
          <button type="submit" name="submit">Update Winner</button>
        </form>
        </div>
      </div>
