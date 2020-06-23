
 <div class="login">

    <?php
      // if admin session is set, redirect to adminpanel page

     ?>
     <!-- form to call verify.php and posting the results to the page-->
      <form  action="verify.php" method="post">

      <div class="form-group">
        <!-- username input -->
        <label for="exampleInputEmail1">Username</label>
        <input type="text" name="username" required class="form-control" aria-describedby="username" placeholder="Enter Username">
      </div>
      <div class="form-group">
        <!-- password input -->
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
      </div>

      <button type="submit" class="button">Submit</button>
    </form>

  </div>




</html>
