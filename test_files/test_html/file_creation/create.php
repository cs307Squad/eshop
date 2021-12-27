<?php

//shell_exec("sudo mkdir test");
//include ("parse_connect.php");
//require 'vendor/autoload.php';
//$app_id=“KSDJFKASJFI3S8DSJFDH”;
//$master_key = “LASDK823JKHR87SDFJSDHF8DFHASFDF”;
//$rest_key = “abcdefghiklmnopqrstuvwxyz”;

/*
use Parse\ParseClient;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseACL;
use Parse\ParsePush;
use Parse\ParseUser;
use Parse\ParseInstallation;
use Parse\ParseException;
use Parse\ParseAnalytics;
use Parse\ParseFile;
use Parse\ParseCloud;

ParseClient::initialize( "KSDJFKASJFI3S8DSJFDH",null, "LASDK823JKHR87SDFJSDHF8DFHASFDF");
ParseClient::setServerURL("http://localhost:1337/parse", '/');
*/
mkdir("products");

for ($i = 0; $i < 10; $i++){
	$file = fopen("products/page".$i.".html", "w") or die ("Failed to create file");
	$text = "<!DOCTYPE html>
			<html>
				<head>
					<title>E-Shop.io</title>
        				<link rel = 'stylesheet' type ='text/css' href ='style.css'>
				</head>

			<body>
        <div class='card'>
            <img src='jeans3.jpg' alt='Denim Jeans' style='width:100%'>
            <h1>Tailored Jeans</h1>
            <p class='price'>$19.99</p>
            <p>Some text about the jeans..</p>
            <p><button>Add to Cart</button></p>
          </div>

</body>
</html>";


	fwrite($file, $text);
	fclose($file);

	echo "Successfully created page.".$i.".html<br/>";
}


?>
