<!-- html adn bootstrap code for the basic register form -->
<div class="container-fluid">
  <div class="row">
    <div class="logoregister col-12">
      <img src="loginlogo.png" alt=""style="border-radius: 50%">
      <h3>Welcome, please register an account...</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-12 text-center">
      <p>Or login <a href="index.php?page=login" style="text-decoration: underline; color: black;">here</a>
    </div>
  </div>
  <div class="row">
    <div class="col-12 text-center">
      <?php
      if (isset($_GET['error'])) {
        $message = $_GET['error'];
        if ($message=="notsetMyAccount") {
          ?><p style="color: red;">*You must create an account before entering</p><?php
        }else;
      };
      ?>
    </div>
  </div>
  <div class="row text-center">
    <div class="registerform  col-10 col-md-6 col-lg-4 offset-1 offset-md-2 offset-lg-4">
      <form action="index.php?page=enterUser" method="post">
        <div class="form-group"style="margin-top: 20px;">
          <label>Username</label>
          <input type="text" name="username" placeholder="Username" required class="form-control" aria-describedby="username">
        </div>
        <div class="form-group"style="margin-top: 20px;">
          <?php
          // if an error message is set, assign the varible 'error' to the message, and run code
            if (isset($_GET['error'])) {
              $error = $_GET['error'];
              if ($error=='taken') {
                // if username is taken, dispaly firstname in form feild for easy of registration
                $firstName = $_GET['firstName'];?>
                <label>First Name</label>
                <input type="text" name="firstName" placeholder="<?php echo $firstName; ?>" required class="form-control" aria-describedby="firstName" value="<?php echo $firstName; ?>"><?php
              }else;
            }else{
          ?>
          <label>First Name</label>
          <input type="text" name="firstName" placeholder="First name" required class="form-control" aria-describedby="firstName">
        </div><?php
        }?>

        <div class="form-group"style="margin-top: 20px;">
          <?php
          // if an error message is set, assign the varible 'error' to the message, and run code
            if (isset($_GET['error'])) {
              $error = $_GET['error'];
              if ($error=='taken') {
                // if taken username, display lastname already in form for easy of registration
                $lastName = $_GET['lastName'];?>
                <label>Last Name</label>
                <input type="text" name="lastName" placeholder="<?php echo $lastName; ?>" required class="form-control" aria-describedby="lastName" value="<?php echo $lastName; ?>"><?php
              }else;
            }else{
          ?>
          <label>Last Name</label>
          <input type="text" name="lastName" placeholder="Last name" required class="form-control" aria-describedby="lastName">
        </div><?php
      };
      ?>
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
              <p style="color: red;" style="margin-left: 50px;">*username taken. Please select a different username or Login</p>
            </div> <?php
          }elseif ($error=='new'){?>
            <div class="new">
              <!-- if new user, display thank you message for user -->
              <p style="color: green;" style="margin-left: 50px;">Thank you for registering. Please login</p>
            </div> <?php
          }else;
        }else;
         ?>
        <button style="margin-bottom: 30px;" type="submit" class="btn">Create account</button>
      </form>
    </div>
  </div>
</div>
