<head>
</head>
<body>
<?php
$servername = "34.71.136.78";
$username = "root";
$password = "JulianNagelsmann";

// Create connection
$conn = new mysqli($servername, $username, $password,"eshop");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} else {
  echo "Connected successfully";
}

$sql = "CREATE TABLE TemplateData3(
    template_Name VARCHAR(30),
    number_Of_Users INT(6),
    category VARCHAR(30)
    )";

if(mysqli_query($conn, $sql)){
    echo "Table created successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
 
$conn->close();





?>
</body>