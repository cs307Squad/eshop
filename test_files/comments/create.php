<?php

//shell_exec("sudo mkdir test");
//include ("parse_connect.php");
require '../vendor/autoload.php';
//$app_id=“KSDJFKASJFI3S8DSJFDH”;
//$master_key = “LASDK823JKHR87SDFJSDHF8DFHASFDF”;
//$rest_key = “abcdefghiklmnopqrstuvwxyz”;


/*

UserComments
- username
- log
- comments
*/

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

for($i = 1; $i < 4; $i++){

	for($j = 0; $j < 3; $j++){

		$gameScore = new ParseObject("UserLogs");

		$gameScore->set("username", "user".$i);
		$gameScore->set("log","Replaced old values");
		$gameScore->set("comments","");

		try {
		  $gameScore->save();
		  echo 'New object created with objectId: ' . $gameScore->getObjectId();
		} catch (ParseException $ex) {  
		  // Execute any logic that should take place if the save fails.
		  // error is a ParseException object with an error code and message.
		  echo 'Failed to create new object, with error message: ' . $ex->getMessage();
		}

	}

}


?>
