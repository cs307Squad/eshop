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
  width:100%;
}

a{
	text-decoration:none;
	color:#ffffff;
}

button{
    background-color:#04AA6D;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 200px;

}

/* Custom dropdown */
.custom-dropdown {
  position: relative;
  display: inline-block;
  vertical-align: middle;
  margin: 10px; /* demo only */
}

.custom-dropdown select {
  background-color: #1abc9c;
  color: #fff;
  font-size: inherit;
  padding: .5em;
  padding-right: 2.5em; 
  border: 0;
  margin: 0;
  border-radius: 3px;
  text-indent: 0.01px;
  text-overflow: '';
  -webkit-appearance: button; /* hide default arrow in chrome OSX */
}

.custom-dropdown::before,
.custom-dropdown::after {
  content: '';
  position: absolute;
  pointer-events: none;
}

.custom-dropdown::after { /*  Custom dropdown arrow */
  content: '\25BC';
  height: 1em;
  font-size: .625em;
  line-height: 1;
  right: 1.2em;
  top: 50%;
  margin-top: -.5em;
}

.custom-dropdown::before { /*  Custom dropdown arrow cover */
  width: 2em;
  right: 0;
  top: 0;
  bottom: 0;
  border-radius: 0 3px 3px 0;
}

.custom-dropdown select[disabled] {
  color: rgba(0,0,0,.3);
}

.custom-dropdown select[disabled]::after {
  color: rgba(0,0,0,.1);
}

.custom-dropdown::before {
  background-color: rgba(0,0,0,.15);
}

.custom-dropdown::after {
  color: rgba(0,0,0,.4);
}


#input{
    //background-color:#04AA6D;
    color: #000000;
    padding: 14px 20px;
    margin: 8px 0;
   // border: none;
    //cursor: pointer;
    width: 200px;
}

</style>


</style>
<body>

<h2>Changes made by Team</h2>

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


$user_query = new ParseQuery("Team");
$user_query->limit(100);
$user_results = $user_query->find();


echo "
</table><br/>

<form method='POST' action='index.php'>
<span class='custom-dropdown big'>  <select name='curr_user'>
    <option value='user1'>User1</option>
    <option value='user2'>User2</option>
    <option value='user3'>User3</option>
  </select></span>

<span class='custom-dropdown big'>
  <select name='username'>
    <option value='user1'>User1</option>
    <option value='user2'>User2</option>
    <option value='user3'>User3</option>
  </select> <input id='input' name='index' placeholder='What change would you like to comment on' type='text'/><br/>
</span><br/>
  <textarea id='comments' name='comment' rows='4' cols='50'>
    </textarea><br/>

    <button type='submit' name='submit'/>Comment</button><br/>
</form>

</body>
</html>
";


?>
