<?php if(isset($_GET['error'])) { ?>
<div class="alert alert-danger" role="alert">
  Either your username or password is incorrect!
  <!-- Simple error that displays when users have entered an incorrect password of username -->
</div>
<?php } ?>

<h2 class="login_details">Enter your details to login</h2>
<!-- Displaying a header to tell the user to enter their details -->



<!-- Forms to create a username and login method -->
  <div class="Login1"> <!-- Login1 starts -->
  <form class="Login"  action="index.php?page=verify" method="post"> <!-- Form Starts -->
    <!-- link to send the user to the verify page to check the login details -->

    <div class="username">
        <input type="text" name="user" placeholder="Username" required>
        <!-- form for the user to enter their details of their username -->
  </div>
  <div class="password">
    <input type="password" name="password" placeholder="Password" required>
    <!-- form for the user to enter their details of their password -->
    </div>


    <div class="g-recaptcha" data-sitekey="6LfKURIUAAAAAO50vlwWZkyK_G2ywqE52NU7YO0S"></div>
<!-- Link to have the recaptcha -->
    <script src='https://www.google.com/recaptcha/api.js'></script>


    <div class="login_button">
      <input type="Submit" name="Submit" value=" Confirm ">
      <!-- Button for the users to click on that will confirm their login details -->
  </div>

</div>
