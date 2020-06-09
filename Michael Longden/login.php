<?php
if(isset($_SESSION['user'])) {//This is if the user logs in successfully.
  header('Location: personalindex.php');//The user is directed to their personal index page.
}
 ?>
  <form action="verify.php" method="post"><!--This form directs the user to the verify page when they have submitted their log-in details, using a post array.-->

<?php
  if(isset($_GET['error'])) {
 echo "The username or password is incorrect.";//If the username or password is invalid, the user is redirected to the index page and a message stating that the username or password is incorrect is echoed.
}?>
  <div class="form-group"><!--The form-group div for the username begins here.-->
    <label for="exampleInputUsername1">Username</label><!--This titles the username div tag in the website.-->
    <input type="username" name="username" required class="form-control" id="exampleInputUsername1" aria-describedby="usernameHelp" placeholder="Username"><!--This displays the username bar for the user to type in their username.-->
  </div><!--The form group div ends here.-->
  <div class="form-group"><!--The form-group div for the password begins here.-->
    <label for="exampleInputPassword1">Password</label><!--This titles the password div tag in the website.-->
    <input type="password" name="password" required class="form-control" id="exampleInputPassword1" placeholder="Password"><!--This displays the password bar for the user to type in their password.-->
  </div><!--The form group div ends here.-->
  <button type="submit" class="btn btn-primary">Submit</button><!--This creates the submit button for users to click on when they have entered in their details.-->
</form><!--The form ends here.-->
