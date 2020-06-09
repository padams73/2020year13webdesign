<?php
// form for updating notes for cattle

// connects to the database
include("dbconnect.php");

// making sure a logged in user is accessing the page
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
}

// making sure a stockID has been set
if (!isset($_POST['stockID'])) {
  header("Location: stock.php?alert=error");
} else {
  $stockID = $_POST['stockID'];
}

// making sure a herd has been set
if (!isset($_POST['herd'])) {
  header("Location: stock.php?alert=error");
} else {
  $herd = $_POST['herd'];
}

// making sure a tag_number has been set
if (!isset($_POST['tag_number'])) {
  header("Location: stock.php?alert=error");
} else {
  $tag_number = $_POST['tag_number'];
}

// making sure notes have been set
if (!isset($_POST['notes'])) {
  header("Location: stock.php?alert=error");
} else {
  $notes = $_POST['notes'];
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
    <!-- includes the navbar -->
    <?php include("navbar.php") ?>
      <h1 class="my-5 ml-lg-5 ml-md-3 mx-3">Notes: Number <?php echo $tag_number?>, Herd <?php echo $herd ?></h1>
      <div class="container row col-12 m-auto pb-5">
        <div class="col-lg-8 ml-4 bg-white">
          <h2 class="mt-2">Current Notes:</h2>
          <p><?php echo $notes ?></p>
          <h2 class="mt-2">Update Notes:</h2>
          <!-- form for updating the notes -->
          <form action="submitnotes.php" method="post">
            <input type="text" name="notes" required>
            <input type="hidden" name="stockID" value="<?php echo $stockID ?>">
            <button class="btn main-colour mb-2 font-weight-bold" style="color: white;" type="submit" name="button">Submit</button>
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
