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

";

if(isset($_POST['start_create'])){
    $total = $_POST['num_tasks'];
    $user = $_POST['user'];
    echo "
        <form method='POST' action'createlist.php'>
        <input name='user' type='text' placeholder='User' value='$user'/><br/>
        <input name='total' type='text' placeholder='Total' value='$total'/><br/>
        <input name= 'title' type='text' placeholder='Title'/><br/>  
        <input name= 'description' type='text' placeholder='Description'/><br/>  
        <input name= 'due' type='text' placeholder='Due Date MM/DD/YYYY'/><br/>  
    ";



    for($i = 0; $i < $total; $i++){
        echo"
            <input name= 'task$i' type='text' placeholder='Task$i'/><br/>  
        ";
    }

    echo"
            <input type='submit' name='create' value='create'/>
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

        Pick User # : <select name=\"user\">
        <option value=\"1\">User 1</option>
        <option value=\"11\">User 2</option>
        <option value=\"31\">User 3</option>
        <option value=\"44\">User 4</option>
        <option value=\"55\">User 5</option>
        <option value=\"77\">User 6</option>
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
        </select><br/>



        <button type='submit' name='start_create'>Create List</button>
        </form>
";

}



?>
