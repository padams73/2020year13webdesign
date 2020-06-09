<?php
  // the is the shell page that will be the template for all others
  // First, include the dbconnect.php file

  include("dbconnect.php");

  //Next, we need to set the timezone, this will be useful later when we use the date in functions
  //We also need to start a session so the website can store information about the user that is logged in
  date_default_timezone_set('NZ');
  session_start();
 ?>

<!DOCTYPE HTML>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<link rel="stylesheet" href="styles.css">
<title>Bounding Salmon</title>
</head>
<body>
<!-- Here we have to create the div class container-fluid otherwise the navbar spans off the page i.e more than 100% of the screen width -->
<div class="container-fluid">
<!-- Start of the header tag, I am making the background here white because in my styles sheet I have set the default background colour to a grey -->
  <div class="header bg-white">
    <!-- Here I beginning to chop up the header into different columns and rows so that I can lay it out more aesthetically-->
    <div class="row pt-2" style="border-bottom:solid; border-color:grey;">
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-2">
            <!-- This is the bounding salmon logo which also doubles as a link back to the home page -->
            <a href="index.php"><img class="logo" src="images/fish.png" alt="Bounding Salmon Logo" width="115" height="110"></a>
          </div>
          <div class="col-md-10">
            <div class="row">
              <h1 style="font-size:35px;">Bounding Salmon</h1>
            </div>
            <div class="row">
              <h3 style="font-size:15px; opacity:0.85;">NZ's Home of Fishing Advice</h3>
            </div>
          <div class="row pt-2 mt-1 mr-5 border-top border-dark">
            <!-- Here are some navbar links-->
            <div class="col-4 p-0">
              <a href="index.php" class="navlink"><h5>Home</h5></a>
            </div>
            <div class="col-4 p-0">
              <a href="index.php?page=following" class="navlink"><h5>Following</h5></a>
            </div>
            <div class="col-4 p-0 pl-5">
              <a href="index.php?page=about" class="navlink"><h5>About</h5></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <!-- This the row that contains the dynamic links to the login/account page, in the row we have given it the justify-content-end class which effectively starts of the content from the the right instead of the left -->
      <div class="row justify-content-end">
        <?php
        //This is checking if the userID is set in the session
        if (isset($_SESSION['userID'])){
          //If userID is set in the session then the user is already logged in so it displays logout/my account
          echo "<a href='index.php?page=login' class='LOGIN' style='text-decoration:none; color: black; margin-right:1%;'><h10>LOGOUT/MY ACCOUNT</h10> </a>";
        }else {
          //If userID is not set in the sessions then the user is not logged in yet so it displays Login/Create Account
          echo "<a href='index.php?page=login' class='LOGIN' style='text-decoration:none; color: black; margin-right:1%;''><h10>LOGIN/CREATE ACCOUNT</h10> </a>";
        }

        ?>

        <img class="account" style="width:6%; height: 7%; float:right;" src="images/account.png" alt="" onclick="Location.href='index.php?page=login'">
    </div>
    <!-- This is the row beneath the login/account dynamic link, this row contains the searchbar -->
    <div class="row justify-content-end">
      <!-- This is the form for the search bar which redirects the user to the results page with the search query -->
      <form action="index.php?page=results" method="POST">
        <!-- This is a button which is a image of a magniyining glass however it acts the same as any other submit button would-->
        <button class="searchbutton" type="submit" style="width:7%; float:right;" > <img src="images/search.png" alt="search" style="max-width: 140%;"></button>
        <input class="searchbox" style="float:right;" type="text" placeholder="Search.." name="search">
      </form>
    </div>
    <div class="row justify-content-end pt-2">
      <a href="index.php?page=addpost"><img class="img-fluid" style="width:15%; float: right;" src="images/add-file.png" alt="add-article"></a>
    </div>
    </div>
  </div>
  </div>

    <div class="row p-1" style="background-color:#ECECEC">
           <?php
          // This code checks what page is set and then includes the page to display in the shell
          // first check if the page has been set in the GET array
          if(isset($_GET['page'])) {
            $page = $_GET['page'];
          //If it has been set then we include it
            include("$page.php");
          } else {
            // load home page by default
            include("home.php");
          }

         ?>
       </div>
       <!-- This is the start of the footer, I have tried to assign it classes that should make it stick to the bottom of the page but this didn't end up woring -->
       <div class="sticky-footer navbar-fixed-bottom bg-white">
       <!-- The footer will be split into three columns-->
       <div class="row" style="border-top:solid; border-bottom:solid; border-color:grey;">
         <div class="col pt-2">
           <!-- This will display the latest fishing news-->
           <h5 >News:</h5>
           <h7>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean id leo in nunc auctor finibus. Proin tristique lobortis elit ut sollicitudin. Phasellus in felis in ipsum porttitor consequat a sed eros. Quisque sollicitudin, nibh sed cursus lacinia, orci arcu placera </h7>
         </div>
         <div class="col justify-contents-center">
           <!-- Here are all the social media links-->
           <div class="socialLinks" style="text-align:center; margin-top:11%;">
           <h5>Follow Us<img style="width:8%; margin-left: 10%;  align-self: left; display: inline-block;" src="images/facebook symbol.png" alt=""><img style="width:8%; align-self: left; display: inline-block;"src="images/twitter symbol.png" alt=""> <img style="width:8%; align-self: left; display: inline-block;" src="images/instagram-logo.png" alt=""></h5>
           <hr style="background-color:black; width:60%; margin-top:-1.5%;">
         </div>
         </div>
         <div class="col">
           <!-- Here is the legasea banner which I have chosen to advertise-->
           <img style="  display: block;  margin-left: auto;  margin-right: auto; margin-bottom: -1%; width: 100%; height: 98%;" src="images/legasea white.jpeg" alt="Lega Sea Logo">
         </div>
       </div>
     </div>
   </div>
  </div>
</body>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
