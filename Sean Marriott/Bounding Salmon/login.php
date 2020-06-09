<!--This is the login in page, here the user will be able to log into the website, register accounts, logout, see posts they have made, edit and delete posts they have made-->
  <form method="post" class="col" action="loginsubmit.php">
    <?php
    //We have to include the post.inc.php page because some functions used on this page are defined there
    include('post.inc.php') ;
    //Here we are checking that the user is logged in
    if (isset($_SESSION['userID'])) {
      // code...
      //If the user is logged in then we will display the logout button
      //Here we are setting the variable userID equal to the userID set in the session when the user logged in
      $userID = $_SESSION['userID'];
      //Here we are querying the posts group and returning some information about the posts that were created by them
      $posts_sql="SELECT postID, title, date, postContents from posts WHERE userID=$userID ";
      $posts_qry=mysqli_query($dbconnect, $posts_sql);
      $posts_aa=mysqli_fetch_assoc($posts_qry);
      ?>
      <div class="row pb-5 mb-4">
        <div class="col-6 p-4">
          <div class="col p-5">
            <div class="row pl-4">
              <h3>Welcome <?php echo $_SESSION['username'];?></h3>
            </div>
            <div class="row pl-4 mb-2">
              <h4 style="text-decoration:underline;">My Posts</h4>
            </div>
            <?php
            //Here we are setting up a do while loop
            if (mysqli_num_rows($posts_qry)>0) {
              // code...
              do {
                // code...
                //We are setting up some variables about from the results of the posts query to use later
                $title=$posts_aa['title'];
                $date = $posts_aa['date'];
                $postID = $posts_aa['postID'];
                $postContents = $posts_aa['postContents'];
                ?>

                <div class='row mb-4'>
                  <div class="col">
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <div class="col-8">
                            <?php echo "<h4>$title</h4>";?>
                          </div>
                          <div class="col-4">
                            <div class="row justify-content-end">
                              <?php echo "<h6>$date</h6>"; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card-body p-0">
                        <div class="blockquote pl-2">
                          <?php echo "<h5>$postContents</h5>"; ?>
                        </div>
                        </div>
                        <div class="row">
                          <div class="col-6">

                          </div>
                          <div class="col-6">
                            <div class="row">
                              <div class="col">
                                <a class="nostyle" href="index.php?page=editpost&postID=<?php echo $postID;  ?>"><button type="button" name="edit-post" class="btn btn-primary btn-block">Edit</button></a>
                              </div>
                              <div class="col">
                                  <a class="nostyle" href="index.php?page=deletepost&postID=<?php echo $postID; ?>"><button type='button' name='deletepost-submit' class='btn btn-danger btn-block'>Delete</button></a>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
                <?php
              } while ($posts_aa = mysqli_fetch_assoc($posts_qry));


            }


             ?>
          </div>

        </div>
        <div class="col-6 p-4">
          <div class="col p-5 pb-5 border-left border-dark">
            <h5>Would you like to log out?</h5>
            <div class="mb-5 mt-3 pb-5">
              <a href='logout.php' class='btn-lg btn-primary' role='button' style="text-decoration:none;">Log out</a>
            </div>
          </div>
        </div>
      </div>
      <?php
    }
    else {
      //Here we are checking to see if any errors have been included in header as as a result of the user being sent back to this page
      if (isset($_GET['error'])) {
        // code...
        //Here are the multiple error handling messages that are displayed as a result of the error sent through the header
        if ($_GET['error'] == "emptyfields") {
          // code...
          echo "<h3 class='row text-danger m-2 ml-5 font-weight-bold'>Fill in all fields!</h3>";
        }
        elseif ($_GET['error'] == "sqlerror") {
          // code...
          echo "<h3 class='row text-danger m-2 ml-5 font-weight-bold'>Stop trying to hack me!</h3>";
        }
        elseif ($_GET['error'] == "wrongpassword") {
          // code...
          echo "<h3 class='row text-danger m-2 ml-5 font-weight-bold'>Wrong password!</h3>";
        }
        elseif ($_GET['error'] == "nouser") {
          // code...
          echo "<h3 class='row text-danger m-2 ml-5 font-weight-bold'>No user found matching username and password!</h3>";
        }

      }


     ?>

    <div class="row pb-5">
      <div class="col-6 p-4">
        <div class="col p-5">
          <h3>Log In</h3>
          <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="username" placeholder="Username">
          </div>
          <div class="form-row">
            <div class="form-group col-md">
              <label>Password</label>
              <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            </div>
            <div class="form-row">
              <div class="form-group col">
                <button type="submit" name="login-submit" class="btn-lg btn-primary">Sign In</button>
              </div>
            </div>
        </div>
      </div>
      <div class="col-6 p-4">
        <div class="col p-5 border-left border-dark">
          <h5>Create An Account</h5>
          <p>It's easy, free and only takes a moment</p>
          <div class="mb-3">
            <a href='index.php?page=signup' class='btn-lg btn-primary' role='button' style="text-decoration:none;">Sign Up</a>
          </div>
          <h5>Creating an account enables you to:</h5>
          <div style="margin-left:-2.8%;">
            <ul>
              <li>Create posts</li>
              <li>Make new groups</li>
              <li>Comment on posts</li>
              <li>Follow Groups</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </form>
<?php }  ?>
