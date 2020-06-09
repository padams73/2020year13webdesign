<?php
//This is the results page in which we display the results
//We need to include the search.inc.php page which is where the getSearch function is defined
include('search.inc.php');
//Here we are calling the getSearch function with the $dbconnect variable passed through so that the function can access the database
getSearch($dbconnect);
?>
