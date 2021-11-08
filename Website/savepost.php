<?php
	include 'dbconn.php';

	if($_POST['blog_id'] == ""){
		$title = $_POST['title'];
		$content = $_POST['home'];
		$content2 = $_POST['about'];
		$content3 = $_POST['contact'];
        echo "here";
		$query = "UPDATE Website SET `Name` = '$title', `Javascript_Files` = '$content', `Html_Files` = '$content2', Category = '$content3' WHERE `Website_ID` = 5";
		$result = mysqli_query($conn, $query);
	}
?>