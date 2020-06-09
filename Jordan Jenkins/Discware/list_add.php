<?php
// starting the session
session_start();
// including the database variable
include("dbconnect.php");
// creating variables using the session array from the previous page
$list_name = $_SESSION['listing-listname'];
$list_creator = $_SESSION['listing-listcreator'];
$list_price = $_SESSION['listing-listprice'];
$list_dsc = $_SESSION['listing-listdsc'];
$list_cnd = $_SESSION['disc-cnd'];
$list_image = $_SESSION['listing-listimage'];
$list_cat = $_SESSION['disc-cat'];
$ses_userID = $_SESSION['userID'];
// creating the sql query
$new_list_sql = "INSERT INTO listing (listID, listName, listItemCreator, listPrice, userID, listDsc, listCnd, listImage, categoryID) VALUES (NULL, '$list_name', '$list_creator', '$list_price', '$ses_userID', '$list_dsc', '$list_cnd', '$list_image', '$list_cat')";
// connecting to and querying the database
mysqli_query($dbconnect, $new_list_sql);
// sending  the user to their profile page, where the new listing should appear under the "my listings" tab
header("Location:index.php?page=user");
?>