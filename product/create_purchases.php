<?php
include("../connect.php");

/*
+------------------+--------------+------+-----+---------+-------+
| Field            | Type         | Null | Key | Default | Extra |
+------------------+--------------+------+-----+---------+-------+
| Order_ID         | int(10)      | NO   | PRI | NULL    |       |
| Website_ID       | int(10)      | YES  |     | NULL    |       |
| Customer_ID      | int(10)      | YES  | MUL | NULL    |       |
| Customer_Address | varchar(255) | YES  |     | NULL    |       |
| Order_Date       | date         | YES  |     | NULL    |       |
| Required_Date    | date         | YES  |     | NULL    |       |
| Shipped_Date     | date         | YES  |     | NULL    |       |
| Status           | int(10)      | YES  |     | NULL    |       |
| Comments         | varchar(255) | YES  |     | NULL    |       |
| Prod_ID          | int(10)      | YES  |     | NULL    |       |
+------------------+--------------+------+-----+---------+-------+
*/

    $order_id = 1;

    for($i = 0; $i < 200; $i++){
        for($j  = 0; $j < 50; $j++){
            $prod_id = rand(1, 200);
            $query = "insert into Orders(Order_ID, Customer_ID,Prod_ID) values ('$order_id','$i','$prod_id')";
            $result = mysqli_query($conn, $query);
            if(!$result){
                echo $conn->error ."\n";
            }else{
                $order_id++;
            }
        }   
    }

?>
