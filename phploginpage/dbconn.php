<?php

/* Creating a connection to the tables instance, logininfo database. The tables were populated through the Google Cloud Shell 
   Command to access: gcloud sql connect tables --user=root
   Password: in discord
*/

$servername = "34.71.136.78";
$username = "root";
$password = "JulianNagelsmann";

// Create connection
$conn = new mysqli($servername, $username, $password,"tables");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
 echo "Connected successfully";
 
 
?>

