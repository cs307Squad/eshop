<?php

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
+------------------+--------------+------+-----+---------+-------+

*/

    include("connect.php");
    $price = "";
    $product = "";
//    $order_id = 10001;
    $address = "";
    $customer = 0;

    $id_query = "SELECT * FROM Orders ORDER BY Order_ID DESC LIMIT 1";
    $id_result = mysqli_query($conn, $id_query);

 
    if(isset($_COOKIE['product'])){
//	echo "COOOKIE SET";
        $product = $_COOKIE['product'];
        $price = $_COOKIE['price'];
        $index = $_COOKIE['index'];
        $customer = $_COOKIE['customer'];
        $checkout = "";
	$address = "1234 Northwestern Ave";


        switch($index){
            case 1: 
                $checkout = "create-checkout-session.php";
                break;
            case 2: 
                $checkout = "create-checkout-session1.php";
                break;
            case 3: 
                $checkout = "create-checkout-session2.php";
                break;
            case 4: 
                $checkout = "create-checkout-session3.php";
                break;
            case 5: 
                $checkout = "create-checkout-session4.php";
                break;

        }
    }else{

	echo "cookies not set";
	}

    if(isset($_POST['submit'])){
	    if(!$id_result){
		echo $conn->error;
	    }else{
	   while ($prod = $id_result->fetch_assoc()) {
		echo "in prod";
		$order_id = $prod['Order_ID']+1;
		echo $order_id;
	   }
   } 
        $query = "insert into Orders(Order_ID, Website_ID, Customer_ID,Customer_Address,Prod_ID) values ('$order_id','$order_id','$customer','$address','$index')";
        $result = mysqli_query($conn, $query);
        if(!$result) {
            echo $conn->error;
        }else{
	    $cookie_name = "product";
            $cookie_value = "";
            $price_name = "price";
            $price_value = "";
            $index_name = "index";
            $index = "";
            $customer_name = "customer";
            $customer_value = "1";


            setcookie($cookie_name, $cookie_value, time() -3600);
            setcookie($price_name, $price_value, time() -3600);
            setcookie($index_name, $index, time() - 3600);
            setcookie($customer_name, $customer_value, time() -3600);
            header("Location:history.php");
        }

    }


    echo"

    <!DOCTYPE html>
    <html>
    
    <head>
        <meta charset=\"utf-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <title>WIHOLL Womens Tops V Neck Summer Petal Sleeve Casual</title>
        <link href=\"style.css\" rel=\"stylesheet\">
    </head>
    
    <body>
    
        <div class=\"card\">
            <h1></h1>
            <p class=\"price\">$$price</p>
            <p>$product</p>
            <form action=\"checkout.php\" method=\"POST\">
                <p><button name=\"submit\" type=\"submit\" id=\"checkout-button\">Checkout</button></p>
            </form>
    
        </div>
    
    </body>
    <html>
    
    ";

?>
