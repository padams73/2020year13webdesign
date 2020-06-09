<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-sm-9" style="background-color:     #292929;color: white;">

      <?php
      //seting up variables 
      include('dbconect.php');
      $userID = $_SESSION['admin'];
      $title = $_POST['title'];
      $image = $_FILES["fileToUpload"]["name"];
      $filename = $_FILES["songToUpload"]["name"];
      $song_dir = "music/";
      $song_file = $song_dir . basename($_FILES["songToUpload"]["name"]);
      $target_dir = "pic/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      // Check if image file is a actual image or fake image
      if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
        } else {
          echo "File is not an image.";
          $uploadOk = 0;
        }
      }

      // Check if file already exists
      if (file_exists($target_file)) {

        $uploadOk = 3;
      }

      // Check file size
      if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
      }

      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
      }
        // Upload song checkdate


        // Check if file already exists
        if (file_exists($song_file)) {

          $uploadOk = 2;
        }

        // Check file size
        if ($_FILES["songToUpload"]["size"] > 50000000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
        }




              // Check if $uploadOk is set to 0 by an error
              if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
              // if everything is ok, try to upload file
              } else {
                if($uploadOk==2) {
                  move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
                }
                if($uploadOk==3) {
                  move_uploaded_file($_FILES["songToUpload"]["tmp_name"], $song_file);
                }
                if($uploadOk==1) {
                  move_uploaded_file($_FILES["songToUpload"]["tmp_name"], $song_file);
                  move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
                }
                $add_sql="INSERT INTO music (title,filename, userID, image) VALUES('$title', '$filename',$userID, '$image')";
                $add_qry = mysqli_query($dbconect,$add_sql);

              }




      // success message
       ?>
       <h1>song uploaded</h1>
       <p><a class="nav-link" style="color: white" href="index.php?page=home">Home</a></p>
       <p><a class="nav-link" style="color: white" href="index.php?page=addsong">Upload music</a></p>
       <p><a class="nav-link" style="color: white" href="index.php?page=logout">logout</a></p>
     </div>

   </div>
 </div>
