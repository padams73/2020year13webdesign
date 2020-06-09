<a name="contact"></a>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

<?php
include("dbconnect.php");
 ?>

<p></p>

<h2>Contact Nicholas Clapp</h2>
<h2>Please fill in the form below to get hold of the Clapp</h2>

<form action="entercontact.php" method="post">
  <div class="form-group">
    <label for="inputname">Name</label>
    <input type="inputname" name = "name" class="form-control" id="name" placeholder="Enter your name">
  </div>

  <div class="form-group">
    <label for="inputemail">Email address</label>
    <input type="inputemail" name = "email" class="form-control" id="email"  placeholder="Enter email">
  </div>

  <div class="form-group">
    <label for="inputphone">Phone</label>
    <input type="inputphone" name = "phone" class="form-control" id="phone" placeholder="Enter phone number">
  </div>

  <div class="form-group">
    <label for="inputphone">Message</label>
    <input type="inputmessage" name = "message" class="form-control" id="message" placeholder="Enter message">
  </div>


  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
