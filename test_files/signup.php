<?php 
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


if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $fullname = $_POST['uname']; 
	$username = $_POST['username'];
        $password = $_POST['password'];
	$role = "editor";

        $user = new ParseUser();
        $user->set("username", $username);
        $user->set("password", $password);
	$user->set("email", $email);
	$user->set("fullname", $fullname);
	$user->set("role", $role);



// Other fields can be set just like any other ParseObject,
// like this: $user->set("attribute", "its value");
// If this field does not exists, it will be automatically created
// other fields can be set just like with ParseObject

        try {
          $user->signUp();
	 header("Location:index.html");
  // Hooray! Let them use the app now.
        } catch (ParseException $ex) {
  // Show the error message somewhere and let the user try again.
          echo "Error: " . $ex->getCode() . " " . $ex->getMessage();
        }
}

?>
