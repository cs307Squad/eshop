
<?php
include("connect.php");
// 11 31 44 55 77
echo "
<form method='POST' action='multi_recommendations.php'>
    Sort Orders by : <select name=\"choice\">
        <option value=\"1\">User 1</option>
        <option value=\"11\">User 2</option>
        <option value=\"31\">User 3</option>
        <option value=\"44\">User 4</option>
        <option value=\"55\">User 5</option>
        <option value=\"77\">User 6</option>

    </select>
    
    <button type='submit' name='submit'>View Recommendations</button>
</form>
";

if(isset($_POST['submit'])){
    $user = $_POST['choice'];

    $query = "select * from Recommendations where User_ID = '$user'";
    $result = mysqli_query($conn, $query);
    if(!$result){
            echo $conn->error;
    }else{
            echo"<h1>Recommendations Based on User #". $user."'s Purchases</h1>";
            while($user = $result->fetch_assoc()){
                    $ids = $user['Product_IDs'];
                    $prods = explode(", ", $ids);
                            echo "<table> <tr>
                                    <th>Product Name</th>
                                    <th>Category</th> 
                                </tr>";
                    foreach ($prods as $id) {
    //                      echo $id."<br/>";
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
}
?>
