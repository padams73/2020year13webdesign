<div class="main">

<?php
//creating variables to store user entered data
$Username = $_POST['Username'];
$checkqry_sql = "SELECT * FROM users WHERE Username='$Username'";
$checkqry_qry = mysqli_query($dbconnect, $checkqry_sql);
//this checks to see if the username is already in the database
if (mysqli_num_rows($checkqry_qry) >0) {
    header("Location:index.php?page=account&error=blank");

}
else {
$Password = $_POST['Password'];
$hashpass = password_hash("$Password", PASSWORD_DEFAULT);
//error catching for if any fields are left blank
if ($Username=="" or $Password=="") {
  header("Location:index.php?page=account&error=blank");
}
else {
  //adds the acount to the database
  $insert_sql = "INSERT INTO users (Username, Password) VALUES ('$Username', '$hashpass')";
  echo $insert_sql;
  $insert_qry = mysqli_query($dbconnect, $insert_sql);
  //redirects user to login
  header("Location:index.php?page=login");
}
}
 ?>
</div>
