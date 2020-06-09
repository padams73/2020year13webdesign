<?php
//this page allows the user to creare an account to login to the site with

//if the users logged in they will be redirected
  if(isset($_SESSION['beta'])) {
    header("Location: index.php?page=home");
  }

 ?>
<div class="mainaccount">
  <h1 style="text-align: center; padding-top: 10px;">REGISTER</h1>
  <form action="index.php?page=addaccount" method="post">
      <div class="form-group" style= "margin-left: 20px; margin-top: 20px; margin-right: 20px">
      <label>Enter User Name</label>
    <input type="text" name="Username" placeholder="Name of user" class="form-control" aria-describedby="Username">
  </div>
    <div class="form-group" style= "margin-left: 20px; margin-top: 20px; margin-right: 20px">

        <label>Enter Password</label>
    <input type="password" name="Password" placeholder="Password" class="form-control" aria-describedby="Password">
</div>

<?php
  // check for errors
  if(isset($_GET['error'])) { ?>

    <div class="alert alert-danger" role="alert">
complete vboth fields
  </div>
  <?php }

 ?>
   <div class="form-group" style= "margin-left: 20px; margin-top: 20px; margin-right: 20px">
  <button type="submit" class="btn btn-primary" >Submit</button>
</div>
</form>

</div>
