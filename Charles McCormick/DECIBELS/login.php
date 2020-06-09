<?php
  //redirects if user is logged in
  if(isset($_SESSION['beta'])) {
    header("Location: index.php?page=home");
  }
  //remove session start from verify

 ?>
<div class="mainaccount">

    <h1 style="text-align: center; padding-top: 10px;">LOGIN</h1>
<form action="index.php?page=verify" method="post">
  <div class="form-group" style= "margin-left: 20px; margin-top: 20px; margin-right: 20px">
    <label>User Name</label>
    <input type="text" name="username" required class="form-control" aria-describedby="username">
  </div>
  <div class="form-group" style="margin-left: 20px; margin-top: 20px; margin-right: 20px">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" required class="form-control">
  </div>
  <button type="submit" class="btn btn-primary" style="margin-left: 20px; margin-top: 20px;">Submit</button>
</form>
</div>
</div>
