<?php
 // using post array to call user from database
  $user = $_POST['user'];

// run query to check if user aolready exists. if it does, redirect back to register page with error
$user_sql = "SELECT * FROM user WHERE user = '$user'";
$user_qry = mysqli_query($dbconnect, $user_sql);
if (mysqli_num_rows($user_qry)>0) {
  // checking to make sure the username is not already registered to an account
header("Location:index.php?page=register&error=exists");
// redirect to the register page that has an error with the error of exists. Meaning there is already an account the same username in use.
} else if ($user=="") {
  // if the user enters a blank username field then they will be sent to this header below.
header("Location:index.php?page=register&error=blank");
// redirect to the register page that has an error with the error of blank
} else {


  // using post array to call user from database
  $password = $_POST['password'];
  $hash = password_hash("$password",PASSWORD_DEFAULT);
  // sql to call the user and password from user table and storing it in the variables $user and $password
  $adduser_sql = "INSERT INTO user (user, password) VALUES ('$user', '$hash')";
  $adduser_query = mysqli_query($dbconnect, $adduser_sql);
// using a div tag to create a background
?> <div class="register_background">

        <h2 class="login_details">Account created!</h2>
        <!-- Using tags such as h2 and h4 to create the Heading "Account Created" to show the user that when they registered they registered correctly and the account was made -->
        <h4 class="login_details">Go to <a href="index.php?page=login">Login</a> page to login</h4>

</div>
<?php } ?>
