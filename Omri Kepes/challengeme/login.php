<!-- surcurity -->
<!-- check to see if session is set -->
<?php
session_start();
// if so, unset and destory the session
session_unset();
session_destroy();
?>
<!-- basic html for the login design and form -->
<div class="container-fluid">
  <div class="row">
    <div class="logologin col-12">
      <img src="loginlogo.png" alt="" style="border-radius: 50%">
      <h3>Please login...</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-12 text-center">
      <p>Or register <a href="index.php?page=register" style="text-decoration: underline; color: black;">here</a></p>
    </div>
  </div>
  <div class="row">
    <div class="col-12 text-center">
      <?php
      if (isset($_GET['error'])) {
        $message = $_GET['error'];
        if ($message=="notsetMyAccount") {
          ?><p style="color: red;">*You must login, or create an account before entering</p><?php
        }else;
      };
      ?>
    </div>
  </div>
  <div class="row text-center">
    <div class="loginform col-10 col-md-6 col-lg-4 offset-1 offset-md-2 offset-lg-4">
      <form action="index.php?page=verify" method="post">
        <div class="form-group"style="margin-top: 20px;">
          <label>Username</label>
          <input type="text" name="username" required class="form-control" aria-describedby="username">
        </div>
        <div class="form-group">
          <label >Password</label>
          <input type="password" name="password" required class="form-control" id="exampleInputPassword1">
        </div>
        <?php
        // if an error message is sent, and thus 'error' is set
        if (isset($_GET['error'])) {
          // assign the variable 'error' to the error message sent
          $error = $_GET['error'];
          // if the error is set to 'incorrect'
          if ($error=='incorrect') { ?>
            <!-- display error message -->
            <div class="incorrect">
              <p style="color: red;" style="margin-left: 50px;">*incorrect username or password</p>
            </div> <?php
            // if the error is set to new
          }elseif ($error=='new'){?>
            <!-- display new user text -->
            <div class="new">
              <p style="color: green;" style="margin-left: 50px;">Thank you for registering. Please login</p>
            </div> <?php
          }else;
        }else;
         ?>
        <button style="margin-bottom: 30px;" type="submit" class="btn" >Login</button>
      </form>
    </div>
  </div>
</div>
