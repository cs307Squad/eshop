<?php
//shell_exec("sudo mkdir test");
//include ("parse_connect.php");
require 'vendor/autoload.php';
//$app_id=“KSDJFKASJFI3S8DSJFDH”;
//$master_key = “LASDK823JKHR87SDFJSDHF8DFHASFDF”;
//$rest_key = “abcdefghiklmnopqrstuvwxyz”;


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


$query = new ParseQuery("History");
$query->limit(100);
$results = $query->find();

for($i = 0; $i < count($results); $i++){
	$object = $results[$i];
	$id = $object->get("PurchaseID");
	echo $object->get("PurchaseID");
	$new_query = new ParseQuery("Inventory");
	try{
		$purchased_object = $new_query->get($id);
		echo $purchased_object->get("name");
	}catch (ParseException $ex) {
  // The object was not retrieved successfully.
  // error is a ParseException with an error code and message.
		echo "Something went wrong<br/>";
	}
}

?>
