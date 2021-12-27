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



    echo "
<!DOCTYPE html>
<style>
/* CodePen demo */
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


</style>

<script>
    var colors = ['1abc9c', '2c3e50', '2980b9', '7f8c8d', 'f1c40f', 'd35400', '27ae60'];

colors.each(function (color) {
  $$('.color-picker')[0].insert(
    '<div class='square' style='background: #' + color + ''></div>'
  );
});

$$('.color-picker')[0].on('click', '.square', function(event, square) {
  background = square.getStyle('background');
  $$('.custom-dropdown select').each(function (dropdown) {
    dropdown.setStyle({'background' : background});
  });
});
    </script>

    <body>

";

/*
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
*/

    if(isset($_POST['view'])){

        echo "
        <div class=\"card\">
            <div class=\"container\">
        ";

        $user = $_POST['user'];
	$query = new ParseQuery("Tasks");
	$query->equalTo("user", $user);
	$query->limit(10000);
	$results = $query->find();

	for($i = 0; $i < count($results); $i++){
		$task = $results[$i];
                $tasks = explode(",", $task->get("tasks"));
                $due = $task->get("due");
                $title = $task->get("title");
                $description = $task->get("description");

                echo"
                    <h4><b>$title</b></h4>
                    <p>$description</p>
                    <p>All Tasks Due on: $due</p>
                    <form action=\"checkbox-form.php\" method=\"post\">
                ";

                foreach($tasks as $current){

                    // $current_values = explode(" - ", $current);
                    echo "
                        <input id='input' type=\"checkbox\" name=\"formWheelchair\" value=\"Yes\" /> $current<br/>
                    ";
                }
                

            }
        
    }
$query = new ParseQuery("Team");
$query->limit(100);
$results = $query->find();

    echo "
    <form method='POST' action='view_user_lists.php'>

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
    <button type='submit' name='view'>View Lists</button>
    </form>
";

echo"

</body>
</html>";

?>
