<!--This page is for displaying all the clothing items from the database-->

<!--This sets the availability to 0 so that it displays the Out Now items when the user enters the page-->
<?php
  if(isset($_GET['availability'])) {
    $availability = $_GET['availability'];
  } else {
    $availability = 0;
  }

 ?>

<div class="row">

  <div class="col-md-2">
    <a href="index.php"><img class="back-img" src="images/lite.wrk_back.jpg" alt="Back"></a>
  </div>

<!--This sql query gets the clothing information from the database so that it can be displayed onto the page-->
  <?php
     $item_sql = "SELECT itemID, name, price, image FROM `items` WHERE availability = $availability";
     $item_qry = mysqli_query($dbconnect, $item_sql);
     $item_aa = mysqli_fetch_assoc($item_qry);
?>

  <div class="col-md-10">

    <img class="clothing-title" src="images/lite.wrk_name.jpg">

    <!--These links change the availability variable so that when it is 0 it shows the out now clothing and when it is 1 it is the coming soon-->
    <div class="row my-3">
      <div class="col-4 ml-5 mr-4 border">
        <a class='clothing-availability' href="index.php?page=clothing&availability=0">Out Now</a>
      </div>
      <div class="col-5 mr-4 border">
        <a class='clothing-availability' href="index.php?page=clothing&availability=1">Coming Soon</a>
      </div>
    </div>

    <!--Gets all the info from the database and turns them into variables-->
    <?php
      do {
        $name = $item_aa['name'];
        $price = $item_aa['price'];
        $image = $item_aa['image'];
        $itemID = $item_aa['itemID'];
    ?>

    <div class="row my-4">
    <div class="col-4 ml-5 mr-4 border">
      <!--Displays the image in one of the boxes-->
      <img src="images/items/<?php echo $image; ?>" class="image-resize">
    </div>
    <div class="col-5 border">
      <?php  echo "<p class='info_clothing'>$name </br>
        $$price</p>";
        // select all colours that the item comes in
        $colour_sql = "SELECT colours.RGB FROM itemcolours JOIN colours ON itemcolours.colourID=colours.colourID WHERE itemcolours.itemID=$itemID";
        $colour_qry = mysqli_query($dbconnect, $colour_sql);
        $colour_aa = mysqli_fetch_assoc($colour_qry);
      ?>

      <div class="row mx-3">
        <?php
          do {
            //finds the $RGB code for the colours for certain items and displays them in boxes
            $RGB = $colour_aa['RGB'];
            echo "<div class='col mx-1 colour-box' style='background-color:$RGB'></div>";
          } while ($colour_aa = mysqli_fetch_assoc($colour_qry));
        ?>
      </div>

      <!-- Default dropright button -->
      <div class="btn-group dropright">
        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Sizes
        </button>
        <div class="dropdown-menu">
          <!-- Dropdown has all the sizes for each item, the sql join the table of sizes to the table with the item's sizes to display in the dropdown-->
          <?php
                  $size_sql = "SELECT size.sizes FROM itemsize JOIN size ON itemsize.sizeID=size.sizeID WHERE itemsize.itemID=$itemID";
                  $size_qry = mysqli_query($dbconnect, $size_sql);
                  $size_aa = mysqli_fetch_assoc($size_qry);

                  do {
                    $size = $size_aa['sizes'];
                    echo "<a class='dropdown-item' href='#'>$size</a>";
                  } while ($size_aa = mysqli_fetch_assoc($size_qry)) ?>
        </div>
      </div>


    </div>
  </div>
  <?php
  //loops all the sql queries until all appropriate items are displayed
  } while ($item_aa = mysqli_fetch_assoc($item_qry))
  ?>
</div>
</div>
