<?php
include ("../connect.php");

    $query = "select * from Product";
    $result = mysqli_query($conn, $query);
    if(!$result){
        echo $conn->error."\n";
    }else{
        $types = array();
        $categories = array();

        while($prod = $result->fetch_assoc()){
            $type = $prod['Product_Type'];
            $category = $prod['Category'];
            if (in_array($type, $types)){
                ;
            }else{
                array_push($types, $type);
            }

            if (in_array($category, $categories)){
                ;
            }else{
                array_push($categories, $category);
            }
        }

        echo "\n\n----------------------------------Types--------------------------------------<br/>";
        foreach ($types as $type) {
            echo $type;
	   echo "<br/>";
        } 

        echo "\n\n------------------------------- Category ---------------------------------<br/>";

        foreach ($categories as $category) {
            echo $category."\n";
	   echo "<br/>";
        } 

    }

?>
