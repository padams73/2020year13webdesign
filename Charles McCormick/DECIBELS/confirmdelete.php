<?php
  // get title of song
  $musicID=$_GET['musicID'];



  // are you sure youw ant to delete title?
?>
<div class="mainaccount">

<h2 style="text-align: center;">ARE YOU SURE YOU WANT TO DELETE THIS FILE</h2>
<div class="" style="text-align: center;">

<a class="button" style="margin-right: 20px;"href="index.php?page=deletesong&musicID=<?php echo $musicID?>"> <h2> YES </h2> </a>

<a class="button" style="margin-left: 20px; "href="index.php?page=me"> <h2> NO </h2> </a>
</div>
 </div>
