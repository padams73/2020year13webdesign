<?php
// check to see is a session is set
session_start();
// if not set userID then send them to the login page
if (!isset($_SESSION['userID'])) {
  Header("Location: index.php?page=login&error=notsetMyAccount");
  // if not set as admin (e.g. lgoged in user isn't an admin) then send them to the up and coming page
}elseif(!isset($_SESSION['admin'])){
  header("Location: index.php?page=upAndComing");
}
 ?>
<!-- Displays all pending events with a status of 0. Able to delete or accept the challenge -->
<div class="top" style="margin-top: 20px;">
  <!-- link back to home page -->
  <a style="color: black; text-decoration: underline; margin-left: 5%;"href="index.php?page=home">Back</a>
</div>
<div class="row mt-5">
  <div class="col-lg-5 offset-lg-1 col-md-6 offset-md-0 upAndComingTitle">
    <h3>More events to come!</h3>
  </div>
  <div class="col-lg-3 text-lg-right text-left col-md-6">
    <?php
    if (isset($_GET['error'])) {
      $message = $_GET['error'];
      if ($message=="accepted") {
        ?> <p>*Event has been accepted.</p> <?php
      }elseif($message=="declined"){
        ?> <p>*Event has been deleted.</p> <?php
      }else;
    }else;
    ?>
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
    <h6 class=" toprowtext">BETS</h6>
  </div>
  <div class="col-2"style="background-color: #F3F3F3;">
    <h4 class="toprowtext" style="color: black; text-transform: uppercase;">Pending Events</h4>
  </div>
</div>
    <?php
    $user_sql="SELECT c.date, c.challengeID, c.userOneID, c.userTwoID, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.userOneID WHERE challenges.challengeID=c.challengeID) as userOne, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.userTwoID WHERE challenges.challengeID=c.challengeID) as userTwo FROM challenges c WHERE status !=1 and status !=2 ORDER BY c.date asc";
    // select everything from the coloum 'user' and order the info in descending order depending on how many wins that user has had
    // run sql query
    $user_qry=mysqli_query($dbconnect, $user_sql);
    // run while statement repeating code for each different event
    while ($user_aa = mysqli_fetch_assoc($user_qry)){
      // assign varibles to the data collected and stored in the assosicated array
      $userOne= $user_aa['userOne'];
      $userTwo = $user_aa['userTwo'];
      $date = $user_aa['date'];
      $challengeID=$user_aa['challengeID'];
      $userOneID = $user_aa['userOneID'];
      $userTwoID = $user_aa['userTwoID'];
    ?>
    <!-- html code for the pending events display -->
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
            <a class="VStext" href="index.php?page=selectEvent&challengeID=<?php echo $user_aa['challengeID'];?>">VS</a>
          </h3>
        </div>
        <div class="col-2">
          <div class="userTwo">
            <?php echo $userTwo ?>
          </div>
        </div>
        <div class="col-lg-2 col-3 text-center">
          <div class="score">
            <p style="text-decoration: underline;" title="Betting will be opened after approval">Closed</a>
          </div>
        </div>
        <div class="col-2 text-center">
          <!-- form allowing the admin to accept or decline the event -->
            <form class="enterWinnerForm" action="index.php?page=responseEvent&response='pending'&challengeID=<?php echo $challengeID?>" method="post">
              <div class="form-check-inline">
                <input class="form-check-input" required type="radio" name="exampleRadios" id="exampleRadios1" value="accept">
                <label class="form-check-label" for="exampleRadios1">Accept</label>
              </div>
              <div class="form-check-inline">
                <input class="form-check-input" required type="radio" name="exampleRadios" id="exampleRadios2" value="decline">
                <label class="form-check-label" for="exampleRadios2">Decline</label>
              </div>
              <br>
              <button type="submit" name="submit">Confirm</button>
            </form>
        </div>
      </div>
  <?php }; ?>
  <div class="row">
    <div class="col-lg-1 col-0"></div>
    <div class="col-2"></div>
    <div class="col-5 text-center">
      <br>
      <p style="text-align: center; color: black;">No more results to see here!</p>
    </div>
  </div>
