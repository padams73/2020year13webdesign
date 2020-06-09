<?php
// page for viewing cattle weights for a selected herds

// connects to the database
include("dbconnect.php");

// makes sure a logged in user is accessing the page
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
}

if (!isset($_GET['year_name'])) {
  header("Location: stock.php?alert=error");
} else {
  $year_name = $_GET['year_name'];
}

if (!isset($_GET['yearID'])) {
  header("Location: stock.php?alert=error");
} else {
  $herdID = $_GET['yearID'];
}

// tableheader query to get the column names
$tableheader_sql = "SELECT (YEAR(date)*100) + MONTH(date) AS yyyymm, DATE_FORMAT(date,'%m/%Y') AS label FROM weight JOIN stock ON weight.stockID=stock.stockID WHERE `herdID` = $herdID GROUP BY (YEAR(date)*100) + MONTH(date)";
$tableheader_qry = mysqli_query($dbconnect, $tableheader_sql);
$tableheader_aa = mysqli_fetch_assoc($tableheader_qry);

// gets relevant information for individual cattle
$cattleweight_sql = "SELECT stockID , tag_number, breed_name FROM stock JOIN breed ON stock.breedID = breed.breedID WHERE herdID = $herdID";
$cattleweight_qry = mysqli_query($dbconnect, $cattleweight_sql);
$cattleweight_aa = mysqli_fetch_assoc($cattleweight_qry);

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
      <?php include("navbar.php") ?>
        <h1 class="my-5 ml-lg-5 ml-md-3 mx-3"><?php echo $year_name ?> Herd</h1>
        <div class="row m-auto">
          <div class="col-lg-6 stock_left ml-lg-5 ml-md-3 mx-3 mb-3 p-0 table-responsive" style="overflow: scroll;">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Tag</th>
                  <th scope="col">Breed</th>
                    <?php do {
                    $month = $tableheader_aa['label'] ?>
                  <th scope="col"><?php echo $month ?></th>
                <?php } while ($tableheader_aa = mysqli_fetch_assoc($tableheader_qry))?>
                </tr>
              </thead>
              <tbody>
                <!-- here the cattles relevant information is selected and displayed -->
                <?php
                do {
                $tag_number = $cattleweight_aa['tag_number'];
                $breed = $cattleweight_aa['breed_name'];
                $stockID = $cattleweight_aa['stockID'];
                // this query gets the individual cattle weights to display
                $cattleweight1_sql = "SELECT (YEAR(date)*100) + MONTH(date) AS yyyymm, AVG(weight) FROM weight WHERE stockID = $stockID GROUP BY (YEAR(date)*100) + MONTH(date)";
                $cattleweight1_qry = mysqli_query($dbconnect, $cattleweight1_sql);
                $cattleweight1_aa = mysqli_fetch_assoc($cattleweight1_qry); ?>
                <tr>
                  <th scope="row"><?php echo $tag_number ?></th>
                  <td><?php echo $breed ?></td>
                  <?php do {
                    $cattleweight = $cattleweight1_aa['AVG(weight)']?>
                  <td><?php echo round($cattleweight) ?></td>
                <?php } while ($cattleweight1_aa = mysqli_fetch_assoc($cattleweight1_qry))?>
                </tr>
              <?php } while ($cattleweight_aa = mysqli_fetch_assoc($cattleweight_qry))?>
              </tbody>
            </table>
          </div>
          <div class="col-5 ml-auto weights_right">
            <img class="img-fluid weights_image" src="images/cow500px.png" alt="Image of a cow">
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
