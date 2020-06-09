<?php
// check to see of session is set
session_start();
// if session isn't set then redirect to the login page with error message
if (!isset($_SESSION['userID'])) {
  Header("Location: index.php?page=login&error=notsetMyAccount");
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
        <?php
        if (!isset($_SESSION['admin'])) {?>
          <a class="nav-link" href="index.php?page=myAccount" style="color: black;" role="tab" aria-controls="v-pills-home" aria-selected="true">Profile</a>
          <hr style="margin-top: 0px; margin-bottom:2%;"><?php
        }else;
        // if the logged in user is an admin, don't display the events option on the subnav (as they are't in any events)
        if (!isset($_SESSION['admin'])){?>
          <a class="nav-link" style="color: black;" role="tab" aria-controls="v-pills-profile" aria-selected="false" href="index.php?page=myAccountEvents">Challenges</a>
          <hr style="margin-top: 0px; margin-bottom:2%;">
        <?php
        }else;
        ?>
      <a class="nav-link" style="color: black;" role="tab" aria-controls="v-pills-profile" aria-selected="false" href="index.php?page=myAccountEdit">Edit</a>
      <hr style="margin-top: 0px; margin-bottom:2%;">
      <a class="nav-link active bg-danger" style="color: white;" href="index.php?page=myAccountSettings" role="tab" aria-controls="v-pills-messages" aria-selected="false">Settings</a>
    </div>
  </div>
    <div class="col-6 offset-1 offset-md-1 bg-white mt-5" style="border: 1px solid black;">
      <div class="card-body">
        <!-- ability for logged in user to delete their own account -->
        <h4>Delete account.</h4>
        <p>Please note, once deleted you will be unable to revover any personal infomation.</p>
        <!-- button which users can click to delete account. Once clicked, triggers java funcation below -->
        <button onclick="deleteAccount()">Delete Account</button>
        <!-- open script -->
        <script>
        // when the funcation is started run the code below
        function deleteAccount() {
          // set a variable (confirmText) and display message e.g. confirmation message
          var confirmText = confirm("Are you sure you want to delete this account?\nYou will be unable to access any infomation after deletion.");
          // if the 'ok' button is pressed, and thus confirmTxt variable is 'true'
          if (confirmText == true) {
            // send user to 'deleteMyAccount page with their current userID'
            window.location=("index.php?page=deleteMyAccount&userID=<?php echo $activeUserID; ?>");
            // else, do nothing (as the user doesn't want to delete their account)
          } else;
        }
        // end of java script
        </script>
      </div>
    </div>
  </div>
</div>
