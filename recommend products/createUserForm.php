<html>

<head>
</head>
<body>

<?php


// $query = "select template_Name, number_Of_Users, category from TemplateData3";
// $result = mysqli_query($conn, $query);

// $row_data = array();

/* 

*/
// while($row = mysqli_fetch_array($result)) {
//     # echo $row['category'] . $row['number_Of_Users'];
//     $row_data[] = array('Name' => $row['template_Name'], 'Number' => $row['number_Of_Users'], 'category' => $row['category']);

//   }



// $row_data2 = array();
// foreach ($row_data as $var ) {
//     if (isset($row_data2[$var['category']])) {
//         $past = $row_data2[$var['category']];
//         $past[] = array('Name' => $var['Name'], 'Number' => $var['Number']);
//         $row_data2[$var['category']] = $past;
//     } else {
//         $current = array();
//         $current[] = array('Name' => $var['Name'], 'Number' => $var['Number']);
//         $row_data2[$var['category']] = $current;
//     }
// }
# foreach($row_data2 as $key => $value) {
    # foreach($value as $instance) {
        # echo $instance;
    # }
  # }
// $sorted_array = array();
// foreach($row_data2 as $key => $value) {
//     array_multisort( array_column($value, "Number"), SORT_DESC, $value);
//     $row_data2[$key] = $value;
//     }

  


#next time add the values to the dataframe based on the cost, quality using if else etc
#but make it logical






// $gender = $_POST['gender'];  
// $occupation = $_POST['occupation'];
// $marital_status = $_POST['marital'];
// $city = $_POST['city'];
// $education = $_POST['education'];
// $income = $_POST['income'];





if (isset($_POST['Submit'])) {
    $age = $_POST["age"];
    $gender = $_POST['gender'];  
    $occupation = $_POST['occupation'];
    $marital_status = $_POST['marital'];
    $city = $_POST['city'];
    $education = $_POST['education'];
    $income = $_POST['income'];
    echo $gender;
    echo " ";
    echo $age;
    echo " ";
    echo $occupation;
    echo " ";
    echo $marital_status;
    echo " ";
    echo $city;
    echo " ";
    echo $education;
    echo " ";
    echo $income;
    $result = system("python decisionTree.py");
    echo $result;
}









    
    
    //     $values = $row_data2[$answer];

// if ($answer == "Traditional") {  
//     $values = $row_data2[$answer];
//     echo "<table>";
//     echo "<th>" . "<tr><td>" . 'Template Names' . "</td><td>" . 'Popularity' . "</td></tr>" . "</th>";
//     foreach ($values as $var ) {
//       echo "<tr><td>" . $var['Name'] . "</td><td>" . $var['Number'] . "</td></tr>";  
//     }
//     echo "</table>";        
       
// } elseif ($answer == "App") {
//     $values = $row_data2[$answer];
//     echo "<table>";
//     echo "<th>" . "<tr><td>" . 'Template Names' . "</td><td>" . 'Popularity' . "</td></tr>" . "</th>";
//     foreach ($values as $var ) {
//       echo "<tr><td>" . $var['Name'] . "</td><td>" . $var['Number'] . "</td></tr>";  
//     }
//     echo "</table>"; 
     
    
// } elseif ($answer == "Clothing") {
//     $values = $row_data2[$answer];
//     echo "<table>";
//     echo "<th>" . "<tr><td>" . 'Template Names' . "</td><td>" . 'Popularity' . "</td></tr>" . "</th>";
//     foreach ($values as $var ) {
//       echo "<tr><td>" . $var['Name'] . "</td><td>" . $var['Number'] . "</td></tr>";  
//     }
//     echo "</table>"; 
    
// }
















# array_multisort( array_column($row_data2, "Rating"), SORT_DESC, $row_data2);
### row_data: [array('cafe', 120, 'forever'), array(')]

# $conn->close();


?>


<form method="post">

 <h1>What is your age?</h1>
 <input type="text" name="age" value="age"><br>

 <h1>What is your Income?</h1>
 <input type="text" name="income" value="income"><br>

  <h1>What is your gender?</h1>
  <input type="radio" name="gender" value="0">
  <label for="Cheap">Male</label><br>
  <input type="radio" name="gender" value="1">
  <label for="Ok">Female</label><br>
  
  <h1>What is your marital status?</h1>
  <input type="radio" name="marital" value="0">
  <label for="Low">Single</label><br>
  <input type="radio" name="marital" value="1">
  <label for="Ok">Married</label><br>


  <h1>What is the Level of education you have currently?</h1>
  <input type="radio" name="education" value="0">
  <label for="traditional">Other/Unknown</label><br>
  <input type="radio" name="education" value="1">
  <label for="app">High School</label><br>
  <input type="radio" name="education" value="2">
  <label for="clothing">University</label><br>
  <input type="radio" name="education" value="3">
  <label for="clothing">Graduate School</label><br>

  <h1>What is your Occupation?</h1>
  <input type="radio" name="occupation" value="0">
  <label for="traditional">Unskilled employee</label><br>
  <input type="radio" name="occupation" value="1">
  <label for="app">Skilled employee</label><br>
  <input type="radio" name="occupation" value="2">
  <label for="clothing">Management</label><br>

  <h1>What is the size of the city you love to live in?</h1>
  <input type="radio" name="city" value="0">
  <label for="traditional">Small sized city</label><br>
  <input type="radio" name="city" value="1">
  <label for="app">Medium sized city</label><br>
  <input type="radio" name="city" value="2">
  <label for="clothing">Big sized city</label><br>

  <input type="submit" value="Submit" name="Submit">
</form>





</body>




</html>