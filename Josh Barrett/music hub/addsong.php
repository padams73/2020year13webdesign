<!--adding song form to add song -->
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-sm-9" style="background-color: 	#292929; height:100vh; color: white;">
      <h2> add song</h2>
      <form action="index.php?page=entersong" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="title">title</label>
          <input type="text" name="title" class="form-control">
          </div>
          <div class="form-group">
            <label for="fileToUpload">Image</label>
            <input type="file" name="fileToUpload" id="fileToUpload">
          </div>
          <div class="form-group">
            <label for="songToUpload">Song</label>
            <input type="file" name="songToUpload" id="songToUpload">
          </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

    </div>

  </div>
</div>
