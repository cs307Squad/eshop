<?php

/*

    tasks - 
    Task ID - int(10) - Primary Key
    User ID - int(10) - NOT NULL
    Tasks - varchar(1000) - NOT NULL
    Due - varchar(10) - NOT NULL

    +-------------+---------------+------+-----+---------+-------+
    | Field       | Type          | Null | Key | Default | Extra |
    +-------------+---------------+------+-----+---------+-------+
    | Task_ID     | int(10)       | NO   | PRI | NULL    |       |
    | User_ID     | int(10)       | NO   |     | NULL    |       |
    | Tasks       | varchar(1000) | NO   |     | NULL    |       |
    | Due         | varchar(10)   | NO   |     | NULL    |       |
    | title       | varchar(250)  | YES  |     | NULL    |       |
    | description | varchar(250)  | YES  |     | NULL    |       |
    +-------------+---------------+------+-----+---------+-------+


    Tasks Example: Buy car - 0,
    


*/


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

$query = new ParseQuery("Team");
$query->limit(100);
$results = $query->find();


echo "
<!DOCTYPE html>
<html>

<head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title>Create List</title>
    <!-- Fonts -->
    <link href=\"https://fonts.googleapis.com/css?family=Roboto:300,400,500\" rel=\"stylesheet\">
    <!-- CSS -->
    <link href=\"style.css\" rel=\"stylesheet\">
    <meta name=\"robots\" content=\"noindex,follow\" />

</head>

<style>

body {
  background: #2a2a2b;
  color: #fff;
  text-align: center;
  font-family: Arial, Helvetica;
}

.big {
  font-size: 1.2em;
}

.small {
  font-size: .7em;
}

.square {
  width: .7em;
  height: .7em;
  margin: .5em;
  display: inline-block;
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
";

if(isset($_POST['start_create'])){
    $total = $_POST['num_tasks'];
    $user = $_POST['user'];
    echo "
        <form method='POST' action'createlist.php'>
        <input id='input' name='user' type='text' placeholder='User' value='$user'/><br/>
        <input id='input' name='total' type='text' placeholder='Total' value='$total'/><br/>
        <input id='input' name= 'title' type='text' placeholder='Title'/><br/>  
        <input id='input' name= 'description' type='text' placeholder='Description'/><br/>  
        <input id='input' name= 'due' type='text' placeholder='Due Date MM/DD/YYYY'/><br/>  
    ";



    for($i = 0; $i < $total; $i++){
        echo"
            <input id='input' name= 'task$i' type='text' placeholder='Task$i'/><br/>  
        ";
    }

    echo"
            <button type='submit' name='create'>Create</button>

        </form>
    ";

}else if(isset($_POST['create'])){


    $user = $_POST['user'];
    $total = $_POST['total'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due = $_POST['due'];
    $tasks = "";
    for($i = 0; $i < $total; $i++){
        $current = "task".$i;
        $tasks = $tasks.$_POST[$current];
        if($i != $total-1){
            $tasks=$tasks.",";
        }
    }
    

	$task = new ParseObject("Tasks");
	$task->set("user", $user);
	$task->set("title",$title);
	$task->set("description",$description);
	$task->set("tasks",$tasks);
	$task->set("title",$due);

try {
  $task->save();
  echo 'New object created with objectId: ' . $task->getObjectId();
  header("Location:view_user_lists.php");
} catch (ParseException $ex) {  
  // Execute any logic that should take place if the save fails.
  // error is a ParseException object with an error code and message.
  echo 'Failed to create new object, with error message: ' . $ex->getMessage();
}



}else{




    echo "
        <form method='POST' action='createlist.php'>
	<span class='custom-dropdown big'>
 	Pick User:  <select name=\"user\">";

for($i = 0; $i < count($results); $i++){
    $object = $results[$i];
    $fullname = $object->get("fullname");
    $username = $object->get("username");
    $email = $object->get("email_address");
    $role = $object->get("role");

    echo "
    <option value='$username'>$username</option>";

}

echo"
 </select>

        How many tasks would you like to add:  <select name=\"num_tasks\">
            <option value=\"1\">1</option>
            <option value=\"2\">2</option>
            <option value=\"3\">3</option>
            <option value=\"4\">4</option>
            <option value=\"5\">5</option>
            <option value=\"6\">6</option>
            <option value=\"7\">7</option>
            <option value=\"8\">8</option>
        </select>



        <button type='submit' name='start_create'>Create List</button>
        </form>
";

}



?>
