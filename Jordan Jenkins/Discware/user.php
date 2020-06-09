<!--Start of the "user_page" div-->
<div classs="col-12 user_page">
	<?php
	// creating the userID variable, from the session variable established on the login verify page
	$userID = $_SESSION['userID'];
	// sql for database query
	$user_sql = "SELECT * FROM listing JOIN user ON listing.userID=user.userID WHERE listing.userID=$userID";
	// querying the database
	$user_qry = mysqli_query($dbconnect, $user_sql);
	// putting the database results into an array
	$user_aa = mysqli_fetch_assoc($user_qry);
	// putting the userName array item into a variable
	$username = $user_aa['userName'];
	?>
	<!--Greeting thw user, using a variable that has been established-->
	<p>Hello There <?php echo $username;?></p>
	<!--Start of the "tab" div-->
	<!--This div class is where the tab buttons are located for the users profile page-->
	<div class="tab">
		<button class="tablinks" onclick="openTab(event, 'my_listings')"><p>My Listings</p></button>
		<button class="tablinks" onclick="openTab(event, 'add_item')"><p>Add An Item</p></button>
	</div>
	<!--End of the "tab" class-->
	<!--Start of the "tabcontent" div-->
	<!--Here is where the "my listings" tab content is laid out, using php to print out all the content-->
	<div id="my_listings" class="tabcontent">
		<h3>My Listings</h3>
		<?php
		// here the if statement checks if the query returned any results
		if (mysqli_num_rows($user_qry)>0) {
			// if the if statement returns positive results, the user will see all listing attributed to them
			do {
				// getting the item ID from the variable and putting it in a variable
				$item_id = $user_aa['listID'];?>
				<a href="index.php?page=list_specific&id=<?php echo $item_id; ?>" class="list_card">
					<img src="dbpics\<?php echo $user_aa['listImage']; ?>" alt="<?php echo $user_aa['listName']; ?>" class="card_image"/>
					<p><?php echo $user_aa['listName'];?> - $ <?php echo $user_aa['listPrice'];?> </p>
				</a><?php
			// this while statement is linked with the do statement, so that it knows to keep printing out results until the array is empty
			} while ($user_aa = mysqli_fetch_assoc($user_qry));
		} else {
			// this else statement to 
			?><p>No listings</p><?php
		}
		?>
	</div>
	<!--End of the "tabcontent" div-->
	<!--Start of the other "tabcontent" div-->
	<div id="add_item" class="tabcontent">
		<h3>Add An Item</h3>
		<!--This massive form is required for adding listing to the database-->
		<form class="col-10 m-5" action="index.php?page=list_add_verify" method="post">
			<!--Here the user enters the name of the item-->
			<div class="form-group">
				<p>Name Of The Item:</p>
				<input minlength="1" placeholder="Avatar... Led Zeppelin 4..." type="text" name="listing-listname" class="form-control"/>
			</div><br>
			<!--Here the user enters the artist/director/publisher of the item-->
			<div class="form-group">
				<p>Who Made This?</p>
				<input minlength="1" placeholder="James Cameron... Led Zeppelin..." type="text" name="listing-listcreator" class="form-control"/>
			</div><br>
			<!--The user input price here, which will inly allow numerical input-->
			<div class="form-group">
				<p>Price:</p>
				<input minlength="1" placeholder="5.. 10.. 12.50..." type="number" name="listing-listprice" class="form-control"/>
			</div><br>
			<!--Here the user input a description for the item, with a max. of 255 characters, as that is the maximum allowed for the database-->
			<div class="form-group">
				<p>Type A Description</p>
				<h6>255 Character Max.</h6>
				<input minlength="1" placeholder="Description" type="text" maxlength="255" name="listing-listdsc" class="form_control"/>
			</div><br>
			<!--The user selects the condition if the disc, as there is no possible way to screw that up-->
			<p>Disc Condition:</p>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="disc-cnd" id="disc_bad" value="1">
			  	<label class="form-check-label" for="disc_bad">Bad</label>
			</div>
			<div class="form-check form-check-inline">
 					<input class="form-check-input" type="radio" name="disc-cnd" id="disc_okay" value="2">
 					<label class="form-check-label" for="disc_okay">Okay</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="disc-cnd" id="disc_good" value="3">
				<label class="form-check-label" for="disc_good">Good</label>
			</div><br>
			<br>
			<!--Here the user selects the image for their desired item, which is a file selector, as their is also no possible way to screw that up-->
			<div class="form-group">
   				<label for="listing_image">Choose Disc Image Here</label>
				<h6>Make Sure Your Image is in /dbpics First!</h6>
   				<input type="file" class="form-control-file" id="listing-image" name="listing-listimage">
 			</div><br>
			<!--And this is the last muliple choice selector for the disc category, as that is pretty hard to screw up-->
			<p>Disc Category:</p>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="disc-cat" id="disc_music" value="1">
			  	<label class="form-check-label" for="disc_music">Music</label>
			</div>
			<div class="form-check form-check-inline">
 					<input class="form-check-input" type="radio" name="disc-cat" id="disc_movie" value="2">
 					<label class="form-check-label" for="disc_movie">Movie</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="disc-cat" id="disc_game" value="3">
				<label class="form-check-label" for="disc_game">Game</label>
			</div><br>
			<br>
			<!--This button sends the enitre form over to the verification page, where the user can overlook their listing before published it-->
			<button type="submit" class="btn btn-success">Enter</button>
		</form>
	</div>
	<!--End of the other "tabcontent" div-->
	<!--This is the javascript for the tab system on the profile page it is essential for it to work-->
	<script>
	function openTab(evt, tabName) {
		  var i, tabcontent, tablinks;
		  tabcontent = document.getElementsByClassName("tabcontent");
		  for (i = 0; i < tabcontent.length; i++) {tabcontent[i].style.display = "none"; }
		  tablinks = document.getElementsByClassName("tablinks");
		  for (i = 0; i < tablinks.length; i++) {tablinks[i].className = tablinks[i].className.replace(" active", "");}
		  document.getElementById(tabName).style.display = "block";
		  evt.currentTarget.className += " active";
	}
	</script>
</div>
<!--End of the "user_page" div-->