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
	$current_user = $_POST['curr_user'];
	$username = $_POST['username'];
	$index = $_POST['index'];
	$comment = $_POST['comment'];

	$query = new ParseQuery("UserLogs");
	$query->limit(10000);
	$results = $query->find();
	
	for($i = 0; $i < count($results); $i++){
		if($i == $index){
			$object = $results[$i];
			$comments = $object->get("comments");
			$comments = $comments."<br/>=>>".$current_user.": ".$comment;
			$object->set("comments", $comments);
			$object->save();
			break;
			header("Location:index.php");
		}
	}

}

$query = new ParseQuery("UserLogs");
$query->limit(10000);
$results = $query->find();
//echo "Successfully retrieved " . count($results) . " products.";
// Do something with the returned ParseObject values

echo "
<!DOCTYPE html>
<html>
<style>
table, th, td {
  border:1px solid black;
}
</style>
<body>

<h2>Changes made by Users</h2>

<table style='width:100%'>
  <tr>
    <th>User </th>
    <th>Log#</th>
    <th>Log</th>
    <th>Comments</th>
  </tr>
";

for ($i = 0; $i < count($results); $i++) {
    $object = $results[$i];
    $username = $object->get("username");
    $log = $object->get("log");
    $comments = $object->get("comments");

    echo "

    <tr>
 	  <td>$username</td>
  	  <td>$i</td>
  	  <td>$log</td>
  	  <td>$comments</td>
    </tr>


    ";
}

echo "
</table><br/>

<form method='POST' action='index.php'>
  <select name='curr_user'>
    <option value='user1'>User1</option>
    <option value='user2'>User2</option>
    <option value='user3'>User3</option>
  </select>

  <select name='username'>
    <option value='user1'>User1</option>
    <option value='user2'>User2</option>
    <option value='user3'>User3</option>
  </select> <input name='index' placeholder='What change would you like to comment on' type='text'/><br/>

  <textarea id='comments' name='comment' rows='4' cols='50'>
    </textarea><br/>

    <input type='submit' name='submit' value='comment'/><br/>
</form>


</body>
</html>
";


?>
