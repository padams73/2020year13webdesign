<?php
// this is the main hub for managing the stock
// from this page users can go to pages to view weights, edit herd details, enter weights

// connects to the database
include("dbconnect.php");

// checking that a logged in user is accessing the page
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
}

// selecting the herds from the database
$herd_sql = "SELECT * FROM herd ORDER BY herd_year DESC";
$herd_qry = mysqli_query($dbconnect, $herd_sql);
$herd_aa = mysqli_fetch_assoc($herd_qry);
// second query for the drop down list
// this query runs later on in the page after being reset
$herddropdown_qry = mysqli_query($dbconnect, $herd_sql);
$herddropdown_aa = mysqli_fetch_assoc($herddropdown_qry);
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
      <?php include("navbar.php"); ?>
      <h1 class="my-5 ml-lg-5 ml-md-3 mx-3">Stock</h1>
      <div class="row m-auto">
        <?php
        // the following php checks for a range of potential alerts that are sent to the page through GET Arrays
        // this occurs in instances such as when the user deletes stock, updates notes or a page is directly accessed without the required information being socket_sendto

        // this isset checks if an alert has been sent.
        // if so, it will check what the alert is for to then display a relevant alert message
        if (isset($_GET['alert'])) {

        // this if statement checks if an error has been sent.
        // this may occur if a user goes directly to a page instead of using a form to fill out relevant information
        if ($_GET['alert'] == 'error') { ?>
          <div class="alert alert-danger col-lg-11 my-2 ml-lg-5 ml-md-3 mx-3" role="alert">
            Error: Invalid Input
          </div>
        <?php }

        // this if statement checks if the alert is for stock being deleted
        // if so, it displays a success message to inform the user that the command was carried out
        if ($_GET['alert'] == 'delete') { ?>
          <div class="alert alert-success col-lg-11 my-2 ml-lg-5 ml-md-3 mx-3" role="alert">
            Success: Animal Deleted
          </div>
        <?php }

        // this if statement checks if the alert is regarding notes being Updated
        // if so a success message is displayed
         if ($_GET['alert'] == 'notes') { ?>
            <div class="alert alert-success col-lg-11 my-2 ml-lg-5 ml-md-3 mx-3" role="alert">
              Success: Notes Updated
            </div>
        <?php } }?>
        <!-- the div for going to pages involving data entry -->
        <div class="col-lg-3 stock_left ml-lg-5 ml-md-3 mx-3 mb-3">
          <h2 class="mt-2">Enter Data</h2>
          <p>Add Weights:</p>
          <!-- form to go to the add weights page -->
          <form class="" action="enterweights.php" method="post">
            <select class="form-control mt-1" name="year">
              <!-- this do while is to display the available herd options -->
              <?php do {
                $yeardropdown = $herddropdown_aa['herd_year']; ?>
              <option> <?php echo $yeardropdown ?></option>
            <?php } while ($herddropdown_aa = mysqli_fetch_assoc($herddropdown_qry));
            // sets pointer to zero
            mysqli_data_seek($herddropdown_qry, 0);
            ?>
          </select>
          <!-- options for which animals are being weighed -->
          <select class="form-control mt-1" name="breed">
            <option>Bulls</option>
            <option>Steers</option>
            <option>Heifers</option>
        </select>
        <button class="btn main-colour mb-2 font-weight-bold mt-1" style="color: white;" type="submit" name="button">Go</button>
      </form> <!-- end of weight form -->
      <p class="mt-3">Manage Stock</p>
      <!-- form for going to herd management page -->
      <form class="" action="manageherd.php" method="post">
        <select class="form-control mt-1" name="year">
          <!-- a while loop is used here as otherwise with the pointer being reset to 0, a do while would try select row 0 -->
          <?php while ($herddropdown_aa = mysqli_fetch_assoc($herddropdown_qry)) {
            $yeardropdown2 = $herddropdown_aa['herd_year']; ?>
          <option> <?php echo $yeardropdown2 ?></option>
        <?php } ; ?>
      </select>
      <button class="btn main-colour mb-2 font-weight-bold mt-1" style="color: white;" type="submit" name="button">Go</button>
      </form>

        </div> <!-- end of left div block -->
        <div class="col-lg-8">
          <div class="row m-auto pb-4">
            <!-- displaying herd years for the user to select one to view the logged weights -->
            <?php do { ?>
              <div class="col-lg-12 stock_right mb-3 pt-2">
                <?php
                $year_name = $herd_aa['herd_year'];
                $yearID = $herd_aa['herdID'];
                echo "<a class='d-inline float-left year_link' href='weights.php?yearID=$yearID&year_name=$year_name'><h2 class=''>$year_name</h2></a>"; ?>
                <!-- in future these will act as links to only view weights for these breeds -->
                <p href="" class="d-inline float-right mx-2 my-auto stock_link">Heifers</p>
                <p href="" class="d-inline float-right mx-2 my-auto stock_link">Steers</p>
                <p href="" class="d-inline float-right mx-2 my-auto stock_link">Bulls</p>
              </div>
            <?php } while ($herd_aa = mysqli_fetch_assoc($herd_qry)) ?>
          </div>
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
