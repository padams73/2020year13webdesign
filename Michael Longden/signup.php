<form action="index.php?page=accountcreate" method="post"><!--If the user signs up successfully, they are directed to the account create page, using a post array.-->
<?php
if(isset($_GET['error'])) { ?> <!--This is in case a user makes a typo when writing their password twice.-->
  <div class="alert alert-danger" role="alert"><!--The error div begins here.-->
    Your password and confirm password does not match.<!--This message displays when the password and confirm password characters do not match.-->
  </div><!--The error div ends here.-->
<?php }

 ?>
    <div class="form-group"><!--The form-group div for the email address begins here.-->
      <label for="formGroupExampleInput">Email Address</label><!--This titles the email address div tag in the website.-->
      <input type="email" name="emailaddress" class="form-control"  placeholder="Email Address"><!--This displays the email address bar for the user to type in their email address.-->
    </div><!--The form group div ends here.-->
    <div class="form-group"><!--The form-group div for the username begins here.-->
      <label for="formGroupExampleInput2">Username</label><!--This titles the username div tag in the website.-->
      <input type="username" name="username" class="form-control"  placeholder="Username"><!--This displays the username bar for the user to type in their username.-->
    </div><!--The form group div ends here.-->
    <div class="form-group"><!--The form-group div for the password begins here.-->
      <label for="formGroupExampleInput2">Password</label><!--This titles the password div tag in the website.-->
      <input type="password" name="password" class="form-control"  placeholder="Password"><!--This displays the password bar for the user to type in their password.-->
    </div><!--The form group div ends here.-->
    <div class="form-group"><!--The form-group div for the confirm password begins here.-->
      <label for="formGroupExampleInput2">Confirm Password</label><!--This titles the confirm password div tag in the website.-->
      <input type="password" name="confirmpassword" class="form-control"  placeholder="Confirm Password"><!--This displays the confirm password bar for the user to type in their password again.-->
    </div><!--The form group div ends here.-->
  <button type="submit" name="button">Create</button><!--This creates the submit button for users to click on when they have entered in their details.-->
</form><!--The form ends here.-->
