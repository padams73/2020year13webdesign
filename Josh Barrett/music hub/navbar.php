<!--this is my nav bar bellow it is showing the back ground colour and the image(logo) and is setting it as a link and it also-->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#808080;">
  <a class="navbar-brand" href="index.php?page=home"><img src="logo1.png" alt="logo" width=150 hight=50 class=rounded.corners> </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!--making the nav bar colsible and also setting the links for the nav bar -->

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=home">Home</a>
      </li>
      <?php
      //making it so it you can only access the libary page when youe loged in
      if (isset($_SESSION['admin'])) { ?>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=library">Library</a>
          </li>

      <?php }

       ?>
       <?php
       //making it so it you can only access the upload page when youe loged in
       if (isset($_SESSION['admin'])) { ?>
         <li class="nav-item">
           <a class="nav-link" href="index.php?page=addsong">upload</a>
           </li>

       <?php }

        ?>

        <?php
        //making it so it you can only access the likes page when youe loged in
        if (isset($_SESSION['admin'])) { ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=likes">likes</a>
            </li>
        <?php }

         ?>


    </ul>
    <li class="nav-item" style="list-style: none;">
      <?php
      //makes it so when your not loged in it says login and when your loged in it says log out
      if (!isset($_SESSION['admin'])) { ?>
        <a class="nav-link" style=" display: inline-block; text-decoration:none; " href="index.php?page=login">login</a>
      <?php } else { ?>
        <a class="nav-link" style=" display: inline-block; text-decoration:none; " href="logout.php">logout</a>
        <?php
      }

       ?>

    </li>

  </div>
</nav>
