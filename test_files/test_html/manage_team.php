<?php
require '../vendor/autoload.php';
//$app_id=“KSDJFKASJFI3S8DSJFDH”;
//$master_key = “LASDK823JKHR87SDFJSDHF8DFHASFDF”;
//$rest_key = “abcdefghiklmnopqrstuvwxyz”;

/*
    Team
    Fullname
    Username
    Email Address
    Role

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


if(isset($_POST['add_member'])){

	$member = new ParseObject("Team");
	$fullname = $_POST['fullname'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$role = $_POST['role'];

	$member->set("fullname", $fullname);
	$member->set("username", $username);
	$member->set("email_address", $email);
	$member->set("role", $role);

try {
  $member->save();
  echo 'New object created with objectId: ' . $member->getObjectId();
header("Location:manage_team.php");
} catch (ParseException $ex) {  
  // Execute any logic that should take place if the save fails.
  // error is a ParseException object with an error code and message.
  echo 'Failed to create new object, with error message: ' . $ex->getMessage();
}


}
/*
else if(isset($_POST['delete_user'])){

}*/


$query = new ParseQuery("Team");
$query->limit(100);
$results = $query->find();


for($i = 0; $i < count($results); $i++){
	$user = "submit".$i;
	if(isset($_POST[$user])){
		$user = $results[$i];
		$r_index = "role".$i;
		$role = $_POST[$r_index];
		$user->set("role",$role);
		$user->save();
		header("Location:manage_team.php"); 
	}
}

//echo count($results);
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
</head>
<body>

<h2>Manage Team</h2>

<h3>Add Team Member</h3>
<form method='POST' action='manage_team.php'>
	<input id='input' name='fullname' type='text' placeholder='Fullname'/>
	<input id='input' name='username' type='text' placeholder='Username'/>
	<input id='input' name='email' type='text' placeholder='Email Address'/>
	<select id='input' name='role'>
		<option value='editor'>Editor</option>
		<option value='pseudo'>Pseudo User</option>
	</select>
	<button type='submit' name='add_member'>Add Member</button>
</form>

<h3>Tasks</h3>


<button><a href='comments/'>View Log</a></button>
<button><a href='tasks/view_user_lists.php'>View Tasks</a></button>
<button><a href='tasks/cal.php'>Assign Tasks</a></button>

<h3>Current Team</h3>

<form method='POST' action='manage_team.php'>

<table>
  <tr>
    <th>Fullname</th>
    <th>Username</th>
    <th>Email</th>
    <th>Role</th>
  </tr>

";

for($i = 0; $i < count($results); $i++){
    $object = $results[$i];
    $fullname = $object->get("fullname");
    $username = $object->get("username");
    $email = $object->get("email_address");
    $role = $object->get("role");

    echo "
    <tr>
        <td>".$fullname."</td>
        <td>".$username."</td>
        <td>".$email."</td>
        <td>".$role."</td>
        <td><br/>
        <select name='role$i'>
        <option value='editor'>Editor</option>
        <option value='pseudo'>Psuedo User</option>
        </select>
        <input type='submit' name='submit$i' value='Save'/>
        </td>
    </tr>
    ";
}

echo"</table>
</form>

</body></html>";


?>
