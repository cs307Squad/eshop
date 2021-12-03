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
<style>
  /*
  The grid itself needs only 4 CSS declarations:
*/

.myGallery {
  display: grid;
  grid-gap: 10px;
  grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
}

.myGallery img {
  width: 100%;
}

/*
  And here are some declarations for the image caption.
  Just hover over one of the last 5 images to see it.
*/

.myGallery .item {
  position: relative;
  overflow: hidden;
}

.myGallery .item img {
  vertical-align: middle;
}

p{
	background-color:#ffffff;
}

.myGallery .caption {
  margin: 0;
  padding: 1em;
  position: absolute;
  z-index: 1;
  bottom: 0;
  left: 0;
  width: 100%;
  max-height: 100%;
  overflow: auto;
  box-sizing: border-box;
  transition: transform 0.5s;
  transform: translateY(100%);
  background: rgba(0, 0, 0, 0.7);
  color: rgb(255, 255, 255);
}

a{
	text-decoration:none;
}

.myGallery .item:hover .caption {
  transform: translateY(0%);
}

/*
  The rest is only styling for this example page
*/

@import url('https://fonts.googleapis.com/css2?family=Vollkorn:wght@400;900&display=swap');

body {
  font: 400 1.5em/1.58 Vollkorn, serif;
}

h1,
p {
  text-align: center;
}

.myGallery {
  font-size: 1rem;
}


</style>
<body>

<h1>Products</h1><br/>

<div class='myGallery'>
";

$query = new ParseQuery("Inventory");
$query->limit(10000);
$results = $query->find();
//echo "Successfully retrieved " . count($results) . " products.";
// Do something with the returned ParseObject values
for ($i = 0; $i < count($results); $i++) {
  $object = $results[$i];
	$link = $object->get('variation_0_image');
	$file_link = $object->get('product_link');
//	echo $file_link."<br/>";	
$price = $object->get('raw_price');
echo "
  <div class='item'>
    <img src='$link' />
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


