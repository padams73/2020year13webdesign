<!--This page is when the admin wants the delete/edit availabilty of an item, it displays all clothing items-->
<div class="row">
  <div class="col-md-2">
    <a href="index.php"><img class="back-img" src="images/lite.wrk_back.jpg" alt="Back"></a>
  </div>

  <div class="col-md-8">
    <?php
      echo "<p class='title'>Edit an Item</p>";
    ?>

    <!--SQL of getting all item photos and their ID from the items table in my database-->
    <?php
       $item_sql = "SELECT itemID, image, availability FROM `items`";
       $item_qry = mysqli_query($dbconnect, $item_sql);
       $item_aa = mysqli_fetch_assoc($item_qry);

        do {
          //turns them into variables
          $itemID = $item_aa['itemID'];
          $image= $item_aa['image'];
          $availability = $item_aa['availability'];
      ?>

      <div class="row my-4">
        <div class="col-4 ml-5 mr-4 border">
          <!--Displays the image of the items-->
          <img src="images/items/<?php echo $image; ?>" class="image-resize">
        </div>
        <div class="col-4 ml-5 mr-4 border">
        <!--This part of the code is for the radio buttons that edit the availability of the items-->
        <a class='select-link' href="index.php?page=deleteitemconfirm&itemID=<?php  echo $itemID; ?>">Delete Item</a></p>
        <div class="input-group">
          <form method="post" action="index.php?page=update&itemID=<?php echo $itemID; ?>">
          <input type="radio" name="availability" value="0" <?php if($availability==0) {echo "checked='checked'";} ?>>
          <?php echo "<p class='select-info'>Out Now</p>";?>
        </div>
        <div class="input-group">
          <input type="radio" name="availability" value="1" <?php if($availability==1) {echo "checked='checked'";} ?>>
          <?php echo "<p class='select-info'>Coming Soon</p>";?> </br>

        </br>
          <button type="submit" class="btn btn-dark">Update</button>
          </form>
        </div>
        </div>
      </div>
    </div>

        <!--Loops until all items are displayed-->
        <?php } while ($item_aa = mysqli_fetch_assoc($item_qry)) ?>
  </div>
</div>
