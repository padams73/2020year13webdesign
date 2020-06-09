<!--This page displayed the Light Work contact details for the user-->
<div class="row">

  <div class="col-sm-2">
    <img class="back-img" src="images/lite.wrk_back.jpg" alt="Back" onclick="history.back()">
  </div>

  <div class="col-sm-6">
    <?php
      echo "<p class='title'> Contact Us </p>";
      echo "<p class='info_contact'>
        Email: support@lightworkclothing.com <?br>
        Phone: +64273480904 </br>
        Facebook: Light Work Clothing </br>
        Instagram: lightworkclothingbrand </br>
        Feel free to contact us at any time! :)
        </p>";
    ?>
  </div>

  <div class="col-sm-4 px-5 pt-5">
    <form>
      <!--Form for emailing Light Work-->
      <?php echo "<p class='info_aboutus'>Ask us a question: </p>";?>
      <div class="form-group">
        <label for="exampleFormControlInput1">Email address</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
      </div>
      <div class="form-group" text-color->
        <label for="exampleFormControlTextarea1"></label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" placeholder="What would you like to ask?"></textarea>
      </div>
      <div class="text-left">
        <button type="button" class="btn btn-light">Send</button>
      </div>
    </form>
  </div>
</div>
