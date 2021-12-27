<?php

//shell_exec("sudo mkdir test");
//include ("parse_connect.php");
require '../../vendor/autoload.php';
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

$method= new ParseObject("PaymentMethods");
$method->set("name", "Crypto");
$method->set("status", "Active");
$method->save();

$method2= new ParseObject("PaymentMethods");
$method2->set("name", "Credit/Debit Card");
$method2->set("status", "Active");
$method2->save();

$method3= new ParseObject("PaymentMethods");
$method3->set("name", "Echeck");
$method3->set("status", "Active");
$method3->save();



?>
