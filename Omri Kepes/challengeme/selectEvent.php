<?php
// check to see if session is set
session_start();
// if session isn't set, send user to login page with error
if(!isset($_SESSION['userID'])){
  header("Location: index.php?page=login&error=notsetMyAccount");
}
// if challengeID isn't set redirect user to the upandcoming page
if (!isset($_GET['challengeID'])) {
header("Location: index.php?page=upAndComing");
}
// assign the challengeID to the variable
$challengeID=$_GET['challengeID'];?>
<!-- select the date, challengeID, userone & two ID's and userone and twos usernames and the events bets from the database where the challengeID is equal to the challenge ID set in the variable above-->
<?php
$user_sql = "SELECT c.date, c.challengeID, c.userTwoID, c.userOneID, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.userOneID WHERE challenges.challengeID=c.challengeID) as userOne, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.userTwoID WHERE challenges.challengeID=c.challengeID) as userTwo FROM challenges c where challengeID=$challengeID";
// run mysql query
$user_qry = mysqli_query($dbconnect, $user_sql);
// put results into an assoiciated array
$user_aa = mysqli_fetch_assoc($user_qry);
// if the challengeID returns no results (e.g. random challengeID that doesn't exsit)
if ($user_aa==null) {
  Header("Location: index.php?page=upAndComing");
  // else display the challenge details
}else{
// assign variables for the data collected from the database
$userOneID = $user_aa['userOneID'];
$userTwoID = $user_aa['userTwoID'];
$challengeID = $user_aa['challengeID'];
?>
<div class="top" style="margin-top: 20px;">
  <a style="color: black; text-decoration: underline; margin-left: 5%;" href="index.php?page=upAndComing">Back</a>
</div>
<!-- basic html code for the display of the selected evemt -->
<div class="container-fluid">
<div class="row mt-5 text-center">
  <div class="col-12">
    <h2>It's on!
    <!-- display both users from the database -->
    <?php echo $user_aa['userOne']; ?> VS <?php echo $user_aa['userTwo']; ?>
    </h2>
  </div>
</div>
<div class="row toprow mb-4">
  <div class="col-0 col-lg-1"style="background-color: #F3F3F3;"></div>
  <div class="col-lg-10">
    <h6 class="secondrowtext"></h6>
  </div>
  <div class="col-0 col-lg-1"style="background-color: #F3F3F3;"></div>
</div>
<!-- Username and corosponding points, wins etc -->
<div class="row">
  <div class="col-3 col-md-2 offset-lg-1 text-center">
    <!-- display events info -->
    <h6><?php echo $user_aa['date']; ?></h6>
  </div>
    <div class="col-3 col-lg-2">
      <div class="userOne" style="text-align: right;">
        <!-- display events info -->
      <?php echo $user_aa['userOne']; ?>
      </div>
    </div>
    <div class="col-2 text-center">
      <h3>VS</h3>
    </div>
    <div class="col-3">
      <div class="userTwo">
        <!-- display events info -->
        <?php echo $user_aa['userTwo'];?>
      </div>
    </div>
</div>
<hr>
<?php
// select from database where the userID is the same as userOne ID
// this whole section displays the info of userOne and their stats, wins etc.
$user_sql = "SELECT * FROM user where userID=$userOneID";
$user_qry = mysqli_query($dbconnect, $user_sql);
$user_aa = mysqli_fetch_assoc($user_qry);
$usernameOne = $user_aa['username'];
$userOneID = $user_aa['userID'];
 ?>
<div class="selectUsers mt-5">
  <div class="row">
    <div class="col-md-1 col-0"></div>
    <div class="col-md-4 col-11 selectEventBorder">
      <div class="row">
        <div class="col-12 bg-danger">
          <h4 style="color: white;"><?php echo $user_aa['username']; ?></h4>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <h4><?php echo $user_aa['status']; ?></h4>
        </div>
      </div>
        <div class="row">
          <div class="col-lg-12 text-center">
            <h5>First name: <?php echo $user_aa['firstName'];?></h5>
            <h5>Last name: <?php echo $user_aa['lastName'];?></h5>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 text-center">
            <h5>Total wins: <?php echo $user_aa['userWins']; ?></h5>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 text-center">
            <h5>Points: <?php echo $user_aa['userPoints']; ?></h5>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 text-center">
            <h5>Total Challenges: <?php echo $user_aa['totalChallenges']; ?></h5>
          </div>
        </div>
      </div>
    <div class="col-md-1 col-12 mt-4 text-center"></div>
    <?php
    // this whole section displays the info of usertwo (stats, wins, etc.)
    $user_sql = "SELECT * FROM user where userID=$userTwoID";
    $user_qry = mysqli_query($dbconnect, $user_sql);
    $user_aa = mysqli_fetch_assoc($user_qry);
    $usernameTwo = $user_aa['username'];
    $userTwoID = $user_aa['userID']
     ?>
     <div class="col-md-4 col-11 selectEventBorder">
       <div class="row">
         <div class="col-lg-12 bg-danger">
           <h4 style="color: white"><?php echo $user_aa['username']; ?></h4>
         </div>
       </div>
       <div class="row">
         <div class="col-lg-12">
           <p><?php echo $user_aa['status']; ?></p>
         </div>
       </div>
         <div class="row">
           <div class="col-lg-12 text-center">
             <h5>First name: <?php echo $user_aa['firstName'];?></h5>
             <h5>Last name: <?php echo $user_aa['lastName'];?></h5>
           </div>
         </div>
         <div class="row">
           <div class="col-lg-12 text-center">
             <h5>Total wins: <?php echo $user_aa['userWins']; ?></h5>
           </div>
         </div>
         <div class="row">
           <div class="col-lg-12 text-center">
             <h5>Points: <?php echo $user_aa['userPoints']; ?></h5>
           </div>
         </div>
         <div class="row">
           <div class="col-lg-12 text-center">
             <h5>Total Challenges: <?php echo $user_aa['totalChallenges']; ?></h5>
           </div>
         </div>
       </div>
    <div class="col-md-1 col-0"></div>
  </div>
</div>
<?php
// assign the varible activeuserID to the userID of the logged in user
$activeUserID = $_SESSION['userID'];
// if the logged in userID is the same as either one of the userID's in the selected event, run this code
if ($activeUserID==$userTwoID || $activeUserID==$userOneID){
  ?>
  <!-- html code for the ability for users taking part in the event to select a winner -->
   <div class="row">
     <div class="col-lg-4"></div>
     <div class="col-lg-4 text-center mt-5">
       <h4>Select Winner</h4>
         <form class="enterWinnerForm" action="index.php?page=enterChallenge&status=submit&edit=null&challengeID=<?php echo $challengeID; ?>" method="post">
           <div class="form-check-inline">
             <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="<?php echo $userOneID; ?>">
             <label class="form-check-label" for="exampleRadios1">
               <?php echo $usernameOne; ?>
             </label>
           </div>
           <div class="form-check-inline">
             <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="<?php echo $userTwoID; ?>">
             <label class="form-check-label" for="exampleRadios2">
               <?php echo $usernameTwo; ?>
             </label>
           </div>
           <br>
           <button type="submit" name="submit">enter</button>
         </form>
       <p>Please note: Once you submit a winner you will be unable to edit this. Admins are able to edit, and delete results.</p>
     </div>
     <div class="col-lg-4"></div>
   </div>
<?php
} else;
?>
</div>
<?php } ?>
