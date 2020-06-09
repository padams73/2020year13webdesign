<?php
// check to see if a session is already set
session_start();
// if the session isn't set (no userID), send to the login page
if(!isset($_SESSION['userID'])){
  header("Location: index.php?page=login&error=notsetMyAccount");
}
  // set the username, first and last name of the user (that has newly been created), and assin them to the below variables
  $username = $_POST['username'];
  $firstName = $_POST['firstName'];
  $lastName= $_POST['lastName'];
  // set a variable password equal to the password entered but hased (more secure)
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  // checking if username is already taken (so can't be created to it)
  $user_sql = "SELECT * FROM `user` WHERE `username` = '$username'";
  $user_qry = mysqli_query($dbconnect, $user_sql);
  // data put into an assosicated array
  $user_aa = mysqli_fetch_assoc($user_qry);
  // newusername set as a variable equal to the proposed newly added username
  $newusername = $user_aa['username'];
  // if newusername isn't set (e.g. the username entered is not already taken), then create their account
  if (!isset($newusername)) {
  // can be created
  // set the level e.g. is the user and admin or not?
  if (isset($_GET['level'])) {
    // set level to whatever it was set as
    $level=$_GET['level'];
  }elseif (!isset($_GET['level'])) {
    // if not set, must be normal user
    $level=0;
  };
  // check complte. Now create it
  // insert the new users info into the user tabel
  $insert_sql = "INSERT INTO user (username, firstName, lastName, password,level) VALUES ('$username', '$firstName', '$lastName','$password','$level')";
  $insert_qry = mysqli_query($dbconnect, $insert_sql);
  // if level =1 (e.g. the account is an admin), it must have been added by another admin
  // so return the admin whos logged in, to the admin accounts page
    if ($level==1){
      Header("Location: index.php?page=adminAccounts&message=adminAdded");
      // otherwise, if not an admin, return to the loggin page
    }else{
      Header("Location: index.php?page=login&error=new");
    }
  }else {
// username taken
  if (isset($_GET['level'])) {
    // if the level is 1 (and thus added by an admin) send back with error to the addadmin page
    if ($_GET['level']=1) {
      header("Location:index.php?page=addAdmin&lastName=$lastName&firstName=$firstName&error=taken");
    }else {
      // otherwise send back to the registration page
      header("Location:index.php?page=register&lastName=$lastName&firstName=$firstName&error=taken");
    }
  }else
  header("Location:index.php?page=register&lastName=$lastName&firstName=$firstName&error=taken");
  };
?>
