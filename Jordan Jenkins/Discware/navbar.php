<!--navbar starts here-->
<div class="navbar">
	<!--dropdown_nav starts here-->
	<div class="dropdown_nav">
		<!--Here is the burger menu icon-->
		<button class="drop_button"><img width="100px" class="burger_menu" src="icons/burger_menu.png" alt="Burger Menu"/></button>
		<!--dropdown starts here-->
		<div class="dropdown">
			<div class="dropdown_subsection">
				<a href="index.php?page=results&categoryID=1"><h3>Music</h3></a>
			</div>
			<div class="dropdown_subsection">
				<a href="index.php?page=results&categoryID=2"><h3>Movies</h3></a>
			</div>
			<div class="dropdown_subsection">
				<a href="index.php?page=results&categoryID=3"><h3>Games</h3></a>
			</div>
			<!--dropdown_register starts here-->
			<div class="dropwdown_register">
			<?php
			// checking if the $_SESSION userID variable has been previously set
			if(!isset($_SESSION['userID'])) {
				// these are the links shown if the user is not logged in
				?>
				<a href="index.php?page=log_in">Log In</a>
				<a href="index.php?page=register">Register</a>
				<?php
			} else {
				// these sql queries are here to show who the user is logged in as, rahter than relying on memory
				// getting the current userID
				$userID = $_SESSION['userID'];
				// setting up the sql query
				$user_qry = "SELECT userName FROM user WHERE userID=$userID";
				// qureying the database
				$user_sql = mysqli_query($dbconnect, $user_qry);
				// putting the database results into an array
				$user_aa = mysqli_fetch_assoc($user_sql);
				// putting the user's users name into a varibale
				$username = $user_aa['userName'];
				// these navbar links are visible when the user is logged in
				?>
				<a href="index.php?page=user">My Profile (Logged in as <?php echo $username;?>)</a>
				<a href="index.php?page=logout">Log Out</a>
				<?php
			}
			?>
			</div>
			<!--dropdown_register ends here-->
		</div>
		<!--dropdown ends here-->
	</div>
	<a href="index.php?page=home"><h1>DiscWare</h1></a>
	<div class="search">
		<form action="index.php?page=results" method="post">
			<input type="text" placeholder="Search" name="search"/>
			<button type="submit"><img width="25px" class="search_button" src="icons/search_icon.png"/></button>
		</form>
	</div>
	<!--dropdown_nav ends here-->
</div>
<!--navbar ends here-->