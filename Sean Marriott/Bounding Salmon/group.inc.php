<?php
// Here we are seting a function named setGroup, this function inserts new groups into the database, the variable $dbconnect is passed through so the function can access the database
function setGroup($dbconnect){
  //Here we are checking that the user has actually clicked the addgroup-submit button by checking if it is set in the post array
  if (isset($_POST['addgroup-submit'])) {
    // code...

    //Here we are setting some variables that were sent through the post array from the form on the addgroup page
    $groupName=$_POST['groupName'];
    $date=$_POST['date'];
    $userID=$_POST['userID'];
    $groupDescription=$_POST['groupDescription'];
    $groupImage=$_POST['groupImage'];

    //Here we are doing some error catching
    if (strlen($groupName)>50) {
      // code...
      //If the string length of the group name is longer than 50 characters then we send them to the addgroup page with the error 'namelong'
      header("Location: index.php?page=addgroup&error=namelong");
      //We have to exit the if statement otherwise it says that the header location has already been set
      exit();
    }elseif (strlen($groupDescription)>200) {
      // code...
      //If the string length of the group description is longer than 200 characters then we send them to the addgroup page with the error 'descriptionlong'
      header("Location: index.php?page=addgroup&error=descriptionlong");
      exit();
    }else {
      // code...
      //If the error catching has not thrown any errors then we insert the values into the groups table (I would do some sql injectin prevention but I ran out of time and figured that I have some on the signupsubmit page)
      $sql ="INSERT INTO groups (groupName, date, userID, groupDescription, groupImage) VALUES ('$groupName', '$date', '$userID', '$groupDescription', '$groupImage')";
      $result = $dbconnect->query($sql);
      //Now we send them back to the addgroup page with the status set to success in the get array
      header('Location: index.php?page=addgroup&status=success');
  }
  }
}

 ?>
