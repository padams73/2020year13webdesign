<!--log in form,posting the imformation user puts in to the log in it sendd to the verify.php -->
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-sm-9" style="background-color: 	#292929; height:100vh; color: white;">
      <h2> login</h2>
      <form action="verify.php" method="post">
        <div class="form-group">
          <label for="username">username</label>
          <input type="text" name="username" class="form-control">
          </div>
        <div class="form-group">
          <label for="Password">Password</label>
          <input type="password" name="password" class="form-control" >
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="index.php?page=adduser">sign up</a>
      </form>

    </div>

  </div>
</div>
