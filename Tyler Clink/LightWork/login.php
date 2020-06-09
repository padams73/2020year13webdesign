<!--This page is the login page for the website, it is run through the Verify page-->

<!--Starts the session so if an already logged in user returns to the page it skips to login process, to prevent users having to login constantly-->
<?php
session_start();
if(isset($_SESSION['admin'])) {
  header("Location: index.php?page=admin");
}

 ?>
<div class ="row">

  <div class="col-md-2">
    <a href="index.php"><img class="back-img" src="images/lite.wrk_back.jpg" alt="Back"></a>
  </div>

  <div class="col-md-6">
    <?php
      echo "<p class='title'>Admin Login</p>";
    ?>

    <!--Form for username and password-->
    <form action="index.php?page=verify" method="post">
      <div class='admin-form'"form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control" placeholder="Username">
      </div>
      <div class='admin-form'"form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password">
      </div>
      <div class='admin_button'>
        <button type="submit" class="btn btn=primary">Submit</button>
      </div>
    </form>
    <?php
    // check if $_GET['error'] is set
    if(isset($_GET['error'])) {
    ?> <div class="alert alert-danger" role="alert">
        Incorrect Username or Password! Please try again or press back to exit.
      </div>
    <?php } ?>

  </div>
</div>
