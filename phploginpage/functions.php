<?php

determineshoppertype($data) {
    ($data === "seller") {
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>E-shop.io</title>
</head>
<body>
<?php
session_start();
include "dbconn.php";

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
    $username = $_POST['username'];
    $password = $_POST['password'];
}

if(empty($username)) {
    echo 'Username required';
}
if(empty($password)) {
    echo 'Password required';
}

// Verify that the person that logged in has actual user information, Now I need to search the database for a match on their %username and $password.
$sql = "SELECT * FROM loginstuff WHERE name='$username' AND password = '$password'";

if firstrow === $username AND 2ndrow === password {
    successful login
} else {
    user not found.
}
