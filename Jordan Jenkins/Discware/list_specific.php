<div class="col-12 list_specific">
	<?php
	// Here the fucntion $id is getting the listings id from the URL via $_GET array
	$id = $_GET["id"];
	// setting up the query for the database
	$item_sql = "SELECT * FROM listing JOIN user ON listing.userID=user.userID WHERE listID=$id";
	// querying the database
	$item_qry = mysqli_query($dbconnect, $item_sql);
	// putting the query into an array
	$item_aa = mysqli_fetch_assoc($item_qry);
	?>
	<!--echoing the name of the listing-->
	<h1><?php echo $item_aa['listName'];?></h1>
	<h2>By <?php echo $item_aa['listItemCreator'];?></h2>
	<img class="list_image img-fluid" src="dbpics\<?php echo $item_aa['listImage'];?>" alt="<?php echo $item_aa['listName'];?>"/>
	<div class="item_details">
		<p class="disc_condition_<?php echo $item_aa['listCnd'];?>">Disc Condition</p>
		<p>Price - $<?php echo $item_aa['listPrice'];?></p>
		<p class="item_description"><?php echo $item_aa['listDsc'];?></p>
		<?php
		// if the user is an admin, this if statement will show a delete button, which will delete the currently viewed listing
		if (isset($_SESSION['userID'])) {
			if ($_SESSION['userID']==1) {
				?><a href="index.php?page=item_remove_verify&purchase=0&id=<?php echo $item_aa['listID'];?>">Delete</a><?php
			} else {
				?><a href="index.php?page=item_remove_verify&purchase=1&id=<?php echo $item_aa['listID'];?>">Purchase</a><?php
			}
		} else {
			echo "<p>You must be logged in to purchase items!";
		}
		?>
	</div>
</div>