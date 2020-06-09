<nav class="navbar navbar-dark navbar-expand-xl sticky-top custom-nav navbar-expand-md">
  <a class="" href="index.php?page=home"><h1>SMALL TECH</h1></a>
  <div>
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a  href="index.php?page=article">
          <h2>NEWS</h2>
        </a>
      </li>
      <li class="nav-item btn-group">
        <a  href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <h2>FORUM</h2>
        </a>
        <div class="dropdown-menu align-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href=""><h3>GAMES</h3></a>
          <a class="dropdown-item" href=""><h3>SOFTWARE</h3></a>
          <a class="dropdown-item" href=""><h3>HARDWARE</h3></a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href=""><h3>SUPPORT</h3></a>
        </div>
      </li>
    </ul>
  </div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="nav navbar-nav ml-auto">
      <div class="input-group">
        <li class="nav-item">
          <a class="btn nav-link" href="index.php?page=signup">Sign up</a>
        </li>
        <li class="nav-item">
          <form name="search" method="post" action="index.php?page=searchresults">
            <input name="search" class="form-control search" type="text" size="20" placeholder="SEARCH" aria-label="Search">
          </form>
        </li>
      </div>
    </ul>
  </div>
</nav>
<?php 
