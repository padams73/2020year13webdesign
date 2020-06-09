<!-- This page allows news to be added to the site -->

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

$headline = $_POST['headline'];
$date = $_POST ['date'];
$content = $_POST ['content'];

$insert_sql = "INSERT INTO news (headline, date, content) VALUES ('$headline', '$date', '$content')";
mysqli_query($dbconnect, $insert_sql);

include('navbar.php'); ?>

<p>You're new item has been entered into the database</p>
