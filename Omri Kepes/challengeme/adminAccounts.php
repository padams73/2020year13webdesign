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
  <a style="color: black; text-decoration: underline; margin-left: 5%;"href="index.php?page=home">Back</a>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12  order-lg-last order-md-last order-sm-first offset-lg-1">
      <h3 class="mb-lg-4 mb-md-4 mb-sm-0 mt-lg-6 mt-md-6">Admin Quick Links.</h3>
      <!-- admin page links -->
      <p>Home page: <a href="index.php?page=home">here</a></p>
      <p>View all pending events: <a href="index.php?page=pendingEvents">here</a></p>
      <p>View submitted results: <a href="index.php?page=submittedResults">here</a></p>
      <p>Manage current user accounts: <a href="index.php?page=userListAdmin">here</a></p>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mt-4 offset-lg-1 offset-md-1 offset-sm-0">
      <h3>Manage Admin accounts</h3>
      <p>Current accounts</p>
    <div class="row toprow pb-3">
      <div class="col-4 toprowtext">
        Account name
      </div>
      <div class="col-4 toprowtext">
      </div>
      <div class="col-4 toprowtext">
        Delete
      </div>
    </div>
    <?php
    // select everything from the coloum 'user' and order the info in descending order depending on it's userID (thus most recent to least), only select users with the level =1 (e.g. only admins)
    $admins_sql="SELECT * FROM `user` where (level=1) ORDER BY `userID` desc";
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
          <?php
          // making sure an admin can't delete their own account while logged in (e.g. only can delete other admins accounts)
          if ($userID!=$_SESSION['userID']) {?>
            <p><a href="index.php?page=deleteMyAccount&userID=<?php echo $userID;?>&type=admin" style="color: black;">Delete account.</a></p><?php
          }else{
            ?><p><a href="index.php?page=myAccountSettings" style="color: black;">Delete account.</a></p><?php
          };
          ?>
        </div>
      </div>
    <?php }
      if (isset($_GET['message'])) {
        $message=$_GET['message'];
        if ($message=="adminAdded") {
          ?><p style="color:red;">*New admin account successfully created</p><?php
        }elseif ($message=="deleted"){
        ?><p style="color:red;">*Admin account successfully deleted</p><?php
      }else;
    }else;
    ?>
      <hr id=userdash></hr>
      <a href="index.php?page=addAdmin" style="color: black;">Add an admin account here.</a>
    </div>
  </div>
</div>
