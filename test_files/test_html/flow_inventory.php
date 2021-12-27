<?php

require '../vendor/autoload.php';
//$app_id=“KSDJFKASJFI3S8DSJFDH”;
//$master_key = “LASDK823JKHR87SDFJSDHF8DFHASFDF”;
//$rest_key = “abcdefghiklmnopqrstuvwxyz”;

session_start();

use Parse\ParseClient;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseACL;
use Parse\ParsePush;
use Parse\ParseUser;
use Parse\ParseInstallation;
use Parse\ParseException;
use Parse\ParseAnalytics;
use Parse\ParseFile;
use Parse\ParseCloud;

ParseClient::initialize( "KSDJFKASJFI3S8DSJFDH",null, "LASDK823JKHR87SDFJSDHF8DFHASFDF");
ParseClient::setServerURL("http://localhost:1337/parse", '/');

echo "
<!DOCTYPE html>
<html>
<head>
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
<style>
* {
    box-sizing: border-box;
  }
  
  body {
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
  }
  
  .header {
    text-align: center;
    padding: 32px;
  }
  
  .row {
    display: -ms-flexbox; /* IE 10 */
    display: flex;
    -ms-flex-wrap: wrap; /* IE 10 */
    flex-wrap: wrap;
    padding: 0 4px;
  }
  
  /* Create two equal columns that sits next to each other */
  .column {
    -ms-flex: 50%; /* IE 10 */
    flex: 50%;
    padding: 0 4px;
  }
  
  .column img {
    margin-top: 8px;
    vertical-align: middle;
  }
  
  /* Style the buttons */
  .btn {
    border: none;
    outline: none;
    padding: 10px 16px;
    background-color: #f1f1f1;
    cursor: pointer;
    font-size: 18px;
  }
  
  .btn:hover {
    background-color: #ddd;
  }
  
  .btn.active {
    background-color: #666;
    color: white;
  }

</style>

<script>
// Get the elements with class=\"column\"
var elements = document.getElementsByClassName(\"column\");

var i;

// Full-width images
function one() {
  for (i = 0; i < elements.length; i++) {
    elements[i].style.flex = \"100%\";
  }
}

// Two images side by side
function two() {
  for (i = 0; i < elements.length; i++) {
    elements[i].style.flex = \"50%\";
  }
}

// Four images side by side
function four() {
  for (i = 0; i < elements.length; i++) {
    elements[i].style.flex = \"25%\";
  }
}
</script>

</script>

<body>
<div class='header' id='myHeader'>
<h1>Products</h1><br/>
  <p>Click on the buttons to change the product view.</p>
  <button class='btn' onclick='one()'>1</button>
  <button class='btn active' onclick='two()'>2</button>
  <button class='btn' onclick='four()'>4</button>
</div>

<div class=\"row\">
  <div class=\"column\">
";

$query = new ParseQuery("Inventory");
$query->limit(100);
$results = $query->find();
//echo "Successfully retrieved " . count($results) . " products.";
// Do something with the returned ParseObject values
for ($i = 0; $i < count($results); $i++) {
  $object = $results[$i];
	$link = $object->get('variation_0_image');
	$file_link = $object->get('product_link');
    $name = $object->get('name');
//	echo $file_link."<br/>";	
    $price = $object->get('raw_price');

    if($i % 25 == 0 && i > 0){
        echo"
        </div>
        <div class=\"column\">";
    }
    echo "

    <div class='card shadow-1'>
        <img src='$link'style='width:100%' />
        <span class='caption'><a href='$file_link'><p>$ ".$price."</p></a></span>
    </div>
    ";
    




//	echo $link."<br/>";
	//echo "<img src='$link' alt='Girl in a jacket' width='500' height='600'><br/>";

}


echo "
</div>


</body>
</html>
";
?>
