<?php
//Here we have to include the post.inc.php as some of the functions defined on that page are called here.
include('post.inc.php');
//Here we are checking if the user ID has been set in the session which means that the user has logged in
if (isset($_SESSION['userID'])) {
  // code...
  //Here we are creating a variable called groups_sql and setting it equal to the string we wish to query the database with
  //This query selects the all the groupnames and the group ids from the groups table
  $groups_sql="SELECT groupName, groupID FROM groups";
  //Here we are querying the database which is connected in the $dbconnect variable along with the query which is stored in the groups_sql variable
  $groups_qry=mysqli_query($dbconnect, $groups_sql);
  //Here we are storing the results of the groups_qry in a associative array called groups_aa
  $groups_aa=mysqli_fetch_assoc($groups_qry);
  ?>
<div class="col pb-5">
<?php
// Here we are calling the setPost function as the action for our forum, the set post function is what adds posts to the posts table in the database 
  echo "<form method='post' action='".setPost($dbconnect)."'>"; ?>
    <div class="form-group">
      <label>Name of post</label>
      <!--Here we are taking the input text which will be saved as the title in the post array, it has the required attribute as if it is not entered into the database then it will throw an error-->
      <input type="text" class="form-control" name="title" placeholder="Fishing tips 123..." required>
      <!-- Here we setting a hidden input called userID and setting it equal to the userID set in the session when the user logged in-->
      <?php echo "<input type='hidden' name='date' value='".date('Y-m-d')."'>"; ?>
    </div>
    <div class="form-group">
      <label>Select a group</label>
      <!--Here we are setting up a multiple choice input called select multiple, the selection is saved as the groupID and is required otherwise the database wil throw a error if it is not entered into the database-->
      <select multiple class="form-control" name="groupID" required>
        <?php
        //Here we are saving the number of rows returned by the groups_qry and saving the number as the variable queryresult
        $queryResult = mysqli_num_rows($groups_qry);
        //If the number of rows returned by the groups_qry is greater than one which means there are results from the query, then exceute the following code
        if ($queryResult>0) {
          // code...
          //This is the beginning the do while loop
          do {
            // code...
            //This code repeats for every row returned in by the groups_qry
            //Here we are setting the variable groupname as the entry groupname from the groups_aa associative array
            $groupname = $groups_aa['groupName'];
            //Here we are setting the variable groupID as the entry groupID from the groups_aa associative array
            $groupID = $groups_aa['groupID'];
            //Here we echoing a option which is called whatever the variable groupname is set too. It has the value of the variable groupID saved under the name groupID
            echo "<option value='$groupID' name='groupID'>$groupname</option>";
            //This do while loop will continue to carry out while the groups_aa associative array is equal to the results of the groups query
          } while ($groups_aa = mysqli_fetch_assoc($groups_qry));
        }  ?>
      </select>
    </div>
    <div class="form-group pb-2">
      <label>Text area</label>
      <!--Here we are taking the input text which will be saved as the postContents in the post array, it has the required attribute as if it is not entered into the database then it will throw an error-->
      <textarea class="form-control" rows="3" name="postContents" required></textarea>
    </div>
    <!-- This is the form submit button it is stored as the addpost-submit in the get array-->
    <button type="submit" name="addpost-submit" class="btn-lg btn-primary">Submit</button>
    </form>
    <?php
    //Here we are checking if admin is equal to 1 in the session which means that the user logged in is an admin
    if($_SESSION['admin'] == 1){
      //If the user logged in is an admin then we run the following code
      ?>
      <!--Here we are displaying a button which is a link the to add group page-->
      <a href="index.php?page=addgroup" class="nostyle"><button class="btn-lg btn-success mt-2">Create Group</button></a>
      <?php
    }


     ?>

  <div class="row justify-content-center">
  <?php
  //Here we are checking if a error is set in the get array
  if (isset($_GET['error'])) {
    // code...
    if ($_GET['error']== "contentLong") {
      //If the error is set to 'contentlong' then we echo out the following message, this error occurs when the user has entered content that is longer than 100 characters

      // code...
      echo "<h3>MUST ENTER LESS THAN 100 CHARACTERS</h3>";
    }elseif ($_GET['error']== "emptyfields") {
      // code...
      //If the error is set to 'emptyfields' then we echo out the following message, this error occurs if the user has submited some fields empty however this error does not really occur as the form has required tags
      echo "<h3>PLEASE FILL OUT ALL FIELDS</h3>";
    }
  }
  //Here we are checking that instead of a a error message there may be a status message
  elseif(isset($_GET['status'])){
    if ($_GET['status'] == "success") {
      //This status message can be equal to success and if it is then we echo out the following message
      // code...
      echo "<h3>SUCCESS</h3>";
    }
  }
   ?>
   </div>
</div>
<?php
}else {
  // code...
  // Else if the user is not logged in then we display a message that informs them they must first login and displays a button that directs them to the login page
  ?>
  <div class="col m-5 p-5">
    <div class="row pb-5 justify-content-center">
      <h2>To create a post you must first log in</h2>
    </div>
    <div class="row pb-5 mb-5">
      <div class="col">
      </div>
      <div class="col">
        <a href="index.php?page=login" class="btn-primary btn-block btn">Login</a>
      </div>
      <div class="col">
      </div>
    </div>
    <div class="row pb-5 mb-2">

    </div>
  </div>
  <?php
}




 ?>
