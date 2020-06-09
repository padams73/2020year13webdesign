
<div class="spacer">

</div>

<?php
  $brand = $_GET['brandid'];
  // setting up a get array for brandid
  $brand_sql = "SELECT * FROM brand WHERE brandid = $brand";
  // drawing everything from the database from brand where brandid and storing it in a variable called $brand
  $brand_qry = mysqli_query($dbconnect, $brand_sql);


  if (mysqli_num_rows($brand_qry)==0) {
    // checking to make sure they havent entered a invalid field and if they have they will be sent to the index.php page. If they have it entered corrected the code below will run
    header("Location:index.php");
  } else {
     $brand_aa = mysqli_fetch_assoc($brand_qry);
  ?>

<div class="brand">

    <h2 class="for_you"><?php echo $brand_aa['brand']; ?></h2>
    <!-- Echoing the brand name -->
</div>


    <div class="container-fluid">
      <div class="row">
        <?php
          $brandid = $_GET['brandid'];
          // get array for brand id
          $shoe_sql = "SELECT * FROM product WHERE brandid = $brandid";
          // selecting everything from product where brandid is equal to the variable of $brandid
          $shoe_qry = mysqli_query($dbconnect, $shoe_sql);
          $shoe_aa = mysqli_fetch_assoc($shoe_qry);

        do {
         ?>
         <div class="col-md-4 mt-md-0 my-2">
                <a class="product-card" href="index.php?page=product&productid=<?php echo $shoe_aa['productid'];  ?>">
                  <!-- link to the product page with the indiviudal productid that the user selects -->
               <div class="card">
             <img class="card-img-top" src="images/<?php echo $shoe_aa['image']; ?>" alt=<?php echo $shoe_aa['name']; ?>"">
               <!-- drawing from the database and displaying the image that is connected to the productid, and the name if the image does not load -->
             <div class="card-body">
               <h5 class="product_item"><?php echo $shoe_aa['name']; ?></h5>
               <!-- drawing from the data base and displaying the name of the selected productid -->
               <p class="card-text">$<?php echo $shoe_aa['price']; ?></p>
               <!-- drawing from the data base and displaying the price of the selected productid -->
             </div>
           </div>
             </a>
         </div>
    <?php } while ($shoe_aa = mysqli_fetch_assoc($shoe_qry)) ?>


      </div>
    </div>

<div class="spacer">
  <!-- Spacer that will create a space inbetween the text and the footer -->
</div>

<?php
}
?>
