<?php
//Here we have to include the group.inc.php as some of the functions defined on that page are called here.
include('group.inc.php');
//Here we are checking if the user logged in is a admin as currently only admins can add groups
if ($_SESSION['admin']==1) {
  // code...
 ?>
 <div class="col p-3 mb-5 pb-5">
  <?php echo "<form method='post' action='".setGroup($dbconnect)."'>";
    //Here we are calling the setGroup function as the action for our forum, the set group function is what adds groups to the groups table in the database 
    ?>
     <div class="form-group">
       <label>Name of Group</label>
       <!--Here we are taking the input text which will be saved as the groupName in the post array, it has the required attribute as if it is not entered into the database then it will throw an error-->
       <input type="text" name="groupName" class="form-control" placeholder="Fishing Report..." required>
       <!--Here we setting a hidden input called date and storing the auctual date of the day it is submited-->
       <?php echo "<input type='hidden' name='date' value='".date('Y-m-d')."'>"; ?>
       <!-- Here we setting a hidden input called userID and setting it equal to the userID set in the session when the user logged in-->
       <input type="hidden" name="userID" value="<?php echo $_SESSION['userID']; ?>">
     </div>
     <div class="form-group">
       <label>Group Description</label>
       <!-- Here we are taking the input text which will be saved as the groupDescription in the post array, it has the required attribute as if it is not entered into the database then it will throw an error-->
       <input type="text" name="groupDescription" class="form-control" placeholder="Example of group description ..." required>
     </div>
     <div class="form-group">
       <label>Group Image</label>
       <!-- Here we are taking the input text which will be saved as the groupImage in the post array, it has the required attribute as if it is not entered into the database then it will throw an error-->
       <input type="text" name="groupImage" class="form-control" placeholder="groupImage.jpg" required>
     </div>
     <!-- This is the form submit button it has a lot of margin at the bottom as a temporary way of pushing the footer down to the bottom of the page-->
     <button type="submit" name="addgroup-submit" class="mb-5 btn-lg btn-primary">Submit</button>
   </form>

<?php
//If the user logged in is not an admin then the page will redirect them back to the index page
}else {
  // code...
  header('location: index.php');
}
?>

<div class="row justify-content-center">
  <?php
  //Here we are checking if there is a erorr set in the get array that has come from the group.inc.php
  if (isset($_GET['error'])) {
    // code...
    if ($_GET['error']=='namelong') {
      //If the error is set to 'namelong' then we echo out the following message, this error occurs when the user has entered a groupName that is longer than 50 characters
      // code...
      echo "<h3>NAME MUST BE LESS THAN 50 CHARACTERS</h3>";
    }elseif ($_GET['error']=='descriptionlong') {
      //If the error is set to 'descriptionlong' then we echo out the following message, this error occurs when the user has entered a description that is longer than 200 characters
      // code...
      echo "<h3>DESCRIPTION MUST BE LESS THAN 200 CHARACTERS</h3>";
    }
    //Here we are checking that instead of a a error message there may be a status message
  }elseif (isset($_GET['status'])) {
    // code...
    if ($_GET['status'] == 'SUCCESS') {
      //This status message can be equal to success and if it is then we echo out the following message
      // code...
      echo "<h3>SUCCESS</h3>";
    }
  }



   ?>
</div>
</div>
