<html>

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


$query = "select template_Name, number_Of_Users, category from TemplateData3";
$result = mysqli_query($conn, $query);

$row_data = array();


while($row = mysqli_fetch_array($result)) {
    # echo $row['category'] . $row['number_Of_Users'];
    $row_data[] = array('Name' => $row['template_Name'], 'Number' => $row['number_Of_Users'], 'category' => $row['category']);

  }



$row_data2 = array();

foreach ($row_data as $var ) {

   
    if (isset($row_data2[$var['category']])) {
        $past = $row_data2[$var['category']];
        $past[] = array('Name' => $var['Name'], 'Number' => $var['Number']);
        $row_data2[$var['category']] = $past;
        

    } else {
        $current = array();
        $current[] = array('Name' => $var['Name'], 'Number' => $var['Number']);

        $row_data2[$var['category']] = $current;


    }
}



# foreach($row_data2 as $key => $value) {
    # foreach($value as $instance) {
        # echo $instance;


    # }
  # }


$sorted_array = array();


foreach($row_data2 as $key => $value) {

    array_multisort( array_column($value, "Number"), SORT_DESC, $value);
    $row_data2[$key] = $value;
    
  }

  





$answer = $_POST['category'];  

if ($answer == "Traditional") {  
    $values = $row_data2[$answer];
    echo "<table>";
    echo "<th>" . "<tr><td>" . 'Template Names' . "</td><td>" . 'Popularity' . "</td></tr>" . "</th>";
    foreach ($values as $var ) {
      echo "<tr><td>" . $var['Name'] . "</td><td>" . $var['Number'] . "</td></tr>";  
    }
    echo "</table>";        
       
} elseif ($answer == "App") {
    $values = $row_data2[$answer];
    echo "<table>";
    echo "<th>" . "<tr><td>" . 'Template Names' . "</td><td>" . 'Popularity' . "</td></tr>" . "</th>";
    foreach ($values as $var ) {
      echo "<tr><td>" . $var['Name'] . "</td><td>" . $var['Number'] . "</td></tr>";  
    }
    echo "</table>"; 
     
    
} elseif ($answer == "Clothing") {
    $values = $row_data2[$answer];
    echo "<table>";
    echo "<th>" . "<tr><td>" . 'Template Names' . "</td><td>" . 'Popularity' . "</td></tr>" . "</th>";
    foreach ($values as $var ) {
      echo "<tr><td>" . $var['Name'] . "</td><td>" . $var['Number'] . "</td></tr>";  
    }
    echo "</table>"; 
    
}















# array_multisort( array_column($row_data2, "Rating"), SORT_DESC, $row_data2);
### row_data: [array('cafe', 120, 'forever'), array(')]

$conn->close();


?>

<form method="post">
  <h1>What will your website be about?</h1>
  <input type="radio" id="traditional" name="category" value="Traditional">
  <label for="traditional">Traditional</label><br>
  <input type="radio" id="app" name="category" value="App">
  <label for="app">App</label><br>
  <input type="radio" id="clothing" name="category" value="Clothing">
  <label for="clothing">Clothing</label><br>
  <input type="submit" value="submit" />
</form>



</body>




</html>