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

$templateNameArray = array('Cafe', 'Complex', 'Eshopper', 'Energy', 'Factory', 'Savory', 'Ustora', 'Mountain', 'Pure', 'Universe');
$categoryArray = array('Traditional', 'Traditional', 'Traditional', 'App', 'App', 'App', 'App', 'Clothing', 'Clothing', 'Clothing');

foreach(array_combine($templateNameArray, $categoryArray) as $d1 => $d2) {
    $randint = rand(100,200);
    echo $randint;
    echo $d1;
    echo $d2;
    $sql2 = "INSERT INTO TemplateData3 (template_Name, number_Of_Users, category)
VALUES ('$d1', $randint, '$d2')";
   
}



$conn->close();

?>