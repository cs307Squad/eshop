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

if (isset ($_POST['userType'])) {
    $userType= $_POST['userType'];
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

if(empty($userType)) {
    
    exit('Select a User Type');
}


$sql = "INSERT INTO user_accounts (fname, lname, username, password, cpassword, email, userType) VALUES ('$fname', '$lname', '$username', '$password', '$cpassword', '$email', '$userType')";

if(mysqli_query($conn, $sql)){
    echo "Registration complete";
} else{
    echo "Error, unable to complete registration" . mysqli_error($conn);
}

if (strcmp($userType,'Merchant') === 0) {
    <a href ="merchantpage.php">Merchant Page</a>;
    echo 'Merchant page';
}

if (strcmp($userType,'Shopper') === 0) {
    echo 'Shopper page';
}


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