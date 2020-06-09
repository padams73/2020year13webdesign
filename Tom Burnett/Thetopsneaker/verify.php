<?php
  $user = $_POST['user'];
  // using post array to call from the database
  $password = $_POST['password'];
  // using the post array to call from the database
// sql to SELECT everything from the table user that is equal to the variable to $user and the password is equal to the variable to $password
  $check_sql = "SELECT * FROM user WHERE user='$user'";

  $check_qry = mysqli_query($dbconnect, $check_sql);

if (mysqli_num_rows($check_qry)==0) {
  header("Location:index.php?page=login&error=error");
} else {
  $check_aa=mysqli_fetch_assoc($check_qry);

  $hash = $check_aa['password'];
  // hashing the password

  if (password_verify($password, $hash)) {
    $_SESSION['loggedin']=$user;
    $_SESSION['userid']=$check_aa['userid'];
    header("Location:index.php"); // redirects the user to the location of index.php
  } else {
  header("Location:index.php?page=login&error=error");
  }
}
 ?>
