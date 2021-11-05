<?php
    include("connect.php");

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
	$day = $_COOKIE['date'];
	//$month = $_COOKIE['month'];

	$date = getdate();
	$year = $date['year'];

	$picked = $day."/".$year;

        $query = "select * from ManagerTasks where User_ID = '$user' and Due = '$picked'";
        $result = mysqli_query($conn, $query);

        if(!$result){
            echo $conn->error;
        }else{
            while($task = $result->fetch_assoc()){     
                $tasks = explode(",", $task['Tasks']);
                $due = $task['Due'];
                $title = $task['title'];
                $description = $task['description'];

                echo"
                    <h4><b>$title</b></h4>
                    <p>$description</p>
                    <p>All Tasks Due on: $due</p>
                    <form action=\"checkbox-form.php\" method=\"post\">
                ";

                foreach($tasks as $current){

                    // $current_values = explode(" - ", $current);
                    echo "
                        <input type=\"checkbox\" name=\"formWheelchair\" value=\"Yes\" /> $current<br/>
                    ";
                }
                

            }
        }
    }

    echo "
    <form method='POST' action='viewLists.php'>

    Pick User # : <select name=\"user\">
    <option value=\"1\">User 1</option>
    <option value=\"11\">User 2</option>
    <option value=\"31\">User 3</option>
    <option value=\"44\">User 4</option>
    <option value=\"55\">User 5</option>
    <option value=\"77\">User 6</option>
    </select>


    <button type='submit' name='view'>View Lists</button>
    </form>
";

echo"

</body>
</html>";

?>
