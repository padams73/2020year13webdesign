<?php
//Here we are checking if the group ID has been set in the get array which means that the user has access this page legitmately
if (isset($_GET['groupID'])) {
  // code...
  //Here we are setting the groupID as equal to what is sent in the group array under group id. We need this for later.
  $groupID = $_GET['groupID'];
  //Here we are creating a variable called groups_sql and setting it equal to the string we wish to query the database with.
  //This query selects all the groupsnames from the group table where the groupID is set to the variable under groupID
  $groups_sql="SELECT groupName FROM groups WHERE groupID=$groupID";
  //Here we are querying the database which is connected in the $dbconnect variable along with the query which is stored in the groups_sql variable
  $groups_qry=mysqli_query($dbconnect, $groups_sql);
  //Here we are storing the results of the groups_qry in a associative array called groups_aa
  $groups_aa=mysqli_fetch_assoc($groups_qry);
  //Here we are setting the variable groupname as the entry groupname from the groups_aa associative array
  $groupName = $groups_aa['groupName'];
  ?>
  <div class="col mb-5 pb-5">
  <div class="row justify-content-center pb-2">
    <!--Here we are echoing the group name which was stored in the groupName variable-->
    <h2><?php echo $groupName ?></h2>

  </div>
  <div class="row justify-content-center">
    <!--Here we are double checking that the user wants to delete the group as this action is irreversible-->
    <h4>Are you sure you want to delete this group?</h4>
  </div>
  <div class="row mb-5 pb-5">
    <div class="col p-5 m-4">
      <!-- Here we setting the deletegroupsumbit page as the action for our forum, this page is what actually runs the sql code that deletes the group from the database -->
      <form action="deletegroupsubmit.php" method="post">
        <!-- Here we setting a hidden input called groupID and setting it equal to the groupID set in the group array when the user was sent to this page-->
        <input type="hidden" name="groupID" value="<?php echo $groupID ?>">
        <!-- This is the form submit button it is stored as the deletegroupsubmit in the get array, the user presses this button if the user wants to delete the group-->
        <button type="submit" name="deletegroupsubmit" class="btn btn-block btn-danger">Yes</button>
      </form>
    </div>
    <div class="col p-5 m-4">
      <form action="index.php" method="post">
        <!-- This is the  form submit button for a different form, the user presses this button if the user doesnt want to delete the group and is returned back to the index.php page-->
        <button type="submit" name="button" class="btn btn-block btn-primary">No</button>
      </form>
    </div>
  </div>
  </div>
</div>
  <?php
}else {
  // code...
  // else if the user is redirected to the index page if the groupID is not set in the get array which means that the user has found this page some other way
  header("Location: index.php");
}

 ?>
