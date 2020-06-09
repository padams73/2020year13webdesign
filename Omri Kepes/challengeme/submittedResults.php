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
<!-- Displays all pending events with a status of 0. Able to delete or accept the challenge -->
<div class="top" style="margin-top: 20px;">
  <!-- link back to home page -->
  <a style="color: black; text-decoration: underline; margin-left: 5%;"href="index.php?page=home">Back</a>
</div>
  <div class="container-fluid">
    <div class="row mt-3">
      <div class="col-lg-6 offset-lg-1 col-md-12 offset-md-0 upAndComingTitle">
        <h3>Completed challenges!</h3>
      </div>
      <div class="col-lg-3 col-md-6 offset-md-0">
        <p>
          <?php
          if (isset($_GET['error'])) {
            $message = $_GET['error'];
            if ($message=="failed") {
              echo "*Sorry an error occured while approving those results. Please try again.";
            }elseif ($message=="accepted"){
              echo "*Results have successfully been updated.";
            }elseif ($message=="completed"){
              ?> <p style="color: green;">*Event has been completed. Points will be automatically updated.</p><?php
            };
          };
          ?>
        </p>
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
        <h4 class="toprowtext" style="color: black; text-transform: uppercase;">Approve result</h4>
      </div>
    </div>
    <?php
    $user_sql="SELECT c.date, c.challengeID, c.winnerID, c.userOneID, c.userTwoID, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.userOneID WHERE challenges.challengeID=c.challengeID) as userOne, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.userTwoID WHERE challenges.challengeID=c.challengeID) as userTwo, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.winnerID WHERE challenges.challengeID=c.challengeID) as winner FROM challenges c WHERE status =2 ORDER BY c.date asc";
    // select everything from the coloum 'user' and order the info in descending order depending on how many wins that user has had
    // run sql query
    $user_qry=mysqli_query($dbconnect, $user_sql);
    // run while statement
    while ($user_aa = mysqli_fetch_assoc($user_qry)){
      // assign varibles to the data collected
      $userOne= $user_aa['userOne'];
      $userTwo = $user_aa['userTwo'];
      $date = $user_aa['date'];
      $challengeID=$user_aa['challengeID'];
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
            <a class="VStext" href="index.php?page=selectEvent&challengeID=<?php echo $user_aa['challengeID'];?>">VS</a>
          </h3>
        </div>
        <div class="col-2">
          <div class="userTwo">
            <?php echo $userTwo ?>
          </div>
        </div>
        <div class="col-lg-2 col-3 text-center">
          <div class="winner">
            <?php echo $winner;?>
            <a style="color: red; text-decoration: none;" href="index.php?page=editWinner&challengeID=<?php echo $challengeID; ?>">Edit</a>
          </div>
        </div>
        <div class="col-2 text-center">
            <form class="enterWinnerForm" action="index.php?page=enterChallenge&status=confirm&challengeID=<?php echo $challengeID?>" method="post">
              <div class="form-check-inline">
                <input class="form-check-input" required type="radio" name="exampleRadios" id="exampleRadios1" value="accept">
                <label class="form-check-label" for="exampleRadios1">accept</label>
              </div>
              <button style="border-radius: 10px"type="submit" name="submit">enter</button>
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
</div>
