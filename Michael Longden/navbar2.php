<?php include("databaseconnect.php");//This includes the database connect page to navbar 2.
$level_sql="SELECT * FROM levels";//This is the select query used to display all the levels that the user can click on.
$level_qry = mysqli_query($databaseconnect, $level_sql);//This is the query that is run.
$level_aa = mysqli_fetch_assoc($level_qry);?><!--This fetches all levels from the level database.-->
<nav class="navbar navbar-expand-lg mynavbar"><!--This begins the navbar section.-->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button><!--Each link will be displayed as a button for the user to click on.-->
  <div class="collapse navbar-collapse" id="navbarNavDropdown"><!--The navbar div begins here.-->
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="personalindex.php?page=gethelp2">Get Help <span class="sr-only">(current)</span></a><!--This is the link to the get help 2 page.-->
      </li>
      <li class="nav-item">
        <a class="nav-link" href="personalindex.php?page=about">About</a><!--This is the link to the about page.-->
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Log Out</a><!--This is the link to the logout page.-->
      </li>
      <?php
      do {
      ?>
      <li class="nav-item dropdown"><!--The dropdown list begins here.-->
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><!--This link goes to diffrent level links that are selected using php.-->
          <?php echo $level_aa['level'];//This displays the name of each level.
          $levelid=$level_aa['levelid'];//This adds the levelid to the level_aa.
          $standard_sql="SELECT * FROM standard WHERE levelid=$levelid";//This is the select query used to select all standards that are part of the level the user clicked on.

          $standard_qry=mysqli_query($databaseconnect, $standard_sql);//This is the query that is run.
          $standard_aa=mysqli_fetch_assoc($standard_qry);//This fetches any matched results from the user database.
          $standard=$standard_aa['standard'];//This adds the standard name to the standard_aa.
          $code = $standard_aa['code'];//This adds the standard code to the standard_aa.
          $credits = $standard_aa['credits'];//This adds the credit number of the standard to the standard_aa.
          $assessment = $standard_aa['assessment'];//This adds the assessment details of the standard to the standard_aa.
         ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink"><!--The navbar dropdown div begins here.-->
          <?php do {
              $standardid=$standard_aa['standardid'];//This adds the standardid to the standard_aa.
             ?>
          <a class="dropdown-item" href="personalindex.php?page=lessons&standardid=<?php echo $standardid; ?>"><?php echo $standard_aa['standard']; ?></a><!--This displays the dropdown of standards from the level that the user clicked on.-->
        <?php } while ($standard_aa=mysqli_fetch_assoc($standard_qry)) ?><!--The do while loop is there, so that all standards of the level the user clicks on, are displayed in the specific level dropdown.-->
      </div><!--The navbar dropdown div ends here-->
    </li><!--The dropdown list ends here.-->
  <?php } while ($level_aa = mysqli_fetch_assoc($level_qry)) ?><!--The do while loop is there, so that all levels are displayed on the user's personal index page.-->
</ul><!--The dropdown list ends here.-->
<div class="search"><!--The search div begins here.-->
  <form action="personalindex.php?page=search" method="post" id = "searchform"><!--The form section is for receiving all the search results.-->
  <input type="text" name="search" placeholder = "Search"><!--The input determines what the search bar will look like.-->
  <button type="submit" name="button"form = "searchform"><i class = "fas fa-search"></i>Search</button><!--This button is for the user to click on to start searching.-->
</form><!--The form section ends here.-->
</div><!--The search div ends here.-->
</div><!--The navbar div ends here.-->
</nav><!--The navbar section ends here.-->
