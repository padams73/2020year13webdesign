<?php
// this page is where users are redirected to if they are not logged in.
// users may enter a valid username and password to be redirected to the index page

// connecting to the database
include("dbconnect.php");

// telling the page we will be dealing with sessions
session_start();
// checking if the user is logged in. If so, redirecting to the index page
if (isset($_SESSION['admin'])) {
  header("Location: index.php");
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Portadown</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="row">
      <div class="col-8 main-colour">
        <img src="Images/loginshed.png" alt="" class="img-fluid login_image" style="overflow: hidden;">
      </div>
      <div class="col-lg-4 col-sm-10 margin-auto main-colour" style="min-height: 800px";>
        <!-- form to enter username and password -->
        <form class="col-lg-9" action="verify.php" method="post">
          <p class="text-white" style="margin-top: 100px; font-size: 50px;">Login</p>
          <!-- checking if the page has been redirected to for having incorrect details entered -->
          <!-- if this is the case then the page displays an error message -->
          <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger" role="alert">
              Incorrect username or password
            </div>
          <?php } ?>
          <div class="form-group">
            <label for="exampleInputEmail1" class="text-white">Username</label>
            <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Enter username" name="user">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1" class="text-white">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
          </div>
          <button type="submit" name="button" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
