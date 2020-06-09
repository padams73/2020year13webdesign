<!--This page is for adding a colour to the database-->

<div class="row">
  <div class="col-md-2">
    <img class="back-img" src="images/lite.wrk_back.jpg" alt="Back" onclick="history.back()">
  </div>


  <div class="col-md-8">
    <?php
      echo "<p class='title'>Add Colour</p>";
      echo "<p class='info_admin'>Please find colour picker (simple google will do). Once done, copy the six digit RGB code into the box below and it will add it to the collection, also make sure there is a # at the start :)</p>";
     ?>


    <form action="index.php?page=entercolour" method="post">
      <div class='admin_form'"form-group">
        <label>RGB of Colour</label>
        <input type="text" maxlength="7" name="colourRGB" class="form-control" aria-describedby="Clothing name" placeholder="#******" required>
      </div>
      <div class='admin_button'>
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
    </div>
</div>
