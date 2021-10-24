<?php
include("connect.php");

$user = "1";
//echo $user."<br/>";
$query = "select * from Recommendations where User_ID = '$user'";
$result = mysqli_query($conn, $query);

if(!$result){
	echo $conn->error;
}else{
	echo"<h1>Recommendations</h1>";

	while($user = $result->fetch_assoc()){
		$ids = $user['Product_IDs'];
		$prods = explode(", ", $ids);
			echo "<table> <tr>
				<th>Product Name</th>
      				<th>Category</th> 
			    </tr>";
		foreach ($prods as $id) {
//			echo $id."<br/>";
			$prod_sql = "select * from Product where Product_Code = '$id'";
			$prod_result = mysqli_query($conn, $prod_sql);
			if(!$prod_result){
				echo $conn->error;
			}else{
				while($curr = $prod_result->fetch_assoc()){
					echo "<tr><td>".$curr['Name']."</td><td>".$curr['Category']."</td></tr>";
				}

			}
		}
					echo "</table>";

	}

}

?>
