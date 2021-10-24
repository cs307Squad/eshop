<?php
include("connect.php");
echo "
<br/><br/><form method='POST' action='history.php'>

    Pick User # : <select name=\"user\">
        <option value=\"1\">User 1</option>
        <option value=\"11\">User 2</option>
        <option value=\"31\">User 3</option>
        <option value=\"44\">User 4</option>
        <option value=\"55\">User 5</option>
        <option value=\"77\">User 6</option>

    </select>


   Sort Orders by : <select name=\"choice\">
        <option value=\"1\">(Newest to Oldest)</option>
        <option value=\"2\">(Oldest to Newest)</option>
    </select>
    
    <button type='submit' name='submit'>View Orders</button>

</form>

";


if(isset($_POST['submit'])){

	$user = $_POST['user'];
	$choice = $_POST['choice'];
	$query = "";
//	echo $choice."<br/>";
	if($choice == 1){
		 $query = "select Order_ID, Prod_ID from Orders where Customer_ID = '$user' order by Order_ID DESC";
	}else if($choice == 2){
		$query = "select Order_ID, Prod_ID from Orders where Customer_ID = '$user' order by Order_ID ASC";
	}

	$user = $_COOKIE["customer"];
//    $query = "select Order_ID, Prod_ID from Orders where Customer_ID = '$user' order by Order_ID DESC";
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

} else if(isset($_COOKIE['customer'])){
    $user = $_COOKIE["customer"];
    $query = "select Order_ID, Prod_ID from Orders where Customer_ID = '$user' order by Order_ID DESC";
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
