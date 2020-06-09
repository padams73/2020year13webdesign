<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-sm-9" style="background-color:     #292929;color: white;">


      <?php
        //if your not loged in it kicks you out to the home page
        if (!isset($_SESSION['admin'])) {
          header("Location: index.php");
        }
       ?>
       <h1>you loged in!</h1>
       <p><a class="nav-link" style="color: white" href="index.php?page=home">Home</a></p>
       <p><a class="nav-link" style="color: white" href="index.php?page=addsong">Upload music</a></p>
       <p><a class="nav-link" style="color: white" href="index.php?page=logout">logout</a></p>
     </div>

   </div>
 </div>
