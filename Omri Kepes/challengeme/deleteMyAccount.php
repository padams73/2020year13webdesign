<?php
// check if a session has been set, and get the userID of the logged in user
// if not set, send back to myAccountSettings with error message
session_start();
if (!isset($_SESSION['userID'])) {
  Header("Location: index.php?page=login&error=notsetMyAccount");
};
// get the userID and set it to a variable UserID
$userID = $_GET['userID'];
// get the activeuserID (logged in userid)
$activeUserID = $_SESSION['userID'];
// if both ID values are the same, user can delete this account
// if session is set to admin, they are able to delete any account
if (($userID==$activeUserID) or isset($_SESSION['admin'])) {
  // sql for deleting the user whos userID= the userID selected
  $deleteUser_sql = "DELETE from user where userID=$userID";
  // run the query
  $deleteUser_qry = mysqli_query($dbconnect, $deleteUser_sql);
  // deleting all from bets table
  $deleteBets_sql = "DELETE from bets where userID=$userID or pickedID=$userID or winnerID=$userID";
  // run the query
  $deleteBets_qry = mysqli_query($dbconnect, $deleteBets_sql);
  // deleting all from Challenges
  $deleteEvent_sql = "DELETE from challenges where userOneID=$userID or userTwoID=$userID";
  // run the query
  $deleteEvent_qry = mysqli_query($dbconnect, $deleteEvent_sql);
  // if the logged in user is an admin, send back to manage accounts page
  if (isset($_SESSION['admin'])) {
    // get the type of user which has been deleted via an admins account
    $type = $_GET['type'];
    // if type is equal to user (e.g. another users account as been deleted), send admin back to list of accounts
    if ($type=="user") {
    // send admin back to user list page
    Header("Location: index.php?page=userListAdmin&message=deleted");
  }elseif($type=="admin"){
    // send admin back to manage admins page
    Header("Location: index.php?page=adminAccounts&message=deleted");
  }else echo "error who?";
    // else, if not an admin, logged in users personal account has been deleted, so send them back to the login/rego page
  }elseif (!isset($_SESSION['admin'])){
  // unset session and destroy it
  session_unset();
  session_destroy();
  // send user back to login/register page
  Header("Location: index.php?page=Login&error=deletedAccount");
  }

}else
// else display error message
echo 'Sorry, you do not have the ability to delete others accounts';
?> <p>Click <a style="color: black; text-decoration: underline;"href="index.php?page=myAccountSettings">here</a> to visit your account settings.</p> <?php
