<?php
  $productid = $_GET['productid'];
  // useing a get array to draw from the database
  $shoe_sql = "SELECT * FROM product WHERE productid = $productid";
  // drawing from the data base with sql
  $shoe_qry = mysqli_query($dbconnect, $shoe_sql);
if (mysqli_num_rows($shoe_qry)==0) {
  // checkng to make sure the user has entered the correct product number so they can't access a product that doesn't exist
  header("Location:index.php");
  // redirecting the user back to the homepage if they have tried to access a product that doesnt exist
} else {
   $shoe_aa = mysqli_fetch_assoc($shoe_qry);
?>

<div class="col-md-7 mt-md-0 my-2" style="padding-top: 1%;">
  <!-- layout for the product page -->


    <img class="card-img-top" src="images/<?php echo $shoe_aa['image']; ?>" alt=<?php echo $shoe_aa['name']; ?>"">
    <!-- drawing from the database and displaying the image that is connected to the productid, also the name of the product if the image wont load -->
    <div class="card-body">
      <h5 class="product_item"><?php echo $shoe_aa['name']; ?></h5>
      <!-- drawing from the database and displaying the name that is connected to the productid -->
      <p class="card-text">$<?php echo $shoe_aa['price']; ?></p>
      <!-- drawing from the database and displaying the price that is connected to the productid -->
      <p class="card-text" style="color: grey;">Description</p>
      <p class="card-text"><?php echo $shoe_aa['blurb']; ?></p>
      <!-- drawing from the database and displaying the Description that is connected to the productid -->

<a href="index.php?page=addtocart&productid=<?php echo $shoe_aa['productid'];  ?>">
  <!-- Sends them to the addcart.php page witht he id of the product -->
<button class="intro-button" type="button" name="button">Add to Cart</button>
<!-- Button to click on that adds that poductid to the cart that is registered to their userid -->
</a>




    </div>
  </div>


  <?php
}
?>
