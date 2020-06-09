<?php
// this page is where the user can view relevant information for an Animal
// the user can also make notes to record information such as illnesses

// checks that the page is not being accessed by a user not logged in
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
}

// connecting to database
include("dbconnect.php");

// checking that a stockID has been selected.
// redirecting user and giving an error message if one has not been selected
if (!isset($_GET['stockID'])) {
  header("Location: stock.php?error=error");
} else {
  $stockID = $_GET['stockID'];
}

// selecting the information about the selected animal
$stockinfo_sql = "SELECT * FROM stock JOIN breed ON stock.breedID=breed.breedID JOIN herd ON stock.herdID=herd.herdID WHERE stockID = $stockID";
$stockinfo_qry = mysqli_query($dbconnect, $stockinfo_sql);
$stockinfo_aa = mysqli_fetch_assoc($stockinfo_qry);

// fetching relevant stock information from the database to be displayed
$breed = $stockinfo_aa['breed_name'];
$herd = $stockinfo_aa['herd_year'];
$tag_number = $stockinfo_aa['tag_number'];
$notes = $stockinfo_aa['notes'];

// assigning a message to the notes variable if there have been no notes made about the animal
if (empty($notes)) {
  $notes = "No notes have been entered";
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
      <h1 class="my-5 ml-lg-5 ml-md-3 mx-3">Number <?php echo $tag_number ?></h1>
      <div class="container row col-12 m-auto pb-5">
        <div class="col-lg-8 ml-4 bg-white">

          <h2 class="mt-2">Info:</h2>
          <p>Tag Number: <?php echo $tag_number ?></p>
          <p>Herd: <?php echo $herd ?></p>
          <p>Breed: <?php echo $breed ?></p>
          <br>

          <h2 class="mt-2">Notes:</h2>
          <p><?php echo $notes ?></p>

          <h2 class="mt-2">Options:</h2>
          <form action="deletestock.php" method="post">
            <input type="hidden" name="stockID" value="<?php echo $stockID ?>">
            <button class="btn main-colour mb-2 font-weight-bold" onclick="return confirm('Are you sure you want to delete this animal? This action cannot be undone.')" style="color: white;" type="submit" name="button">Delete Stock</button>
          </form>
          <form action="updatenotes.php" method="post">
            <input type="hidden" name="stockID" value="<?php echo $stockID ?>">
            <input type="hidden" name="tag_number" value="<?php echo $tag_number ?>">
            <input type="hidden" name="herd" value="<?php echo $herd ?>">
            <input type="hidden" name="notes" value="<?php echo $notes ?>">
            <button class="btn main-colour mb-2 font-weight-bold" style="color: white;" type="submit" name="button">Update Notes</button>
          </form>
        </div>
      </div>
      <?php include("footer.php") ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
