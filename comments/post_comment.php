<?php
include("connect.php");

if(isset($_POST_['post_comment'])){

    /*


    User_name
    email_address
    Product Id
    Date
    comments text

    */

    $user_name = $_COOKIE['name'];
    $email = $_COOKIE['email'];
    $message = $_POST['message'];
    $product = $_COOKIE['product'];
    $date = "";//Get Date

    $query = "insert into comments(product_id, username, email, comment, date) values ('$product','$user_name', '$email', '$message', '$date')";
    $result = mysqli_query($conn, $query);

    if(!$result){
        echo $conn->error;
    }else{
        header("Location:index.php");
    }



}


?>