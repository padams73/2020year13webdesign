<!-- this is the site navbar -->
<!-- the navbar offers links to the three main areas of the page -->

<nav class="navbar navbar-expand-lg navbar-dark main-colour sticky-top">
  <a class="navbar-brand" href="index.php"><img class="logo" src="images/logo.png" alt="Portadown Logo"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Irrigation</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Paddocks</a>
      </li>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="stock.php" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Stock
        </a>
        <!-- this drop down allows the user to access important parts of the stock area quicker -->
        <!-- though it only has one option at the moment, in future it will have forms included to go directly to data entry pages -->
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="stock.php">Overview</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
