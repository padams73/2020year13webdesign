<?php
// check to see if session is set
session_start();
// if session isn't set, send to login page
if(!isset($_SESSION['userID'])){
  header("Location: index.php?page=login&error=notsetMyAccount");
}
// assign the logged in userID to the variable 'activeID'
$activeID= $_SESSION['userID'];
// select from database everything where the userID = the logged in userID
$user_sql = "SELECT * FROM user WHERE userID=$activeID";
// Run mysql query
$user_qry = mysqli_query($dbconnect, $user_sql);
// put results found into a assosicated array
$user_aa = mysqli_fetch_assoc($user_qry);
// assign the level to a variable called $level
// level is the level of the user e.g. user, admin etc.
$level = $user_aa['level'];
// if the level ==1 e.g. the logged in user is an admin
if ($level==1) {
   ?>
   <div class="top" style="margin-top: 20px;">
     <!-- link back to home page -->
     <a style="color: black; text-decoration: underline; margin-left: 5%;"href="index.php?page=home">Back</a>
   </div>
   <!-- display form and text allowing admin to create a challenge between two differnt users -->
  <div class="col-10 col-lg-4 offset-lg-4 offset-1 mt-4">
    <h3>Create challenge between two users</h3>
    <p>Please note - Challenge must also be approved by the users effected before being displayed on the Up and Coming page</p>
    <p>Users will be unable to edit the date of the event after the event has been created.</p>
      <form action="index.php?page=enterChallenge&status=create&creatorID=<?php echo $activeID; ?>&level=1" method="post">
        <div class="form-group">
          <?php
          if (isset($_GET['error'])) {
            $message = $_GET['error'];
            if ($message=="sameUsers") {
              ?> <p style="color: red; font-weight: bold;">*Please enter two different users</p> <?php
            }
          }else;
          ?>
          <label>Select user one</label>
          <!-- selects the userOne for the fight -->
            <select class="form-control" name="userOneID">
              <?php
              // select users (no admins)
                $user_sql = "SELECT * FROM user WHERE level!=1";
                // run query
                $user_qry = mysqli_query($dbconnect, $user_sql);
                // put results into an array
                $user_aa = mysqli_fetch_assoc($user_qry);
                do {
                ?>
                <!-- display the usernames of all users, and set their value to their userID -->
                    <option value="<?php echo $user_aa['userID']; ?>">
                      <?php echo $user_aa['username']; ?>
                    </option>
                <?php
              } while ($user_aa = mysqli_fetch_assoc($user_qry));
                ?>
            </select>
          </div>
        <!-- usertwo can be seleted here -->
          <div class="form-group">
            <label>select user two</label>
              <select class="form-control" name="userTwoID">
                <?php
                // select all users
                  $user_sql = "SELECT * FROM user WHERE level!=1";
                  // run query
                  $user_qry = mysqli_query($dbconnect, $user_sql);
                  // put results into an array
                  $user_aa = mysqli_fetch_assoc($user_qry);
                  do {
                  ?>
                  <!-- display all usernames and set their values to the usernames userID -->
                      <option value="<?php echo $user_aa['userID']; ?>">
                        <?php echo $user_aa['username']; ?>
                      </option>
                  <?php
                } while ($user_aa = mysqli_fetch_assoc($user_qry));
                  ?>
                </select>
                <div class="mt-4">
                  <label for="date">Date:</label>
                  <input type="date" required="required" id="date" name="date">
                </div>
          </div>
            <button type="submit" class="btn btn-danger">Submit</button>
          </form>
      </div>
<?php
// else, if the level==0 e.g. the logged in user is a user account, display code allowing them to challenge another user
}elseif ($level==0){
  // if the path comes from a selected user page, e.g. two fighters are known
  if (isset($_GET['path'])) {
    $path = $_GET['path'];
    if ($path == "known") {
      // set a veriable for the select userID whos been challenged
      $userOneID = $_GET['userOneID'];
      // select everything from the database where the userID is the same as the selected userID (and the user isn't an admin)
      $selectUser_sql = "SELECT * FROM user WHERE userID=$userOneID and (level!=1)";
      // run mysql statement
      $selectUser_qry = mysqli_query($dbconnect, $selectUser_sql);
      // put results into an assoiciated array
      $selectUser_aa = mysqli_fetch_assoc($selectUser_qry);
      // rename the variable for the challenged user
      $selectUserID = $selectUser_aa['userID'];?>
      <!-- html code for create challenge page -->
      <div class="top" style="margin-top: 20px;">
        <!-- link back to the selected users page -->
        <a style="color: black; text-decoration: underline; margin-left: 5%;"href="index.php?page=selectUser&userID=<?php echo $_GET['userOneID'];?>">Back</a>
      </div>
    <div class="col-12 mt-5 mb-6">
      <div class="row">
        <div class="col-8 text-center">
          <h3 style="text-align: center; margin-bottom: 2%;">Challenge User</h3>
        </div>
      </div>
      <hr id="userDash" style="color: black;">
      <div class="row">
        <!-- user agreement, including a form for the dat of the challenge they're making -->
        <div class="col-md-3 col-lg-3 mt-4 offset-lg-1 col-8 order-last order-md-first offset-0">
          <h4>User agreement.</h4>
          <p>By selecting a date, and submitting this challenge I am agreeing to take part in a ChallengeMe challenge. I'm willing and able to challenge <?php echo $selectUser_aa['username']; ?> on this date, and will not minipulate, or cancel without contacting an admin.</p>
          <h4>Select date:</h4>
          <!-- send form to enter challenge, while userOneID is eqaul to the active users ID -->
            <form action="index.php?page=enterChallenge&userOneID=<?php echo $userOneID;?>&status=create&level=0" method="post">
              <div class="form-group">
                <label for="date">date:</label>
                <input required type="date" id="date" name="date">
              </div>
              <button type="submit" class="btn btn-danger">Submit</button>
            </form>
        </div>
        <div class="col-11 col-md-8 col-lg-8">
          <!-- html code for the stats section of the selected user -->
          <div class="selectUser">
            <div class="row">
              <div class="col-lg-2 col-0"></div>
              <div class="col-lg-8 col-12 selectUserBorder" style="background-color: #DFDFDF; border-radius: 30px;">
                <div class="mt-4 selectUserText">
                  <h3>username:</h3>
                  <h5> <?php echo $selectUser_aa['username']; ?></h5>
                  <h3>Status: </h3>
                  <h5>-"<?php echo $selectUser_aa['status'];?>"</h5>
                  <h3>People fought:</h3>
                    <div class="row">
                      <div class="col-6">
                        <h5>Wins</h5>
                        <?php
                        $wins_sql ="SELECT c.userOneID, c.userTwoID, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.userOneID WHERE challenges.challengeID=c.challengeID) as userOne, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.userTwoID WHERE challenges.challengeID=c.challengeID) as userTwo FROM challenges c WHERE (userOneID=$selectUserID or userTwoID=$selectUserID) and winnerID=$selectUserID";
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
                        elseif ($userOneID==$selectUserID) {
                          // echo the other user (as this is who they won againts)
                          echo $userTwo;
                        }elseif ($userTwoID==$selectUserID){
                          // otherwise echo userOne as they (selected user) must be user Two.
                          echo $userOne;
                        }
                         ?>
                      </div>
                      <div class="col-6">
                        <h5>Loses</h5>
                        <?php
                        $loses_sql ="SELECT c.userOneID, c.userTwoID, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.userOneID WHERE challenges.challengeID=c.challengeID) as userOne, (SELECT user.userName FROM challenges JOIN user on user.userID=challenges.userTwoID WHERE challenges.challengeID=c.challengeID) as userTwo FROM challenges c WHERE (userOneID=$selectUserID or userTwoID=$selectUserID) and winnerID!=$selectUserID";
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
                        elseif ($userOneID==$selectUserID) {
                          // echo the other user (as this is who they won againts)
                          echo $userTwo;
                        }elseif ($userTwoID==$selectUserID){
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
        </div>
      </div>
    </div>
<?php
    }else;
    // else if they're creating a new challenge from the create challenge page
  }else{
  ?>
  <div class="top" style="margin-top: 20px;">
    <!-- link back to home page -->
    <a style="color: black; text-decoration: underline; margin-left: 5%;"href="index.php?page=home">Home</a>
  </div>
   <div class="container-fluid mt-3 mb-4">
     <div class="row">
       <div class="col-lg-12 col-md-12 text-center">
         <h3 style="font-size: 30px;">ChallengeMe User List</h3>
         <p>Select a user to challenge below.</p>
       </div>
     </div>
   <!-- Table of users and their rank. Inside a jumbotron with different sections for points etc -->
       <div class="row leaderboard bg-white mb-5 ml-lg-3 mr-md-3 ml-md-3 mr-sm-2 ml-sm-2">
         <div class="col-12">
           <div class="row toprow">
             <div class="col-4">
               <h6 class="toprowtext">Username</h6>
             </div>
             <div class="col-1">
               <h6 class="toprowtext">Wins</h6>
             </div>
             <div class="col-1">
               <h6 class="toprowtext">Loses</h6>
             </div>
             <div class="col-1">
               <h6 class="toprowtext">Points</h6>
             </div>
             <div class="col-2">
               <h6 class="toprowtext">Total fights</h6>
             </div>
             <div class="col-1">
               <h6 class="toprowtext">Action</h6>
             </div>
             <div class="col-1"></div>
           </div>
           <!-- Getting users data from databass (username, points, wins etc)-->
           <?php
           // set variable for the userID of the logged in user (e.g. activeUser)
           $activeUserID = $_SESSION['userID'];
           // select everything from the coloum 'user' and order the info in descending order depending on how many wins that user has had
           // only select users with level 0 (e.g. no admins) and don't display the logged in user (user with same userID as the activeUserID)
           $user_sql="SELECT * FROM `user` where (level!=1 and userID!=$activeUserID) ORDER BY `userID` asc";
           // run sql query
           $user_qry=mysqli_query($dbconnect, $user_sql);
           // select the userName of the user
           // run while statement for leaderborad (repeating the code for each new user)
           while ($user_aa = mysqli_fetch_assoc($user_qry)){
             // assign the data to the variables below
             $username= $user_aa['username'];
             $userWins = $user_aa['userWins'];
             $userPoints = $user_aa['userPoints'];
             $userID = $user_aa['userID'];
             $userTotal = $user_aa['totalChallenges'];
              ?>
   <!-- Username and corosponding points, wins etc -->
             <div class="row">
               <div class="col-4">
                 <div class="name">
                   <a style="color: black;" href="index.php?page=selectUser&userID=<?php echo $userID;?>">
                     <?php
                     // if the userID has been selected (from the select user page) then display their name in orange (highlighting it for deletion from the admin)
                     if (isset($_GET['selectedUserID'])) {
                       // if selectedUserID (which was set back on the select user page), is equal to te userID of a user on the userlistadmin page, color it red
                       if ($_GET['selectedUserID']==$userID) {?>
                         <p style="color: orange; font-weight: bold;"><?php echo $username;?></p> <?php
                         // otherwise, color all other names black
                       }else{
                         echo $username;
                       }
                     }else {
                       echo $username;
                     }
                     ?>
                   </a>
                 </div>
               </div>
               <div class="col-1">
                 <div class="userWins">
                   <?php
                   // if the logged in user is the same as a user displayed on the leaderbaord, display text in red
                   if ($_SESSION['userID']==$userID) {?>
                     <p style="color: red;"><?php echo $userWins;?></p> <?php
                   }else {
                     echo $userWins;
                   }
                   ?>
                 </div>
               </div>
               <div class="col-1">
                   <?php
                   // calculate userLoses by taking the totals - the wins
                   $userLose = $userTotal - $userWins;
                   // if the logged in user is the same as a user displayed on the leaderbaord, display text in red
                   if ($_SESSION['userID']==$userID) {?>
                     <p style="color: red;"><?php echo $userLose;?></p> <?php
                   }else {
                     echo $userLose;
                   }
                   ?>
               </div>
               <div class="col-1">
                 <div class="userPoints">
                   <?php
                   // if the logged in user is the same as a user displayed on the leaderbaord, display text in red
                   if ($_SESSION['userID']==$userID) {?>
                     <p style="color: red;"><?php echo $userPoints;?></p> <?php
                   }else {
                     echo $userPoints;
                   }
                   ?>
                 </div>
               </div>
               <div class="col-1">
                 <div class="userTotal text-center">
                   <?php
                   // if the logged in user is the same as a user displayed on the leaderbaord, display text in red
                   if ($_SESSION['userID']==$userID) {?>
                     <p style="color: red;"><?php echo $userTotal;?></p> <?php
                   }else {
                     echo $userTotal;
                   }
                   ?>
                 </div>
               </div>
               <div class="col-2 offset-1">
                 <!-- send to the enter challenge page with the correct infomation. -->
                 <a style="color: red;" href="index.php?page=makechallenge&level=0&path=known&userOneID=<?php echo $userID;?>">Challenge!</a>
               </div>
             </div>
             <hr>
           <?php } ?>
         </div>
       </div>
     </div>
    <?php }; ?>
<?php };?>
