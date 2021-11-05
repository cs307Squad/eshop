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


<form action="viewList.php" method="POST"> 
        <button type="button" name="popularity">Sort by popularity!</button>
        <button type="button" name="rating">Sort by rating!</button>

</form>

    if(isset($_POST['popularity'])){

        

        echo "hello";


    }

echo"
</body>
</html>";

?>