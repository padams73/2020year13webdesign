<!-- This page allows the volunteer to be added to the database -->

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

include('dbconnect.php'); // Connecting to database

$name = $_POST['name'];
$email = $_POST ['email'];
$phone = $_POST ['phone'];

$insert_sql = "INSERT INTO volunteers (name, email, phone) VALUES ('$name', '$email', '$phone')";
mysqli_query($dbconnect, $insert_sql);

include('navbar.php'); ?>

<h2>Thanks for volunteering</h2>
