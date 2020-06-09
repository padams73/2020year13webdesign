<?php
if (!isset($_SESSION['beta'])) {
  header("Location:index.php?page=login");
  // code...
}
 ?>
<!DOCTYPE html>
<html>
<body>
<div class="mainaccount">

<form action="index.php?page=imageupload" method="post" enctype="multipart/form-data">
<div class="form-group" style="margin-left: 20px; padding-top: 20px; margin-right: 20px;">
  <input type="text" name="Songname" placeholder="Name of song" class="form-control" aria-describedby="Songname">

</div>

  <div class="form-group" style="margin-left: 20px; margin-top: 20px;">
    <label for="Image upload">Select image to upload</label>
      <input type="file" name="imageToUpload" id="imageToUpload">
    </div>

  <div class="form-group" style="margin-left: 20px; margin-top: 20px;">
    <label for="exampleInputPassword1">Select song to upload</label>
      <input type="file" name="songToUpload" id="songToUpload">
  </div>

  <button type="submit" class="btn btn-primary" style="margin-left: 20px; margin-top: 20px;">Submit</button>
</form>

</div>
</body>
</html>
