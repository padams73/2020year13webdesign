
<?php
$cartid = $_GET['cartid'];
// using a get array to draw from the database
$cart_sql = "DELETE FROM cart WHERE cartid = $cartid  ";
// delete query to remove the item from the userid that was selected
$cart_qry = mysqli_query($dbconnect, $cart_sql);


header("Location: index.php?page=cart");
// redirecting to the cart page once the indiviudal item has been removed fromt the userid



  ?>
