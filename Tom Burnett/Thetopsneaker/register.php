<div class="register_background"> <!-- register_background starts -->
<?php
  if(isset($_GET['error'])) {
    if($_GET['error']=="exists") {
      // display error as exists
      ?>
      <div class="alert alert-danger" role="alert">
        The username you have chosen is already taken, please select a new username
        <!-- Displaying a error to the user because they are trying to use a username that has already been used -->
      </div>
      <?php
    } else if ($_GET['error']=="blank") {
      // display error blank
      ?>
      <div class="alert alert-danger" role="alert">
        The username section was left blank, please enter a valid username
        <!-- Displaying an error to the user because they have left the username field has blank -->
      </div>
      <?php

    }
  }

 ?>
      <form class="register" action="index.php?page=adduser" method="post">
        <h2 class="login_details">Register below</h2>
        <!-- Header to tell the user to register -->
        <h4 class="login_details">Please enter your credentials to create an account</h4>
        <!-- Telling the user to enter their credentials to create an account -->


          <div class="username">
              <input type="text" name="user" placeholder="Username">
              <!-- form for users to enter their usernames to create an account -->
          </div>
          <div class="password">
          <input type="text" name="password" placeholder="Password">
          <!-- Form for users to enter their passwords to create an account -->
          </div>


          <div class="g-recaptcha" data-sitekey="6LfKURIUAAAAAO50vlwWZkyK_G2ywqE52NU7YO0S"></div>

          <script src='https://www.google.com/recaptcha/api.js'></script>
          <!-- Recaptcha to make sure the user is not a robot -->


          <div class="login_button">
            <input type="Submit" name="Submit" value="Confirm">
            <!-- submit button to continue and to create the account -->
          </div>


      </form>




</div> <!-- register_background ends -->
