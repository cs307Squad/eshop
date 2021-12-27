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

$not_finished = true;
/*
$query = new ParseQuery("Inventory");
$query->limit(1000);
$results = $query->find();
*/
while ($not_finished){
    $query = new ParseQuery("Inventory");
    $query->limit(1000);
    $results = $query->find();
    for ($i = 0; $i < count($results); $i++) { 
        $object = $results[$i];
        $object->destroy();
    }

    $query = new ParseQuery("Inventory");
    $result = $query->find();
    if (count($result) > 0){
        $not_finished = true;
    }
    else{
        $not_finished = false;
    }
}

?>
