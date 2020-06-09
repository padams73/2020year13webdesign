<?php
$userid = $_SESSION['userid'];
// session in the variable of userid
$cart_sql = "DELETE FROM cart WHERE userid = $userid  ";
// deleting all the content that is connected with the userid
$cart_qry = mysqli_query($dbconnect, $cart_sql);


header("Location: index.php?page=cart");
// redirecting the user to the cart page once all the items have been removed from the cart



  ?>
