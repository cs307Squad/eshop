<?php
session_start();
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


if(isset ($_POST['fname']) && isset ($_POST['lname']) && isset($_POST['username']) && isset($_POST['password']) && isset ($_POST['cpassword']) && isset ($_POST['email'])) {
    $fname = validate_fname($_POST['fname']);
    $lname = validate_lname($_POST['lname']);
    $username = validate_username($_POST['username']);
    $password = validate_password($_POST['password']);
    $cpassword = validate_cpassword($_POST['cpassword']);
    $email = validate_email($_POST['email']);

}

if(empty($fname)) {
    echo 'First Name required';
}

if(empty($lname)) {
    echo 'Last Name required';
}
if(empty($username)) {
    echo 'Username required';
}
if(empty($password)) {
    echo 'Password required';
}
if(empty($cpassword)) {
    echo 'Confirm Password required';
}

if(empty($email)) {
    echo 'Email required';
}

/*
if (user_exists($conn ,$_POST['fname']) === false) {
    exit('Username already exists');
} 
*/

$sql = "INSERT INTO user_accounts (fname, lname, username, password, cpassword, email) VALUES ('$fname', '$lname', '$username', '$password', '$cpassword', '$email')";


if(mysqli_query($conn, $sql)){
    echo "Registration complete";
} else{
    echo "Error, unable to complete registration" . mysqli_error($conn);
}

/*
$_SESSION["fname"] = $fname;
$_SESSION["lname"] = $lname;
$_SESSION["username"] = $username;
$_SESSION["password"] = $password;
$_SESSION["cpassword"] = $cpassword;
$_SESSION["email"] = $email;
*/

/*
function user_exists($conn, $data) {
    $sql = "SELECT * FROM user_accounts WHERE username = '$data'";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_Rows)
}
*/

function validate_fname($data){
    if(preg_match("/^([a-zA-Z' ]+)$/",$data) == 0){
        exit('Enter valid first name');
    } 
    return($data);
}

function validate_lname($data){
    if(preg_match("/^([a-zA-Z' ]+)$/",$data) == 0){
        exit('Enter valid last name');
    }
    return($data);
}

function validate_username($data){
    if (preg_match('/^[a-zA-Z0-9]+$/', $data) == 0) {
        exit('Username cannot contain special characters!');
    }
    return($data);
}
function validate_password($data){
    //if (preg_match('/^[a-zA-Z0-9]+$/', $data) == 0) {
    //    exit('Enter Valid Password');
  //  }

   // $hashedpassword = password_hash($data, PASSWORD_DEFAULT);
    return($data);
}

function validate_cpassword($data){
    if (preg_match('/^[a-zA-Z0-9]+$/', $data) == 0) {
        exit('Enter valid password');
    }
    return($data);
}

function validate_email($email) {
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit('Enter valid password');
    }
    return($email);
}