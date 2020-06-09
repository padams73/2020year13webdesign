<?php
// check to see of session is set
session_start();
// if session isn't set then redirect to the login page with error message
if (!isset($_SESSION['userID'])) {
  Header("Location: index.php?page=login&error=notsetMyAccount");
  // if the type of edit isn't set already, send user back to my account edit page
}elseif (!isset($_GET['type'])){
  Header("Location: index.php?page=myAccountEdit");
}
// set variable for the type of edit the user has selected
$type = $_GET['type'];
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
  <div class="col-md-3 col-lg-3 col-4 offset-lg-1 offset-md-1 offset-0 bg-white mt-5" style="border: 1px solid black;height: 210px;">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="margin-top: 5%; margin-bottom: 5%;">
      <a class="nav-link" href="index.php?page=myAccount" style="color: black;" role="tab" aria-controls="v-pills-home" aria-selected="true">Profile</a>
      <hr style="margin-top: 0px; margin-bottom:2%;">
      <?php
      // if the logged in user is an admin, don't display the events option on the subnav (as they are't in any events)
      if (!isset($_SESSION['admin'])){?>
        <a class="nav-link" style="color: black;" role="tab" aria-controls="v-pills-profile" aria-selected="false" href="index.php?page=myAccountEvents">Challenges</a>
        <hr style="margin-top: 0px; margin-bottom:2%;">
      <?php
      }else;
      ?>
      <a class="nav-link active bg-danger" style="color: white;" role="tab" aria-controls="v-pills-profile" aria-selected="false" href="index.php?page=myAccountEdit">Edit</a>
      <hr style="margin-top: 0px; margin-bottom:2%;">
      <a class="nav-link" style="color: black;" href="index.php?page=myAccountSettings" role="tab" aria-controls="v-pills-messages" aria-selected="false">Settings</a>
    </div>
  </div>
    <div class="col-6 offset-1 offset-md-1 bg-white mt-5" style="border: 1px solid black;">
      <div class="col-11 mt-4">
        <?php
        if ($type=="status") {?>
          <form action="index.php?page=enterEdit&type=status&userID=<?php echo $activeUserID; ?>" method="post">
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Update status</label>
              <textarea name="status" class="form-control" id="exampleFormControlTextarea1" maxlength="400" placeholder="<?php echo $activeUserStatus; ?>" rows="2"></textarea>
            </div>
            <button type="submit" class="btn submit" name="button">Enter</button>
            <a class="btn" href="index.php?page=myAccountEdit" style="color: black;"name="button">Discard</a>
          </form>
          <hr>
          <?php
        }else{?>
        <!-- display logged in users info -->
        <h4 style="color: black;">Status: <?php echo $activeUserStatus ?></h4>
        <!-- allow option to edit the status of the logged in user -->
        <a style="text-decoration: none; color: black;"href="index.php?page=editAccount&type=status">Edit your status</a>
        <div class="error">
          <?php
          // if an error message is sent
            if (isset($_GET['error'])) {
              // assign error variable to the message
              $error = $_GET['error'];
              // if error variable is set to doneBio
              if ($error =='doneBio') {?>
                <p style="color: green;">*Status has been updated</p><?php
              }
            }else;
           ?>
        </div><?php
        };
        ?>
      </div>
      <div class="row mb-5 mt-4">
        <div class="col-6">
          <?php
          if ($type=="username") {?>
            <hr>
            <form action="index.php?page=enterEdit&type=username&userID=<?php echo $activeUserID; ?>" method="post">
              <div class="form-group">
                <label for="formGroupExampleInput2">Username</label>
                <input type="text" class="form-control" name="username" id="formGroupExampleInput2" placeholder="<?php echo $activeUsername; ?>">
              </div>
              <button type="submit" class="btn submit" name="button">Enter</button>
              <a class="btn" href="index.php?page=myAccountEdit" style="color: black;"name="button">Discard</a>
            </form><?php
          }else{?>
            <!-- display logged in users info -->
            <a class="btn" style="text-decoration: none; color: black;"href="index.php?page=editAccount&type=username">Change your username</a>
            <div class="error">
              <?php
              // checking to see if error message is set and displaying messages if it is
                if (isset($_GET['error'])) {
                  $error = $_GET['error'];
                  if ($error =='doneUsername') {?>
                    <p style="color: green;">*Username has been updated</p><?php
                  }elseif ($error=='taken'){?>
                    <p style="color: red;">*username is already taken</p><?php
                  }else;
                }else;
               ?>
            </div><?php
          };
          ?>
        </div>
        <div class="col-lg-5 col-12">
          <?php
          if ($type=="password") {?>
            <hr>
            <form action="index.php?page=enterEdit&type=password&userID=<?php echo $activeUserID; ?>" method="post">
              <div class="form-group row">
                <div class="col-sm-10">
                  <label for="inputPassword" name="password">Current Password</label>
                  <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-10">
                  <label for="inputPassword" name="newPassword">New Password</label>
                  <input type="password" name="newPassword" class="form-control" id="inputPassword" placeholder="New Password">
                </div>
              </div>
              <button type="submit" class="btn submit" name="button">Enter</button>
              <a class="btn" href="index.php?page=myAccountEdit" style="color: black;"name="button">Discard</a>
            </form><?php
          }else{?>
            <!-- display logged in users info -->
            <a class="btn" style="text-decoration: none; color: black;"href="index.php?page=editAccount&type=username">Change your username</a>
            <div class="error">
              <?php
              // checking to see if error message is set and displaying messages if it is
                if (isset($_GET['error'])) {
                  $error = $_GET['error'];
                  if ($error =='doneUsername') {?>
                    <p style="color: green;">*Username has been updated</p><?php
                  }elseif ($error=='taken'){?>
                    <p style="color: red;">*username is already taken</p><?php
                  }else;
                }else;
               ?>
            </div><?php
          };
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
