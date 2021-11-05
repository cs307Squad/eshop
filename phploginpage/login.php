<?php
require_once "dbconn.php";

// This is if user accesses the register page through a method that is not the register button?
/*if(!isset($_POST["submit"])) {
    echo 'Incorrect Access Path';
}
*/
//generic php validation for password, truth tables for validation
/*	        “”	    “apple”	  NULL	FALSE	0	    undefined
empty()	    TRUE	FALSE	  TRUE	TRUE	TRUE	TRUE
is_null()	FALSE	FALSE	  TRUE	FALSE	FALSE	ERROR
isset()	    TRUE	TRUE	  FALSE	TRUE	TRUE	FALSE
*/

/*
SQL LOGINTABLE - "loginstuff"
name . varchar(255) . null. 
password . varchar(255) . null
*/


if(isset($_POST['username']) && isset($_POST['password'])) {

    $username = validate_username($_POST['username']);
    $password = validate_password($_POST['password']);
    $userType = '';
}


if(empty($username)) {
    echo 'Username required';
}
if(empty($password)) {
    echo 'Password required';
}
session_start();
$sql = "SELECT * FROM user_accounts WHERE username = '$username' AND password= '$password'";
$dataentry = $conn->query ($sql);

if(mysqli_num_rows($dataentry) === 1) {
    $row = mysqli_fetch_assoc($dataentry);
    if($row['username'] === $username && $row['password'] === $password) {

        if (strcmp($row['userType'],'Shopper') === 0) {
            header("Location:shopperpagel.php");
        }
        if (strcmp($row['userType'],'Merchant') === 0) {
            header("Location:merchantpagel.php");
        }

        echo 'logged in';
    } else {
        echo 'No account with this username and password';
    }
}

$_SESSION["username"] = $username;
$_SESSION["password"] = $password;

function validate_username($data){
    if (preg_match('/^[a-zA-Z0-9]+$/', $data) == 0) {
        exit('Username cannot contain special characters!');
    }
    return($data);
}
function validate_password($data){
    if (preg_match('/^[a-zA-Z0-9]+$/', $data) == 0) {
        exit('Enter Valid Password');
    }
    return($data);
}