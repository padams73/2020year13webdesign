
<form action="signupsubmit.php" method="post" class="col p-5">
  <h3>Join Bounding Salmon</h3>
  <div class="form-group">
    <label>Username</label>
    <input type="text" class="form-control" name="username" placeholder="Username">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Password</label>
      <input type="password" class="form-control" name="password" placeholder="Password">
    </div>
    <div class="form-group col-md-6">
      <label>Confirm Password</label>
      <input type="password" class="form-control" name="confirm-password" placeholder="Confirm Password">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-11">
      <label>Select Profile Image</label>
      <input type="file" name="profile-picture" class="form-control">
    </div>
    <div class="form-group col-1">
      <button type="submit" name="signup-submit" class="btn-lg btn-block btn-primary mt-4">Sign Up</button>
    </div>
  </div>
  <div class="form-row justify-content-center">
    <?php
    //Here we are checking to see if any errors have been included in header as as a result of the user being sent back to this page
    if (isset($_GET['error'])) {
      // code...
      //Here are the multiple error handling messages taht are displayed as a result
      if ($_GET['error'] == "emptyfields") {
        // code...
        echo "<h2>Fill in all fields!</h2>";
      }
      elseif ($_GET['error'] == "invalidusername") {
        // code...
        echo "<h2>Enter a valid username!</h2>";
      }
      elseif ($_GET['error'] == "passwordcheck") {
        // code...
        echo "<h2>Passwords must match!</h2>";
      }
      elseif ($_GET['error'] == "sqlerror") {
        // code...
        echo "<h2>Stop trying to hack me!</h2>";
      }
      elseif ($_GET['error'] == "usertaken") {
        // code...
        echo "<h2>Username is taken!</h2>";
      }
      elseif ($_GET['signup'] == "success"){
          //code...
          echo "<h2>Welcome to bounding Salmon!</h2>";
        }

    }
     ?>
  </div>

</form>
