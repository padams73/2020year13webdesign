<?php
// checks to see if the admin session has been set from the verify page and it it is not set it will boot the user to the slideIndex
// if it is set then it will display the review and logout buttons
 if(!isset($_SESSION['admin'])) {
   header("Location: index.php");
 } else {

 }
 ?>

</div>

 <div class="logout">
   <!-- links to logout page and relete reviews pages -->
<a href="index.php?page=delReview">Delete review</a>
<a href="logout.php">Logout</a>
 </div>
