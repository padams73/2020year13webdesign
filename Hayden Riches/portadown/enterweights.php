<?php
// this page allows the user to enter weights for a selected herd
// a form submits the weights to the submitweights page which runs the query and redirects back here

// connect to the database
include("dbconnect.php");

// checking that a logged in user is accessing the page
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
}

// making sure a breed has been posted.
// redirecting with an error message if one is not
// this checks for a post and get array
// a post would come from the stock page form
// a get would come from the submit weight page
if (isset($_POST['breed'])) {
  $breed = $_POST['breed'];
} elseif (isset($_GET['breed'])) {
  $breed = $_GET['breed'];
  } else {
  Header("Location: stock.php?alert=error");
}

// making sure a year variable has been posted
// if not then the page redirects with an error message
if (isset($_POST['year'])) {
  $year = $_POST['year'];
} elseif (isset($_GET['year'])) {
  $year = $_GET['year'];
  } else {
  Header("Location: stock.php?alert=error");
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
      <!-- including the navbar -->
      <?php include("navbar.php") ?>
      <h1 class="mt-5 ml-lg-5 ml-md-3 mx-3">Stock - Enter Weights</h1>
      <h3 class="mb-5 ml-lg-5 ml-md-3 mx-3"><?php echo $year?> <?php echo $breed ?></h3>
      <div class="ml-lg-5 ml-md-3 mx-3 mb-3 col-lg-3 bg-white py-2">
        <h3>Enter Weight:</h3>
        <form action="submitweight.php" method="post">
          <!-- form to submit tag number and weights to the submitweights page -->
          <!-- the tag number links to the animals stockID. Tag numbers in herds are 100% unique -->
          <div class="form-group">
            <label for="tag_number">Cattle Tag Number</label>
            <input type="number" class="form-control" id="tag_number" placeholder="Enter Tag Number" name="tag_number" max="999" min="1" required>
          </div>
          <div class="form-group">
            <label for="weight">Cattle Weight</label>
            <input type="number" class="form-control" id="weight" placeholder="Enter Cattle Weight" name="weight" max="999" min="1" required>
          </div>
          <!-- submitting the herd year to enter the weight for the correct herd -->
          <!-- this button submits the weight to the submitweight page -->
          <input type='hidden' name='year' value='<?php echo "$year";?>'/>
          <input type='hidden' name='breed' value='<?php echo "$breed";?>'/>
            <button type="submit" class="btn main-colour mb-2 font-weight-bold" style="color: white;">Submit</button>
        </form>
        <br>
        <!-- a complete button to send the user back to the stock page when they are finished. -->
        <form class="" action="stock.php">
          <button type="submit" class="btn main-colour mb-2 font-weight-bold" style="color: white;" onclick="return confirm('CONFIRM: Are you finished entering weights for this herd?')">Complete</button>
        </form>
      </div>
      <?php include("footer.php") ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
