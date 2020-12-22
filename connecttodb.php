<?php
$dbhost = "localhost:3306";
$dbuser= "root";
$dbpass = "level1";
$dbname = "abroekhuassign3db";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (mysqli_connect_errno()) {
     die("Database connection failed :" .
     mysqli_connect_error() . " (" . mysqli_connect_errno() . ")"  );
    } //end of if statement
?>
