<?php
//This is the search inclusion page, it has all of the functions used in the search page
//This function takes in string and a set length
function custom_echo($x, $length){
  //If the length of the string is less than the length set then the function echos out the string
  if (strlen($x)<=$length) {
    // code...
    echo "<p class='search-content-p'>$x<p>";
  }
  // If not then the string is shortened down to the set length and then echoed out
  else {
    $y=substr($x,0,$length) . '...';
    echo "<p class='search-content-p'>$y<p>";
  }
}

//This is the getsearch function, it gets all the results which are like the search query
//We need to pas through the $dbconnect variable so that the user can query the database
function getSearch($dbconnect){
  //First we check if the user has actually searched for something
  if (isset($_POST['search'])) {
    // code...
    // First we make sure that the search is not some mysqli injection that may harm the database
    $search = mysqli_real_escape_string($dbconnect, $_POST['search']);
    //Next we set up a query for all results that are like that of the search
    $sql = "SELECT posts.*, users.userName FROM posts JOIN users ON posts.userID = users.userID WHERE title LIKE '%$search%' OR postContents LIKE '%$search%' OR date LIKE '%$search%'";
    //Next we query the database and store the result
    $result = mysqli_query($dbconnect, $sql);
    //We store the number of results as $queryResult
    $queryResult = mysqli_num_rows($result);

    ?>
        <div class="col">
          <div class = 'row pt-5 pr-5 pl-5  ml-5 mr-5 mb-5'>
            <div class="col border-bottom border-dark">
              <h2>There are <?php echo $queryResult; ?> results!</h3>
            </div>
            <div class="col">

            </div>
            <div class="col">

            </div>
            </div>


    <?php

      if ($queryResult > 0){
        //If the number of results are greater than zero then we execute this code which displays the results
        while ($row = mysqli_fetch_assoc($result)) {
          // code...
          $postID = $row['postID'];
          ?>
          <a class="nostyle" href="index.php?page=post&postID=<?php echo $postID ?>">
          <div class="row pl-5 ml-5 pb-4">
          <div class="card mb-3" style="max-width: 700px; max-height: 300px;">
            <div class="row no-gutters">
              <div class="col-md-4">
                <img src="images/<?php echo $row['postImage']; ?>" class="card-img" height="290" alt="...">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $row['title']; ?></h5>
                  <p class="card-text"><?php echo $row['postContents']; ?></p>
                  <p class="card-text"><small class="text-muted"><?php echo $row['date']; ?></small></p>
                </div>
              </div>
            </div>
          </div>
            </div></a>
          </div>
<?php
        }
      }

  }else {
    // code...
    //else we send them back to the index page
    header("Location: index.php");
  }
}

 ?>
