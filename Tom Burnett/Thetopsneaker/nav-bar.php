<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #9C0000;"> <!-- Nav starts -->
  <!-- Boostrap nav-bar with css to change the background colour of the nav -->
  <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="The Top Sneaker"></a>
  <!-- Displaying the logo icon, which is also a link to the homepage -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
    <!-- Boostrap so the nav bar collapses for smaller screens like phones etc -->
    <ul class="navbar-nav ">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Browse <span class="sr-only"></span></a>
        <!-- Link sending the user back the homepage -->
      </li>
      <?php
        $brand_sql = "SELECT * FROM brand";
        // drawing everything from the database of brand
        $brand_qry = mysqli_query($dbconnect, $brand_sql);
        $brand_aa = mysqli_fetch_assoc($brand_qry);

      do { ?>
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=brand&brandid=<?php echo $brand_aa['brandid']; ?>"><?php echo $brand_aa['brand']; ?></a>
        <!-- Link to the brandid page which will display different content depending on the brandid that the user selects -->
      </li>
<?php } while ($brand_aa = mysqli_fetch_assoc($brand_qry)) ?>
      <?php
        if (!isset($_SESSION['loggedin'])) { ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=login">Login</a>
            <!-- Link to the login page -->
          </li>
      <?php   } ?>

          <?php
            if (isset($_SESSION['loggedin'])) {
              ?>
              <!-- echoing Hello then the .$_SESSION which is the username then ['loggedin'] to check if they are logged in or not.
               Then a second a tag which is a link to click on if they are signed in so they can logout which sends them to a page
               called logout.php which will run the query unset $_SESSION to remove ['loggin'] then it will display they are logged
              out-->

                <span class='nav-link'> <?php echo "Hello, ".$_SESSION['loggedin']; ?> </span> <span class='nav-link'> <?php echo "|" ?> </span> <a  class="nav-link" href="index.php?page=logout">Logout</a>
              <?php
            } else { ?>
              <!-- using a tag to create the link to send the user to the register and help page. -->
              <li class="nav-item">
              <a  class="nav-link" href="index.php?page=register">Help | Register</a>
              <!-- Sends the user to the regiester page -->
              </li>
            <?php }

           ?>
         </form> <!-- Form ends -->


      </li>
      <li class="icon_cart">
        <a class="cart_icon"  href="index.php?page=cart"><img src="images/cart-icon.png" alt="Cart"></a>
        <!-- Displaying the cart icon which is a link that sends the user to the cart page -->
      </li>
</ul>



  </div>
</nav> <!-- Nav ends -->
