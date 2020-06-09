<?php
// check to make sure session is set to admin
session_start();
// if session isn't set (not an admin account), send back to home page
if(!isset($_SESSION['admin'])){
  header("Location: index.php?page=home");
}elseif (!isset($_SESSION['userID'])){
  header("Location: index.php?page=login&error=notsetMyAccount");
}
?>
<div class="top" style="margin-top: 20px;">
  <!-- link back to home page -->
  <a style="color: black; text-decoration: underline; margin-left: 5%;"href="index.php?page=adminAccounts">Back</a>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-5 col-md-5 col-sm-12 order-last mt-4">
      <h5>Create new admin account.</h5>
      <a href="index.php?page=adminAccounts" style="color: black; font-size: 15px; text-decoration: underline;">Discard</a>
        <div class="registerform col-12" style="margin-top: 5%;">
          <form action="index.php?page=enterUser&level=1" method="post">
            <div class="form-group"style="margin-top: 20px;">
              <label>Username</label>
              <input type="text" name="username" placeholder="Username" required class="form-control" aria-describedby="username">
            </div>
            <div class="form-group"style="margin-top: 20px;">
              <label>First Name</label>
              <input type="text" name="firstName" placeholder="First name" required class="form-control" aria-describedby="firstName">
            </div>
            <div class="form-group"style="margin-top: 20px;">
              <label>Last Name</label>
              <input type="text" name="lastName" placeholder="Last name" required class="form-control" aria-describedby="lastName">
            </div>
          <div class="form-group">
            <label >Password</label>
            <input type="password" name="password" placeholder="Password" required class="form-control" id="exampleInputPassword1">
          </div>
            <?php
            // if an error message is set, assign the varible 'error' to the message, and run code
            if (isset($_GET['error'])) {
              $error = $_GET['error'];
              if ($error=='taken') { ?>
                <div class="taken">
                  <!-- if taken, display error message telling user what the problem is -->
                  <p style="color: red;" style="margin-left: 50px;">*username taken. Please select a different username for your Admin account.</p>
                </div> <?php
              }else;
            }else;
             ?>
            <button style="margin-bottom: 30px;" type="submit" class="btn">Create account</button>
          </form>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mt-4 offset-lg-1 offset-md-1 offset-sm-0">
      <h3>Manage Admin accounts</h3>
      <p>Current accounts</p>
    <div class="row toprow pb-3">
      <div class="col-4 toprowtext">Account name</div>
      <div class="col-4 toprowtext">
      </div>
      <div class="col-4 toprowtext">Delete</div>
    </div>
    <?php
    // select everything from the coloum 'user' and order the info in descending order depending on it's userID (thus most recent to least), only select users with the level =1 (e.g. only admins)
    $admins_sql="SELECT * FROM `user` where level=1 ORDER BY `userID` desc";
    // run sql query
    $admins_qry=mysqli_query($dbconnect, $admins_sql);
    // select the userName of the users as results are put into an array
    while ($admins_aa = mysqli_fetch_assoc($admins_qry)){
      // set variables for the username and userID for each account
      $username= $admins_aa['username'];
      $userID = $admins_aa['userID'];
      ?>
      <div class="row">
        <div class="col-4">
          <h6><?php echo $username; ?></h6>
        </div>
        <div class="col-4">
        </div>
        <div class="col-4">
          <p><a href="index.php?page=deleteMyAccount&userID=<?php echo $userID;?>&type=admin" style="color: black;">Delete account.</a></p>
        </div>
      </div>
    <?php }
      if (isset($_GET['message'])) {?>
        <p style="color:red;">*Admin account successfully deleted</p><?php
      }
    ?>
      <hr id=userdash></hr>
    </div>
  </div>
</div>
