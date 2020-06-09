<?php
// establishing session variables for the next page using the post array sent from the previous pageout
$_SESSION['listing-listname'] = $_POST['listing-listname'];
$_SESSION['listing-listcreator'] = $_POST['listing-listcreator'];
$_SESSION['listing-listprice'] = $_POST['listing-listprice'];
$_SESSION['listing-listdsc'] = $_POST['listing-listdsc'];
$_SESSION['disc-cnd'] = $_POST['disc-cnd'];
$_SESSION['listing-listimage'] = $_POST['listing-listimage'];
$_SESSION['disc-cat'] = $_POST['disc-cat'];
// using the session variables to keep consistency between this page and the next
$list_name = $_SESSION['listing-listname'];
$list_creator = $_SESSION['listing-listcreator'];
$list_price = $_SESSION['listing-listprice'];
$list_dsc = $_SESSION['listing-listdsc'];
$list_cnd = $_SESSION['disc-cnd'];
$list_image = $_SESSION['listing-listimage'];
$list_cat = $_SESSION['disc-cat'];
$ses_userID = $_SESSION['userID'];
// setting up the sql query
$new_list_sql = "SELECT userName FROM user WHERE userID=$ses_userID";
// connecting to and querying the database
$new_list_qry = mysqli_query($dbconnect, $new_list_sql);
// putting the data base results into an array
$new_list_aa = mysqli_fetch_assoc($new_list_qry);?>
<!--echoing the results from the user input to give visual feedback on what the listing will look like-->
<div class="col-12 list_specific">
	<h1><?php echo $list_name;?></h1>
	<h2>By <?php echo $list_creator;?></h2>
	<img class="item_image" src="dbpics\<?php echo $list_image;?>" alt="<?php echo $list_name;?>"/>
	<div class="item_details">
		<p class="disc_condition_<?php echo $list_cnd;?>">Disc Condition</p>
		<p>Price - $<?php echo $list_price;?></p>
		<p class="item_description"><?php echo $list_dsc;?></p>
		<!--Asking the user if it looks right, else they will be sent back to the previous input page-->
		<p>Does This Look Right?</p>
		<a href="list_add.php">Yes</a>
		<button class="btn btn-primary" onclick="history.go(-1)">
			<p>No</p>
		</button>
	</div>
</div>