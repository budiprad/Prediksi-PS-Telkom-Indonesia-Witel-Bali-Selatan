<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "telkom";
 
 // Create connection
$con=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>