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

if(isset($_POST['submit'])){

	if($_POST['destination'] == 1){
		$query = new ParseQuery("Inventory");
		$query->equalTo("objectId", "mLQ1TOErqz");
		$query->limit(1000);
		$results = $query->find();
		if(count($results) != 0){
			echo "not found";
		}else{
			$new_inventory = new ParseObject("Inventory_new");
			$copy = new ParseObject('MyClass');
			$object = $results[0];
// get all key/value pairs for your original object
			$data = $object->getAllKeys();

			foreach($data as $key => $value) {
			    $new_inventory->set($key, $value);
			}

			try {
 			 $new_inventory->save();
			  //echo 'New object created with objectId: ' . $gameScore->getObjectId();
				header("Location:create-checkout-session1.php");
			} catch (ParseException $ex) {  
  // Execute any logic 	that should take place if the save fails.
  // error is a ParseException object with an error code and message.
			  echo 'Failed to create new object, with error message: ' . $ex->getMessage();
			}
		}

	}else{
				header("Location:create-checkout-session1.php");

	}
}

?>
