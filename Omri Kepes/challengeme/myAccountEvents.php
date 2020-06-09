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
      <a class="nav-link" href="index.php?page=myAccount" style="color: black;" role="tab" aria-controls="v-pills-home" aria-selected="true">Profile</a>
      <hr style="margin-top: 0px; margin-bottom:2%;">
      <?php
      // if the logged in user is an admin, don't display the events option on the subnav (as they are't in any events)
      if (!isset($_SESSION['admin'])){?>
        <a class="nav-link active bg-danger" style="color: white;" role="tab" aria-controls="v-pills-profile" aria-selected="false" href="index.php?page=myAccountEvents">Challenges</a>
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
      <div class="row">
        <div class="col-12">
          <h3>Up and Coming</h3>
          <h5>
            <!-- Select any challenge that involves the active user (logged in user) and display it if the status isn't set to 0 or 2 (completed or pending), and is active (up and coming) -->
            <?php
            $user_sql="SELECT c.date, c.challengeID, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.userOneID WHERE challenges.challengeID=c.challengeID) as userOne, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.userTwoID WHERE challenges.challengeID=c.challengeID) as userTwo FROM challenges c WHERE (status=1) and (userOneID=$activeUserID or userTwoID=$activeUserID)";
            $user_qry=mysqli_query($dbconnect, $user_sql);
            // run a while statement repeating the code for each event
            while ($user_aa = mysqli_fetch_assoc($user_qry)){
            // assign the variables for the reuslts collected in the assosicated array
            $userOne= $user_aa['userOne'];
            $userTwo = $user_aa['userTwo'];
            $date = $user_aa['date'];
            $challengeID=$user_aa['challengeID'];?>
            <div class="row secondrow mb-4"style="background-color: black;">
              <div class="col-8"style="color: white; margin-top: 1%;">
                <h6><?php echo $date; ?></h6>
              </div>
            </div>
      <!-- Username and corosponding points, wins etc -->
              <div class="row userEventsUp">
                <div class="col-3">
                  <a style="color: black;" href="index.php?page=selectEvent&challengeID=<?php echo $challengeID;?>">More</a>
                </div>
                <div class="col-3">
                  <div class="userOne">
                  <?php echo $user_aa['userOne'];?>
                  </div>
                </div>
                <div class="col-3">
                  <h3>
                    <a class="VStext" style="color: #FF0000;" href="index.php?page=selectEvent&challengeID=<?php echo $user_aa['challengeID'];?>">VS</a>
                  </h3>
                </div>
                <div class="col-3">
                  <div class="userTwo">
                  <?php echo $userTwo?>
                  </div>
                </div>
              </div>
            <?php } ?>
                <hr>
            <h6 style="color: black; text-align: center;">No more up and coming events to see</h6>
            <p style="text-align: center;">Click <a style="color: black; text-decoration: underline; text-align: center;" href="index.php?page=makechallenge">here</a> to challenge someone else!</p>
          </h5>
        </div>
      </div>
      <!-- new row displaying the pending requested events that haven't been accepted -->
      <div class="row">
        <div class="col-12">
          <!-- select everything from the tabel 'challenges' and join the tabel user. Collect the challenge date, ID, and userOneID & userTwoID as well as the corrosponding usernames of each users in the challenge (reason for joining the tabel user), this allows us to grab the username from the user tabel when the userID= userOneID and userTwoID. Only display the results when the challenge is still pending (status !=1 or 2), and the active user isn't the creator (e.g. only show on the accounts page of the other user involved who didn't create the event.) -->
          <?php
          $user_sql = "SELECT c.date, c.challengeID, c.userOneID, c.creatorID, c.userTwoID, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.userOneID WHERE challenges.challengeID=c.challengeID) as userOne, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.userTwoID WHERE challenges.challengeID=c.challengeID) as userTwo FROM challenges c WHERE (creatorID!=$activeUserID) and (status!=1 and status!=2) and (userOneID=$activeUserID or userTwoID=$activeUserID)";
              // select everything from the coloum 'user' and order the info in descending order depending on how many wins that user has had
              // run sql query only if the select statement returns a result, otherwise display message below
          $user_qry=mysqli_query($dbconnect, $user_sql);
          // run while statement repeating the results
          while ($user_aa = mysqli_fetch_assoc($user_qry)){
            // assign variables for the results in the assosicated array
            $userOne= $user_aa['userOne'];
            $userTwo = $user_aa['userTwo'];
            $date = $user_aa['date'];
            $challengeID=$user_aa['challengeID'];?>

            <h3>Pending</h3>
            <h5 style="color: black;">
            <div class="row">
              <div class="col-3 text-center userEventsPending">
                <!-- display infomation from the database regrading that event -->
                <p><?php echo $user_aa['date']; ?></p>
              </div>
              <div class="col-5 text-center">
                <div class="userOne">
                  <!-- display infomation from the database regrading that event -->
                <?php echo $user_aa['userOne']; ?>
                </div>
              </div>
              <div class="col-4">
                <div class="row">
                  <div class="col-12 col-md-6 col-lg-6"style="font-size: 15px;">
                  <!-- html form allowing logged in user to respond to the challenge by selecting accept or decline -->
                    <form class="enterWinnerForm" action="index.php?page=responseEvent&response='pending'&challengeID=<?php echo $challengeID?>" method="post">
                      <select class="custom-select custom-select-sm"name="exampleRadios">
                        <option required  type="checkbox"  for="exampleRadios1" name="exampleRadios" id="exampleRadios1" value="accept" selected>accept</option>
                        <option required  type="radio"  for="exampleRadios2" name="exampleRadios" id="exampleRadios2" value="decline">decline</option>
                      </select>
                  </div>
                  <div class="col-12 col-md-6 col-lg-6">
                    <button class="btn btn-danger" name="submit">Done</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          <?php
            }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
