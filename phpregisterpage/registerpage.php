<!DOCTYPE html>

<html>
	<head>
		<title>E-Shop.io</title>
		<script src="https://kit.fontawesome.com/5df5e1f1ea.js" crossorigin="anonymous"></script>
		<link rel = "stylesheet" type ="text/css" href ="style.css">
		
        
	</head>
		<body>
			<h3>Register</h3>
			
			<form action ="register.php" method = "post">
				<table>
					
					<tr>
						<td>First Name:</td>
						<td>
							<input type ="text" name = "fname" id = "fname" placeholder = "username">
						</td>
						<td>Last Name: </td>
						<td>
							<input type ="text" name = "lname" id = "lname" placeholder = "lastname">
						</td>
					</tr>
					

					<tr>
						<td>Username:</td>
						<td>
							<input type ="text" name = "username" placeholder = "username">
						</td>
					</tr>
					
					<tr>
						<td>Password:</td>
						<td>
							<input type ="password" name ="password" id = "pword" placeholder = "password">
						
						</td>
						<td> Confirm Password: </td>
						<td>
							<input type ="password" name = "cpassword" id ="cpword" placeholder = "confirm password">
							
							
					</tr>
					
					<tr>
						<td>Email:</td>
						<td>
							<input type = "email" name = "email" id = "email" placeholder = "email">
						</td>
					</tr>

					<tr>
						<td>Phone Number:</td>
						<td>
							<input type = "tel" name = "telephone" id = "telephone" placeholder = "telephone#">
						</td>
					
					<tr>
						<td>
                        <button type ="submit" class = "btn" name = "reg_user">Create Account</button>
						</td>
					</tr>
		</body>
</html>
