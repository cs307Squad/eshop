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
html,
body {
  margin: 0;
  background:#fafafa;
  z-index:-1;
  position:relative;
}
.all {
  
}

.shadow-1:before {
  content: '';
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  width: inherit;
  height: inherit;
  z-index: -2;
  box-sizing: border-box;
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.13);
}

.shadow-1:after {
  content:'';
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  width: inherit;
  height: inherit;
  z-index: -2;
  box-sizing: border-box;
  box-shadow: 0 2px 10px 0 rgba(0, 0, 0, 0.08);
}

.shadow-2:before {
  content: '';
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  width: inherit;
  height: inherit;
  z-index: -2;
  box-sizing: border-box;
  box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.1);
}

.shadow-2:after {
  content: '';
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  width: inherit;
  height: inherit;
  z-index: -2;
  box-sizing: border-box;
  box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.1);
}

.shadow-3:before {
  content: '';
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  width: inherit;
  height: inherit;
  z-index: -2;
  box-sizing: border-box;
  box-shadow: 0 12px 15px 0 rgba(0, 0, 0, 0.12);
}

.shadow-3:after {
  content: '';
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  width: inherit;
  height: inherit;
  z-index: -2;
  box-sizing: border-box;
  box-shadow: 0 17px 50px 0 rgba(0, 0, 0, 0.1);
}

.shadow-4:before {
  content: '';
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  width: inherit;
  height: inherit;
  z-index: -2;
  box-sizing: border-box;
  box-shadow: 0 16px 28px 0 rgba(0, 0, 0, 0.11);
}

.shadow-4:after {
  content: '';
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  width: inherit;
  height: inherit;
  z-index: -2;
  box-sizing: border-box;
  box-shadow: 0 25px 55px 0 rgba(0, 0, 0, 0.11);
}

.shadow-5:before {
  content: '';
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  width: inherit;
  height: inherit;
  z-index: -2;
  box-sizing: border-box;
  box-shadow: 0 27px 24px 0 rgba(0, 0, 0, 0.1);
}

.shadow-5:after {
  content: '';
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  width: inherit;
  height: inherit;
  z-index: -2;
  box-sizing: border-box;
  box-shadow: 0 40px 77px 0 rgba(0, 0, 0, 0.11);
}

.card {
  position: relative;
  height: 450px;
  background: #fcfcfc;
  margin: 20px 40px;
  transition: 0.4s all;
}

.card.open {
  height: 200px;
  background: #ffffff;
}

@media only screen and (min-width: 600px) {
  .card {
  width:600px;
    margin-top:20px;
    margin-bottom:20px;
    margin-left:auto;
    margin-right:auto;
  }
}

@media only screen and (max-device-width: 800px) and (orientation: portrait) {
  .card {
    margin: 12px 10px;
  }
}

</style>

<script>

$('.card').on('click', function() {
    if ($(this).hasClass('open')) {
      $('.card').removeClass('open');
      $('.card').removeClass('shadow-2');
      $(this).addClass('shadow-1');
      return false;
    } else {
      $('.card').removeClass('open');
      $('.card').removeClass('shadow-2');
      $(this).addClass('open');
      $(this).addClass('shadow-2');
    }
  });

</script>
<body>

<h1>Products</h1><br/>

<div class=\"all\">
  <div class=\"cards\">
";

$query = new ParseQuery("Inventory");
$query->limit(100);
$results = $query->find();
//echo "Successfully retrieved " . count($results) . " products.";
// Do something with the returned ParseObject values
for ($i = 0; $i < count($results); $i++) {
if($i > 4){
  $object = $results[$i];
	$link = $object->get('variation_0_image');
	$file_link = $object->get('product_link');
    $name = $object->get('name');
//	echo $file_link."<br/>";	
$price = $object->get('raw_price');
echo "
<center>
<div class='card shadow-1'>
    <a href='$file_link'><h4>$name</h4></a>    
    <img src='$link' /><br/>
    <h4>$ ".$price."</h4>
</div>
</center>
";




//	echo $link."<br/>";
	//echo "<img src='$link' alt='Girl in a jacket' width='500' height='600'><br/>";


}
}


echo "
</div>


</body>
</html>
";
?>
