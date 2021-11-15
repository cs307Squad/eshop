<?php


$servername = "34.71.136.78";
$username = "root";
$password = "JulianNagelsmann";

// Create connection
$conn = new mysqli($servername, $username, $password,"eshop");


function insertPost($title,$content, $conn){


  $sql = "INSERT INTO autosave VALUES(null, ?, ?)";


  $stmt = $conn->stmt_init();


  if($stmt->prepare($sql)){


    $stmt->bind_param('ss',$title,$content);


    if($stmt->execute()){


      echo $conn->insert_id;


    }


  }}


function updatePost($title,$content,$content2,$content3,$id, $conn){


//   $sql = "UPDATE autosave SET title = ?, content = ? WHERE id = ?";

//      $sql = "UPDATE Website SET Name = ? , Javascript_Files = ?, Html_Files = ?, Category = ? WHERE Website_ID = 5";
//
//
//   $stmt = $conn->stmt_init();
//
//
//   if($stmt->prepare($sql)){
//
//
//     $stmt->bind_param('ssi',$title,$content,$content2,$content3,$id);
//
//     echo "here";
//     if($stmt->execute()){
//       echo "<i>Draft Saved at ".date("h:i:s a")."</i>";
//
//     }
//
//
//   }


        $query = "UPDATE Website SET `Name` = '$title', `Javascript_Files` = '$content', `Html_Files` = '$content2', Category = 'test' WHERE `Website_ID` = 5";
		$result = mysqli_query($conn, $query);
}


if(isset($_GET['save'])){


  $title = $_POST['title'];


  $content = $_POST['option1'];

  $content2 = $_POST['option2'];

  $content2 = $_POST['option3'];

  $id = 5;


  if($id != ''){

    updatePost($title,$content,$content2,$content3,$id, $conn);

  }


  else{


    insertPost($title, $content, $conn);


  }}


?>
