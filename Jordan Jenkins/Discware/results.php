<div class="col-12">	
	<?php
	// this if statement checks if the $_POST search array has anything in it, and if it is empty, then it goes and filters by category
	if (isset($_POST['search'])) {
		// this if statement checks if the search had enything in it or not, and shows no results if the field was empty
		if (!empty($_POST['search'])) {
			// setting up sql query
			$search_sql = "SELECT * FROM listing WHERE listName LIKE '%".$_POST['search']."%'";
			// querying the database
			$search_qry = mysqli_query($dbconnect, $search_sql);
			// putting the database results into an array
			$search_aa = mysqli_fetch_assoc($search_qry);
			// checking if the database returned any results
			if (mysqli_num_rows($search_qry)>0) {
				// if there are results, the php will print all them out.
				?><p>Showing Results For <?php echo $_POST['search'];?></p><?php
				do {
					$id = $search_aa['listID'];?>
					<a href="index.php?page=list_specific&id=<?php echo $id; ?>" class="list_card">
						<img src="dbpics\<?php echo $search_aa['listImage']; ?>" alt="<?php echo $search_aa['listName']; ?>" class="card_image"/>
						<p><?php echo $search_aa['listName'];?> - $ <?php echo $search_aa['listPrice'];?> </p>
					</a><?php
				// the while is connected to do{}, so that the do{} knows when to stop
				} while ($search_aa = mysqli_fetch_assoc($search_qry));
			} else {
				// results when there are no search returns
				echo "<p>No Results Found!</p>";
			}
		} else {
			// result if the search field was left empty
			echo "<p>Search Field Is Empty!</p>";
		}
	// this function runs if the $_POST array was completely empty
	} else {
		// getting the category ID from the URl
		$catID = $_GET['categoryID'];
		// setting up the database query
		$category_sql = "SELECT * FROM listing JOIN category ON category.categoryID=listing.categoryID WHERE category.categoryID=$catID";
		// querying the database
		$category_qry = mysqli_query($dbconnect, $category_sql);
		// putting the results into an array
		$category_aa = mysqli_fetch_assoc($category_qry);
		// checking if the query returned any results
		if (mysqli_num_rows($category_qry)>0) {
			// printing out the results if any are returned
			do {
				$id = $category_aa['listID'];?>
				<a href="index.php?page=list_specific&id=<?php echo $id; ?>" class="list_card">
					<img src="dbpics/<?php echo $category_aa['listImage']; ?>" alt="<?php echo $category_aa['listName']; ?>" class="card_image"/>
					<p><?php echo $category_aa['listName']; ?> - $ <?php echo $category_aa['listPrice']; ?></p>
				</a><?php
			// the while tells do{} when it should stop echoing results
			} while ($category_aa = mysqli_fetch_assoc($category_qry));
		} else {
			// result if there are no results returned from the database
			echo "<p>Nothing In This Category</p>";
		}
	}
	?>
</div>