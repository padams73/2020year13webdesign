<?php
include("databaseconnect.php");//This includes the database connect page to the account create page.
$emailaddress=$_POST['emailaddress'];//This posts the email address the user typed in, using a post array.
$username= $_POST['username'];//This posts the username the user typed in, using a post array.
$password=$_POST['password'];//This posts the password the user typed in, using a post array.
$hashpassword = password_hash("$password", PASSWORD_DEFAULT);//This puts the password the user typed in, through the hash function.
$confirmpassword=$_POST['confirmpassword'];//This posts the confirmed password the user typed in, using a post array.
if ($password==$confirmpassword) {
  $insert_sql="INSERT INTO user (emailaddress, username, password, confirmpassword) VALUES ('$emailaddress', '$username', '$hashpassword', '$confirmpassword')";
  $insert_qry=mysqli_query($databaseconnect, $insert_sql);?><!--If the password and confirmed passwords are equal to each other, the insert query will run and insert the new account details aoutomatically into the user table in the database with a unique userid.-->
  <h1>Account created. Now click on the Log In button to go to your personal home page.</h1><!--This header shows on the account create page if the insertion is successful.-->

<?php } else {
  header("Location:index.php?page=signup&error=match");
} ?><!--If the password does not match the confirmed password the user typed in, they are directed back to the sign-up page with an error stating the passwords do not match.-->
