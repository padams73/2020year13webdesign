<!--creating a form group using bootstrap-->
<form class="col-6 m-5" action="new_user.php" method="post">
	<!--here the user enters their new username-->
	<div class="form-group">
    	<h2>Enter A User Name:</h2>
    	<input type="text" name="user-username" class="form-control">
  	</div>
	<!--here the user enters the password-->
  	<div class="form-group mt-3">
    	<h2>Make Up A Password:</h2>
    	<input type="password" name="user-password" class="form-control">
  	</div>
  	<button type="submit" class="btn btn-primary">Submit</button>
</form>