<?php
include("connect.php");
/*

+-------------+---------+------+-----+---------+-------+
| Field       | Type    | Null | Key | Default | Extra |
+-------------+---------+------+-----+---------+-------+
| User_ID     | int(10) | NO   |     | NULL    |       |
| Product_IDS | int(10) | NO   |     | NULL    |       |
+-------------+---------+------+-----+---------+-------+

*/

$row = 1;
$user = 0;
if (($handle = fopen("recommendations.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        $row++;
	if($row == 2){
		continue;
	}
	for ($c=0; $c < $num; $c++) {
	    $rest = substr($data[$c], 1, -1);
	    $query = "insert into Recommendations(User_ID, Product_IDS) values('$user', '$rest')";
	    $result = mysqli_query($conn,$query);

	    if(!$query){
		echo $conn->error;
	    }else{
		echo "inserted <br/>";
		$user++;
	    }
	    echo $rest."<br/>"; 
            //echo $data[$c] . "-".$c."<br />\n";
        }
    }
    fclose($handle);
}


?>
