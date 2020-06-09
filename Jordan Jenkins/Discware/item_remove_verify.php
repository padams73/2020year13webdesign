<?php
// getting the item id
$remove_id = $_GET['id'];
// setting up the sql query
$remove_sql = "SELECT * FROM listing WHERE listID=$remove_id";
// connecting to and querying the database
$remove_qry = mysqli_query($dbconnect, $remove_sql);
// putting the results into an array
$remove_aa = mysqli_fetch_assoc($remove_qry);
$purchase_id = $_GET['purchase'];
if ($purchase_id==1) {
	$purchase = "purchase";
} else {
	$purchase = "delete";
}
?>
<!--Checking if the user actually wants to delete the item, if not they will be sent back to the previous page-->
<div class="remove">
	<h3>Are you sure you want to <?php echo $purchase; ?> <?php echo $remove_aa['listName'];?> from the website?</h3>
	<button class="btn btn-success" onclick="history.go(-1)">
		<p>No</p>
	</button>
	<a class="item_remove" href="item_remove.php?id=<?php echo $remove_id;?>">Yes</a>
</div>