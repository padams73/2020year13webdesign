<?php
// this page allows the user to select an animal to view it's details.

// connects to the database
include("dbconnect.php");

// making sure a logged in user is accessing the page
// if not, it directs them to the login page
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
}

// checking that a year variable has been set
// if not it redirects back to stock with an error message
if (!isset($_POST['year'])) {
  header("Location: stock.php?error=error");
} else {
  $year = $_POST['year'];
}

// selects all stock from the database for the selected herd
// orders them by their tag number
$manageherd_sql = "SELECT * FROM stock JOIN herd ON stock.herdID=herd.herdID WHERE herd_year = $year ORDER BY tag_number";
$manageherd_qry = mysqli_query($dbconnect, $manageherd_sql);
$manageherd_aa = mysqli_fetch_assoc($manageherd_qry);
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
      <h1 class="my-5 ml-lg-5 ml-md-3 mx-3">Manage Stock - <?php echo $year ?> Herd</h1>
      <div class="mx-4">
        <!-- making a div for each of the stock. Displays the tag number -->
        <div class="row m-auto">
          <?php do {
            $tag_number = $manageherd_aa['tag_number'];
            $stockID = $manageherd_aa['stockID']; ?>
          <div class="col-3 m-auto">
            <div class="card mt-2" style="text-align: center;">
              <a href="managestock.php?stockID=<?php echo $stockID ?>" style="font-size: 25px; color: black;"><?php echo $tag_number ?></a>
            </div>
          </div>
        <?php } while ($manageherd_aa = mysqli_fetch_assoc($manageherd_qry)) ?>
        </div>
      </div>
      <!-- includes the footer -->
      <?php include("footer.php") ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
