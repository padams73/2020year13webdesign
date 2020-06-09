<!--This page is for adding an item of clothing to the database-->
<div class="row">
  <div class="col-md-2">
    <img class="back-img" src="images/lite.wrk_back.jpg" alt="Back" onclick="history.back()">
  </div>

  <div class="col-md-9">
    <?php
      echo "<p class='title'>Add Clothing</p>";
      echo "<p class='info_admin'>Fill out the information to add the clothing to the page</p>"
    ?>
    <!--This section is gathering the information from the user about the clothing they want to add-->
    <form action="index.php?page=enterclothing" method="post" enctype="multipart/form-data">
      <div class='admin-form'"form-group">
        <label>Name of Clothing</label>
        <input type="text" name="clothingname" required placehold="Name of Clothing Item" class="form-control" aria-describedby="Clothing name" placeholder="Clothing Name">
      </div>
      <div class='admin-form'"form-group">
        <label>Clothing Price</label>
        <input type="number" name="clothingprice" required class="form-control" placeholder="Clothing Price">
      </div>
      <div class='admin-form'"form-group">
        <label>Select image of item</label>
         <input type="file" name="fileToUpload" id="fileToUpload" required>
      </div>

      <?php echo "<p class='info_aboutus'>Sizes available:</p>" ?>

      <?php

        $size_sql = "SELECT * FROM size";
        $size_qry = mysqli_query($dbconnect, $size_sql);
        $size_aa = mysqli_fetch_assoc($size_qry); ?>

        <?php do {
          $sizeID = $size_aa['sizeID'];
          $size = $size_aa['sizes'];
        ?>

        <div class='checkbox form-check'>
          <input type="checkbox" name="size[]" value="<?php echo $sizeID; ?>" class="form-check-input" id="<?php echo $sizeID; ?>">
          <label class="form-check-label" for="<?php echo $sizeID; ?>"><?php echo $size; ?></label> </br>
        </div>
<?php } while ($size_aa = mysqli_fetch_assoc($size_qry))?>



<?php echo "<p class='info_aboutus'>Colours available:</p>"?>

  <?php
  $colour_sql = "SELECT * FROM colours";
  $colour_qry = mysqli_query($dbconnect, $colour_sql);
  $colour_aa = mysqli_fetch_assoc($colour_qry);
do {
$colourID = $colour_aa['colourID'];
$colour = $colour_aa['RGB'];
   ?>
   <div class='checkbox' "form-check">
  <input type="checkbox" name="colour[]" value="<?php echo $colourID; ?>" class="form-check-input" id="<?php echo $colour; ?>">
  <label class="form-check-label" for="<?php echo $colour; ?>"><?php echo "<div class='col mx-1 colour-box' style='background-color:$colour'></div>"; ?></label> </br>
</div>
<?php } while ($colour_aa = mysqli_fetch_assoc($colour_qry))?>

    </br>
    <div class='admin_button'>
      <button type="submit" class="btn btn-success">Submit</button>
    </div>
  </form>
  </div>
</div>
