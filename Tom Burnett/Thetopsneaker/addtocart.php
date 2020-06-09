<?php
if(isset($_GET['productid'])) {
  $productid = $_GET['productid'];
  // using the get array to draw from the database
  $userid = $_SESSION['userid'];
  // using a session
  $addcart_sql = "INSERT INTO cart (userid, productid) VALUES ($userid, $productid)";
  $addcart_qry = mysqli_query($dbconnect, $addcart_sql);
  // drawing from the database. from cart and pulling the content of userid and productid to add to the cart of the indiviudal user
}
header("Location: index.php?page=cart");
// redirecting the user to the cart page once their product has been added to their cart
?>
