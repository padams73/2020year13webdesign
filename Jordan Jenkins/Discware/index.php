<?php
// starting the session, which will spread to all pages that get inluded
session_start();
// here the database is connected, with will spread to all included pages
include("dbconnect.php");
?>
<!doctype html>
<!--Start of html tag-->
<html>
	<!--Start of head tag-->
	<head>
		<!--Standard header, with additional css files for custom fonts and bootstrap-->
		<meta charset="utf-8">
		<!--Here is the name of the website, which shows on the tab-->
		<title>DiscWare</title>	
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.typekit.net/iec1thu.css">
		<link rel="stylesheet" href="custom.css"/>
	</head>
	<!--End of head tag-->
	<!--Start of body tag-->
	<body>
		<?php
		// including the navbar, to make it easier to edit if need, as it has its own page
		include("navbar.php");
		?>
		<!--Start of container-fluid div-->
		<!--this container is controlled by bootstrap and holds all content shwown on any page-->
		<div class="container-fluid">
			<?php
			// setting up a variable to identify the name of the page in the URL
			$page = $_GET['page'];
			// this if statement will inlcude the specified page, otherwise it will redirect them to the home page
			if (isset($_GET['page'])) {
				include("$page.php");
			} else {
				header("Location: index.php?page=home");
			} 
			?>
		</div>
		<?php
		// including the footer, with has "copywright and legal things"
		include("footer.php");
		?>
		<!--End of container-fluid div-->
		<!--Here the bootstrap javascript is included so that bootstrap will be fully functional-->
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	</body>
	<!--End of body tag-->
</html>
<!--End of html tag-->
