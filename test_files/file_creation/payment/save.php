<?php
include("connect.php");

if(isset($_POST['submit'])){
	$id = 1;
	$web_id = 1;
	$customer_id = 1;
	$customer_address = "Test address ave";
	$status = 1;

	$query = "insert into Orders (Order_ID, Website_ID, Customer_ID, Customer_Address, Order_Date, Required_Date, Shipped_Date, Status) 
		values('$id', '$web_id', '$customer_id', '$customer_address',CURDATE(), CURDATE(), CURDATE(), '$status')";

	$result = mysqli_query($conn, $query);
	if($result){
		header("Location:create-checkout-session.php");
	}

}


?>
