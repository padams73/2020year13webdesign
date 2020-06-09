<?php
// check is a session is set
session_start();
// if the session isn't set to user, with a userID, OR the 'type' isn't set OR the userID isn't set
// send to myaccounteidt page with the error message
if (!isset($_SESSION['userID'])) {
  header("Location: index.php?page=login&error=notsetMyAccount");
}elseif ((!isset($_GET['type'])) or (!isset($_GET['userID']))){
  Header("Location: index.php?page=myAccountEdit&error=noID");
}
// get the userID and assign to variable userID
$userID = $_GET['userID'];
// get the type of edit, and assign to varible 'type'
// type is the 'type' of edit being made
$type = $_GET['type'];
// if the type is set to status (user wants to edit their status)
if ($type=='status') {
  // get the string of text (status) which the logged in user wants updated
  // set to variable 'status'
  $status = $_POST['status'];
  // display the new status
  echo $status;
  // run a sql insert queery and set the status eqaul to the variable status
  $insert_sql = "UPDATE user SET status = '$status' where userID=$userID";
  $insert_qry = mysqli_query($dbconnect, $insert_sql);
  // check to see if query worked
  if (!$insert_qry) {
    echo 'Sorry and error occured updating status';
  }
  else {
  header("Location: index.php?page=myAccountEdit&error=doneBio");
}
// edit of status complete
// if the type of edit is set to the username
} elseif ($type=='username'){
// set the new username written as a variable,'username'
$username = $_POST['username'];
// checking if username is already taken (so can't be change to it)
$user_sql = "SELECT * FROM `user` WHERE `username` = '$username'";
$user_qry = mysqli_query($dbconnect, $user_sql);
$user_aa = mysqli_fetch_assoc($user_qry);
$newname = $user_aa['username'];
if (!isset($newname)) {
// can be updated
// check complte. Now edit it if I can be changed
echo $username;
$insert_sql = "UPDATE user SET username = '$username' where userID=$userID";
$insert_qry = mysqli_query($dbconnect, $insert_sql);
// check to see if query worked
if (!$insert_qry) {
  echo 'Sorry and error occured updating username';
}
else {
  // else send back with error message
header("Location: index.php?page=myAccountEdit&error=doneUsername");
};
}else {
// can't be updated (username taken)
header("Location: index.php?page=myAccountEdit&error=taken");
}
} elseif ($type=='password'){
  $password = $_POST['password'];
  $newPassword = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
  $activeUserID = $_GET['userID'];
  // checking if password matches the user whos logged in
  $user_sql = "SELECT * FROM `user` WHERE `userID` = '$activeUserID'";
  $user_qry = mysqli_query($dbconnect, $user_sql);
  $user_aa = mysqli_fetch_assoc($user_qry);
  $hash = $user_aa['password'];
  // checking if the password was correct
if (password_verify($password,$hash)) {
// if the password is correct, update the current password to the new apssword
$insert_sql = "UPDATE user SET password = '$newPassword' where userID=$activeUserID";
$insert_qry = mysqli_query($dbconnect, $insert_sql);
  if (!$insert_qry) {
    // if the insert qry failed
    echo 'Sorry and error occured updating password';
  }
  // if it worked and new password is updated
  else {
  header("Location: index.php?page=myAccountEdit&error=donePassword");
  }
}else {
  // if the password was wrong
  header("Location: index.php?page=myAccountEdit&error=wrong");
  }


}
?>
