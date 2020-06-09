<!--This is page is for all the admin functions, to access this the user needs to have an admin login-->

<!--Starts the sessino so that if the admin hasn't logged in yet they are directed to the login page-->
<?php
  session_start();
  if(!isset($_SESSION['admin'])) {
    header("Location: index.php");
  }
  ?>

  <div class="row">
    <div class="col-md-2">
      <a href="index.php"><img class="back-img" src="images/lite.wrk_back.jpg" alt="Back"></a>
    </div>

    <div class="col-md-8">
      <?php
        echo "<p class='title'>Admin Panel</p>"
       ?>
       <!--All the admin functions-->
       <a class='admin-link' href="index.php?page=addclothing">Add Item</a></p>
       <a class='admin-link' href="index.php?page=selectitem">Edit Item</a></p>
       <a class='admin-link' href="index.php?page=addcolour">Add Colour</a></p>

       <a class='admin-link' href="index.php?page=logout">Logout</a></p>
     </div>
   </div>
