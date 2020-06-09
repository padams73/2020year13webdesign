<form class="col-6 m-5" action="verify.php" method="post">
	<!--this is the login form which the info is then carried over to the verify page, where the session is started and the user is actually logged in-->
	<div class="form-group">
    	<h2>User Name</h2>
    	<input type="text" name="user-username" class="form-control">
  	</div>
  	<div class="form-group mt-3">
    	<h2>Password</h2>
    	<input type="password" name="user-password" class="form-control">
  	</div>
  	<button type="submit" class="btn btn-primary">Submit</button>
</form>