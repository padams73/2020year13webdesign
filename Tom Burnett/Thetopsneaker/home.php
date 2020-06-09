




<div class="row">
  <div class="col">
      <img  src="images/yeezy-black.jpg" class="image-resize" alt="background image">
      <!-- Including the a imgae from the image folder that will be the background image for my home page -->
  </div>
</div>



<div class="container_for_you">
    <h2 class="for_you">Recommended For You</h2>
    <!-- Simple header for users to see that will say what we Recommended for them -->
</div>


<div class="container-fluid">
  <div class="row">
    <?php
      $shoe_sql = "SELECT * FROM product";
      // drawing everything from the product table
      $shoe_qry = mysqli_query($dbconnect, $shoe_sql);
      $shoe_aa = mysqli_fetch_assoc($shoe_qry);

    do {
     ?>

    <div class="col-md-4 mt-md-0 my-2">
           <a class="product-card" href="index.php?page=product&productid=<?php echo $shoe_aa['productid'];  ?>">
<!-- link for users to click on that will send them to the product page with the indiviudal productid that they select -->
          <div class="card">
        <img class="card-img-top" src="images/<?php echo $shoe_aa['image']; ?>" alt=<?php echo $shoe_aa['name']; ?>"">
        <!-- drawing from the database and displaying the image that is connected to the productid, also the name if the mage does not load -->
        <div class="card-body">
          <!-- Container for the content to sit inside -->
          <h5 class="product_item"><?php echo $shoe_aa['name']; ?></h5>
          <!-- drawing from the database and displaying the name that is connected to the productid -->
          <p class="card-text">$<?php echo $shoe_aa['price']; ?></p>
          <!-- drawing from the database and displaying the price that is connected to the productid -->
        </div>
      </div>
        </a>
    </div>

<?php } while ($shoe_aa = mysqli_fetch_assoc($shoe_qry)) ?>


  </div>
</div>

<div class="spacer">
  <!-- Spacer to leave a gap of 1% in between content on the site -->
</div>
