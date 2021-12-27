<?php
require '../vendor/autoload.php';
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

//$servername = "34.71.136.78";
//$username = "root";
//$password = "JulianNagelsmann";

// Create connection
//$conn = new mysqli($servername, $username, $password,"tables");

// Check connection
//if ($conn->connect_error) {
//  die("Connection failed: " . $conn->connect_error);
//}
// echo "Connected successfully";

// This is if user accesses the register page through a method that is not the register button?
/*if(!isset($_POST["submit"])) {
    echo 'Incorrect Access Path';
}
*/
//generic php validation for password, truth tables for validation
/*	        “”	    “apple”	  NULL	FALSE	0	    undefined
empty()	    TRUE	FALSE	  TRUE	TRUE	TRUE	TRUE
is_null()	FALSE	FALSE	  TRUE	FALSE	FALSE	ERROR
isset()	    TRUE	TRUE	  FALSE	TRUE	TRUE	FALSE
*/

/*
SQL LOGINTABLE - "loginstuff"
name . varchar(255) . null.
password . varchar(255) . null
*/


if(isset($_POST['username']) && isset($_POST['password'])) {

    $username = validate_username($_POST['username']);
    $password = validate_password($_POST['password']);
    $userType = '';
}


if(empty($username)) {
    echo 'Username required';
}
if(empty($password)) {
    echo 'Password required';
}


echo "HI";
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
	//echo "Here";
    try{

        $user = ParseUser::logIn($username, $password);
        $selectOption = $_POST['roleOptions'];
/*        if ($selectOption === "2") {
            //header("Location:shopperpagel.php");
        }
        else {
           // header("Location:merchantpagel.php");
        }*/
    } catch (ParseException $error) {
        echo "incorrect password";
        // The login failed. Check error to see why.
    }
}


//$_SESSION["username"] = $username;
//$_SESSION["password"] = $password;

function validate_username($data){
    if (preg_match('/^[a-zA-Z0-9]+$/', $data) == 0) {
        exit('Username cannot contain special characters!');
    }
    return($data);
}
function validate_password($data){
    if (preg_match('/^[a-zA-Z0-9]+$/', $data) == 0) {
        exit('Enter Valid Password');
    }
    return($data);
}
