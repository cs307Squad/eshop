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

$query = "select Name, Rating from Product";
$result1 = mysqli_query($conn, $query);

$query = "select Name, Number_Rating from Product";
$result2 = mysqli_query($conn, $query);

$row_data = array();

# $array = Array ( 
  # 0 => Array ( "product_id" => 33 , "amount" => 1 ) ,
  # 1 => Array ( "product_id" => 34  , "amount" => 3 ) ,
  # 2 => Array ( "product_id" => 10  , "amount" => 1 ) );

# echo "<pre>";
# echo "Product ID\tAmount";




# while($row = mysqli_fetch_array($result2)) {
  # $row_data[] = array('Name' => $row['Name'], 'Number_Rating' => $row['Number_Rating']);
# }

# foreach ($row_data as $var ) {
  # echo "\n", $var['Name'], "\t\t", $var['Number_Rating'];
# }



 // start a table tag in the HTML



 //Close the table in HTML


 

if(isset($_POST['button1'])) { 
  // start a table tag in the HTML

   // Print a single column data

   $row_data = array();

   while($row = mysqli_fetch_array($result1)) {
     $row_data[] = array('Name' => $row['Name'], 'Rating' => $row['Rating']);
   }

   $row_data2 = array();

  foreach ($row_data as $var ) {

    $beforeDot = floatval(array_shift(explode(' ', $var["Rating"])));
    $row_data2[] = array('Name' => $var['Name'], 'Rating' => $beforeDot);
  }





   array_multisort( array_column($row_data2, "Rating"), SORT_DESC, $row_data2);
   
   $limit = 0;

   echo "<table>";
   foreach ($row_data2 as $var ) {
     echo "<tr><td>" . $var['Name'] . "</td><td>" . $var['Rating'] . "</td></tr>";  
     $limit = $limit + 1;
     if ($limit == 11) {
       break;
     }

   }
   echo "</table>";



//Close the table in HTML


   
} 


if(isset($_POST['button2'])) { 

// start a table tag in the HTML

   // Print a single column data

   $row_data = array();

   while($row = mysqli_fetch_array($result2)) {
     $row_data[] = array('Name' => $row['Name'], 'Number_Rating' => $row['Number_Rating']);
   }

   $row_data2 = array();

  foreach ($row_data as $var ) {
    
    $beforeDot = (int)$var["Number_Rating"];

    $row_data2[] = array('Name' => $var['Name'], 'Number_Rating' => $beforeDot);

  }





   array_multisort( array_column($row_data2, "Number_Rating"), SORT_DESC, $row_data2);
   
   $limit = 0;

   echo "<table>";
   foreach ($row_data2 as $var ) {
     echo "<tr><td>" . $var['Name'] . "</td><td>" . $var['Number_Rating'] . "</td></tr>";  
     $limit = $limit + 1;
     if ($limit == 11) {
       break;
     }

   }
   echo "</table>";


} 



?>


<form method="post"> 
		<input type="submit" name="button1"
				value="Sort by rating"/> 
		
		<input type="submit" name="button2"
				value="Sort by popularity"/> 
	</form>



</body>




</html>