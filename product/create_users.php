<?php

/*

+----------------+--------------+------+-----+---------+-------+
| Field          | Type         | Null | Key | Default | Extra |
+----------------+--------------+------+-----+---------+-------+
| Customer_ID    | int(10)      | NO   | PRI | NULL    |       |
| User_Name      | varchar(255) | YES  |     | NULL    |       |
| Password       | varchar(255) | YES  |     | NULL    |       |
| Website_ID     | int(10)      | YES  |     | NULL    |       |
| Account_Number | int(30)      | YES  |     | NULL    |       |
| City           | varchar(255) | YES  |     | NULL    |       |
| State          | varchar(255) | YES  |     | NULL    |       |
| Country        | varchar(255) | YES  |     | NULL    |       |
| email_address  | varchar(255) | YES  |     | NULL    |       |
+----------------+--------------+------+-----+---------+-------+

*/

include ("../connect.php");

    for($i = 0;  $i < 200; $i++){

        $username = "user".$i;
	echo $username;
        $password = hash('sha256', "pass".$i);
        $website  = 1;
        $city = "city".$i;
        $state = "state".$i;
        $country = "country".$i;
        $email = "user".$i."@email.com";

        $query = "insert into Customer(Customer_ID,User_Name, Password, Website_ID, City, State, Country, email_address) values('$i','$username', '$password','$website','$city', '$state', '$country','$email')";
        $result = mysqli_query($conn, $query);

        if($result){
            echo "Done";
        }else{
            echo $conn->error."\n";
        }

    }

?>
