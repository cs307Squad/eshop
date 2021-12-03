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

if(isset($_POST['submit'])){
	echo "HI";
	$suggestion = new ParseObject("Suggestions");
	$user_suggestion = $_POST['suggestion'];
	$title = $_POST['title'];
	$file = $_POST['file'];
	//$suggestion->set("title", $title);
	$suggestion->set("text", $user_suggestion);
	$suggestion->set("file",$file);
 
	try {
 	 	$suggestion->save();
  		echo 'New object created with objectId: ' . $suggestion->getObjectId();
		header("Location:view.php");
	} catch (ParseException $ex) {  
 	 echo 'Failed to create new object, with error message: ' . $ex->getMessage();
	}
}

?>
