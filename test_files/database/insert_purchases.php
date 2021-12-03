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

// create a history object for the table

$query = new ParseQuery("Inventory");
$query->limit(2000);
$results = $query->find();
echo "Successfully retrieved " . count($results) . " products.";
// Do something with the returned ParseObject values
/*for ($i = 0; $i < count($results); $i++) {
  $object = $results[$i];
        $link = $object->get('variation_0_image');
//      echo $link."<br/>";
        echo "<img src='$link' alt='Girl in a jacket' width='500' height='600'><br/>";

}
*/

for($i = 0; $i < 10; $i++){

	for($j = 0; $j < 100; $j++){
		$item_index = rand(0, 1000);
		$object = $results[$item_index];
		$object_id = $object->getObjectId();
		$category = $object->get('subcategory');
		$history = new ParseObject("History");
		$history->set('ObjectLink', $object_id);
		$history->set('Category', $category);
		$history->set('User', "user".$i);

		try{
			$history->save();
			echo "Successfully saved ".$history->getObjectId()."<br/>";
		}catch (ParseException $ex){
			echo 'Failed to create new object: '.$ex->getMessage();
		}
		
	}




}



?>
