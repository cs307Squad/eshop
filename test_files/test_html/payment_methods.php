<?php
require '../vendor/autoload.php';
//$app_id=“KSDJFKASJFI3S8DSJFDH”;
//$master_key = “LASDK823JKHR87SDFJSDHF8DFHASFDF”;
//$rest_key = “abcdefghiklmnopqrstuvwxyz”;

/*
    Payment Methods:
        Card - Automatic
        Echeck - 
        Crypto - 
*/

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

$query = new ParseQuery("PaymentMethods");
$query->limit(100);
$results = $query->find();

for($i = 0; $i < count($results); $i++){
	$save_index = "save".$i;
	if(isset($_POST[$save_index])){
	//	echo "Picked";
		$object = $results[$i];
		$action_index = "action".$i;
		$new_status = $_POST[$action_index];
		$object->set("status", $new_status);
		$object->save();
		//header("Location:payment_methods.php");
	}
}

echo "

<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<h2>Payment Methods</h2>
<form action='payment_methods.php' method='POST'>
<table>
  <tr>
    <th>Payment Method</th>
    <th>Status</th>
    <th>Action</th>
  </tr>
";


for($i = 0; $i < count($results); $i++){
	$object = $results[$i];
	$name = $object->get("name");
	$status = $object->get("status");

	echo"
	  <tr>
    		<td>$name</td>
    		<td>$status</td>
		<td>
			<select name='action$i'>
				<option value='Inactive'>Inactive</option>
				<option value='Active'>Active</option>
			</select>
			<input type='submit' name='save$i' value='Save'/>
		</td>

	";

}

echo"
  </tr>

	<button><a href='home.html'>Back</a></button>

";

?>
