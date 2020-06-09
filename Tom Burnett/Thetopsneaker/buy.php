


<?php
$userid = $_SESSION['userid'];
$check_sql = "SELECT * FROM cart WHERE userid = $userid ";
$check_qry = mysqli_query($dbconnect, $check_sql);

if (mysqli_num_rows($check_qry)==0) {
  // redirecting the users to index.php if they enter a invaild field
  header("Location:index.php");
} else {

$cart_sql = "DELETE FROM cart WHERE userid = $userid  ";
// delete query to remove everything from their cart once they have purchased what they had in their cart
$cart_qry = mysqli_query($dbconnect, $cart_sql);


 }  if(!isset($_SESSION['loggedin'])) {
   // if the session is not set (the user is not logged in) They will be set to the login page.
      header("Location: index.php?page=login");


    } else {
      $userid = $_SESSION['loggedin'];
      // if the session is set they will be told that they have bought what they had in their cart

    ?>
    <h2 class="login_details">Cart Purchased</h2>
    <!-- displaying a message saying the user has purchased their cart -->
<?php
}
 ?>
