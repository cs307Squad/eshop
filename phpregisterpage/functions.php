<?php

function scramble password($password) {

    password_hash($password) {
        // neeed to unscramble the hashed password.
    }
}

if(empty($username)) {
    echo 'Username required';
}
if(empty($password)) {
    echo 'Password required';
}

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


function shopperseller($typeofuser) {
    if ($typeofuser == shopper) {

        a = href<shopper page.html>;
    }
         else {
            a = href<seller page.html>;
         }
}
// Is the person logging in a shopper or a seller

<!DOCTYPE html>
<html>
	<head>
		<title>E-Shop.io</title>
        <link rel = "stylesheet" type ="text/css" href ="style.css">
	</head>
		<body>
			<h3>Login here</h3>
			
			<form action ="login.php" method = "post">
				<table>
					<tr>
						<td>Username:</td>
						<td>
							<input type ="text" name = "username">
						</td>
					</tr>
					<tr>
						<td>Type of USER : Shopper/Seller</td>
						<td>
							<input type ="text" name = "shopperseller">
						</td>
					</tr>
					<tr>
						<td>Password:</td>
						<td>
							<input type ="password" name ="password">
						</td>

                        <button type ="Login">Login</button>
		</body>
</html>
