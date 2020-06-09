<!-- ACCEPTS OR DECLINES A PENDING EVENT BY CHANGING THE EVENT STATUS -->
<?php
// check to see of session is set
session_start();
// if session isn't set, send user to the login page with the error massage
if (!isset($_SESSION['userID'])) {
  Header("Location: index.php?page=login&error=notsetMyAccount");
}
// assigns variable 'done' to the reponse selected
$done = $_POST['exampleRadios'];
// assigns vairble 'reponse' to the sent response message
$response = $_GET['response'];
// if option was 'accept' then update the challenge status, making it an upandcoming event
if ($done=='accept') {
  $challengeID = $_GET ['challengeID'];
  $insert_sql = "UPDATE challenges SET status = 1 where challengeID=$challengeID";
  $insert_qry = mysqli_query($dbconnect, $insert_sql);
  // check to make sure query worked
    if (!$insert_qry) {
      echo '404 error. An error occured accepting this challenge. Please try again.';
      ?> <p>Click<a style="color: black; text-decoration: underline;" href="index.php?page=pendingEvents"> here</a> for all pending events.</p><?php
    }
    else
    header("Location: index.php?page=pendingEvents&error=accepted");
    // else if the event was declined
} elseif ($done=='decline') {
  // delete the challenge data as a whole
  $challengeID = $_GET ['challengeID'];
  $insert_sql = "DELETE FROM `challenges` WHERE challengeID=$challengeID";
  $insert_qry = mysqli_query($dbconnect, $insert_sql);
  // check to make sure query worked
    if (!$insert_qry) {
      echo '404 error. An error occured while deleting this challenge. Please try again.';
      ?> <p>Click<a style="color: black; text-decoration: underline;" href="index.php?page=pendingEvents"> here</a> for all pending events.</p><?php    }
    else
    header("Location: index.php?page=pendingEvents&error=declined");
} else {
  echo '404 error. An error occured. Please try again.';
  ?> <p>Click<a style="color: black; text-decoration: underline;" href="index.php?page=pendingEvents"> here</a> for all pending events.</p><?php
}
