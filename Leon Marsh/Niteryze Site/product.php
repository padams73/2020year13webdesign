<?php  include("dbconnect.php"); ?>
<!-- <form action="index.php?page=product" method="post"> -->


       <div class="content1">
         <h2>Our Product ☰</h2>
         <!--https://coolsymbol.com/line-symbols.html -->
         <!-- all content displayed on site -->
         <p>The product we came up with is skate lights that mount to the trucks of the skateboard, this product is directed towards people who ride at night or in dimly lit areas, the product would hopefully allow the rider to see the conditions they are riding in with the front lights being bright leds allowing the rider to see obstacles such as stones and other potential hazards, there are also rear red lights, this would allow other pedestrians and vehicles to see the rider in the dark, with the rise of electric skateboards this especially important due to the speeds they can travel at. <p/>

           <p>Our product is be sustainable as we use sustainable packaging for our products, and we produce the light housing from recycled plastic. One very important thing we found is that people wouldn’t use our product if it was noticeable due to the its not cool stigma that comes with some skaters, to try and combat this we produced the lights in the form of a riser, a common accessory for skaters, this way it is discrete while still doing its job.
           </p>
           <div class="photos">
             <img src="images/riser.png" alt="our skateboard riser">
           </div>

       </div>
       <div class="addReview">

       <!-- Button to open the review form -->
       <button onclick="document.getElementById('id01').style.display='block'">Add A Review</button>
       </div>

       <!-- The review (contains the Review form) -->
       <div id="id01" class="modal">
         <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">Close ☰</span>
         <form class="modal-content" action="review.php" method="post">
           <div class="container">
             <h1>Add A Review</h1>
             <p>Would you like to leave a review?</p>
             <hr>

             <!-- all forms to submit the name of the user and their reveiw -->
             <label> <b>Name</b></label>
             <input type="text" placeholder="Enter Name." name="name" required>

             <label> <b>Enter A Review</b></label>
             <input type="text" placeholder="Enter Review." name="review" required>
                      <div class="clearfix">
             <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
             <button type="submit" class="signup">Leave Review</button>

             </div>
           </div>
         </form>
       </div>

       <script>
// Get the review form
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the form, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
       <!-- Slideshow container that contains all reviews-->
<div class="slideshow-container">

  <?php
  // selects all content from the reviews database
   $review_sql =  "SELECT * FROM reviews";
   $review_qry = mysqli_query($dbconnect, $review_sql);
   $review_aa = mysqli_fetch_assoc($review_qry);
   ?>

      <?php
      // do while loop to go through and display all reviews
        do {
        ?>
        <?php
        // puts the users name and review into a variable
          $review = $review_aa['review'];
          $name = $review_aa['name'];


          ?>
          <!-- echos the users name and review in the review slider -->
          <div class="mySlides">
          <p><?php echo $review;?></p>
          <h1><?php echo $name; ?></h1>


        </div>
        <!-- while loop will end when all reviews are displayed -->
      <?php } while ($review_aa = mysqli_fetch_assoc($review_qry))

      ?>

  <!-- Next/prev buttons -->
  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>

<!-- all javascript for the review slider -->
<script type="text/javascript">
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
showSlides(slideIndex += n);
}

function currentSlide(n) {
showSlides(slideIndex = n);
}

function showSlides(n) {
var i;
var slides = document.getElementsByClassName("mySlides");
var dots = document.getElementsByClassName("dot");
if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
slides[slideIndex-1].style.display = "block";
dots[slideIndex-1].className += " active";
}
</script>

</html>
