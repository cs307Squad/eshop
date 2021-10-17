<?php
include("connect.php");

if(isset($_COOKIE['customer'])){
    $user = $_COOKIE["customer"];
    $query = "select Order_ID, Prod_ID from Orders where Customer_ID = '$username' order by Order_ID ASC";
    $result = mysqli_query($conn, $query);

    if(!$result){
        echo $conn->error;
    }else{
        echo "
        <table>
        <tr>
            <th>Product</th>
            <th>Category</th>
        </tr>";

        while($order = $result->fetch_assoc()){
            $id = $order['Prod_ID'];
            $new_query = "select * from Product where Product_Code ='$id'";
            $current = mysqli_query($conn, $new_query);

            if(!$current){
                echo $conn->error;
            }else{
                while($product = $current->fetch_assoc()){
                    // $product = mysqli_fetch_array($current);
                    $name = $product['Name'];
                    $category = $product['Category'];
        
                    echo"
                    <tr>
                        <td>$name</td>
                        <td>$category</td>
                    </tr>";
          
                }
            }
            
        }

        echo"
        </table>
        ";
    }
}



?>
