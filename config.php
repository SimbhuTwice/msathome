<?php
$servername = "carnation.vkmsoftware.com";
$username = "icand_icand";
$password = "Icand@123";
$database ="icand_msathome";
// Create connection
$conn = mysqli_connect($servername, $username, $password,$database);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
?>