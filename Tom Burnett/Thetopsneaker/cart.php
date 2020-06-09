
<?php
if(!isset($_SESSION['userid'])) {
  // if session is not set they will be redirected to the login page
  header("Location: index.php?page=login");


} else {
  $userid = $_SESSION['userid'];
  // if the session is set they will be set the the cart page displaying the productid's that are connected to their userid



  $shoe_sql = "SELECT cart.*, product.name, product.price, product.image FROM cart JOIN product ON cart.productid=product.productid WHERE cart.userid=$userid";
  // drawing all the content from the cart that is assocated with their userid
  $shoe_qry = mysqli_query($dbconnect, $shoe_sql);


  if (mysqli_num_rows($shoe_qry)==0) {
    // checking to see if their cart is empty if it is then the message below will be displayed
    ?><h2 class="login_details">Cart Empty</h2><?php
  } else {
     $shoe_aa = mysqli_fetch_assoc($shoe_qry);
     // if the cart is not empty the code below will run and display what is in their cart


?>



<table class="table table-striped">
  <thead>
    <tr>
      <!-- Table to explain what the content is displayed below -->
      <th scope="col">Your Cart</th>
      <th scope="col">Image</th>
      <th scope="col">Product</th>
      <th scope="col">Price</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
<?php

do {

?>


    <tr>
      <th scope="row"></th>
      <td><img class="image-resize-table" src="images/<?php echo $shoe_aa['image']; ?>" alt=<?php echo $shoe_aa['name']; ?>""></td>
        <!-- displaying the image that is connected to the productid, also the name of the product if the image wont load -->
      <td><?php echo $shoe_aa['name']; ?></td>
      <!-- Displaying the name of the product -->
      <td>$<?php echo $shoe_aa['price']; ?></td>
      <!-- Displaying the price of the product -->
      <td><a href="index.php?page=remove&cartid=<?php echo $shoe_aa['cartid'] ?>" class="remove">Remove</a></td>
      <!-- Link to to remove.php that will delete the productid that is selected -->
    </tr>


<?php

} while ($shoe_aa = mysqli_fetch_assoc($shoe_qry));
}
 ?>
</tbody>
</table>
<table class="table table-striped">

  <tbody>
    <tr>
      <th scope="row"></th>
      <td><a href="index.php" class="remove">Browse</a></td>
      <!-- Link back to the homepage -->
      <td><a href="index.php?page=buy" class="remove">Buy Now</a></td>
      <!-- Link to the buy page -->
      <td><a href="index.php?page=removeall" class="remove">Remove all</a></td>
      <!-- Link to the remove all page when a user wants to delete their whole cart -->
      <!-- Are you really reading these comments? If you are do tell me -->
      <?php
        $total_sql="SELECT cart.*, SUM(product.price) AS total FROM cart JOIN product ON cart.productid=product.productid WHERE userid=$userid";
          // drawing the sum/total price that is assocated with their userid that is in their cart
        $total_qry = mysqli_query($dbconnect, $total_sql);
        $total_aa = mysqli_fetch_assoc($total_qry);

       ?>
      <td><p class="remove">Total Price: $<?php echo $total_aa['total']; ?></p></td>
      <!-- Displaying the total price that is in the cart -->
    </tr>
  </tbody>
</table>

<?php
}
 ?>
