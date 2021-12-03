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


$query = new ParseQuery("Suggestions");
$query->limit(10000);
$results = $query->find();


echo "<table style='width:100%'>
  <tr>
    <th>Page </th>
    <th>Suggestion</th>
<tr>";

for($i = 0; $i < count($results); $i++){
	$object = $results[$i];
	$file = $object->get("file");
	$suggestion = $object->get("text");

echo"
<tr>
    <td><a href='".$file."'>Click to edit</a></td>
    <td>".$suggestion."</td>
  </tr>	";


}

echo "</table><br/>";
?>
