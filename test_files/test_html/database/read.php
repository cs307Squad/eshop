<?php

require 'vendor/autoload.php';
//$app_id=“KSDJFKASJFI3S8DSJFDH”;
//$master_key = “LASDK823JKHR87SDFJSDHF8DFHASFDF”;
//$rest_key = “abcdefghiklmnopqrstuvwxyz”;

session_start();

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

	if(isset($_POST['read_file'])){


		$file_name = $_POST['file_name'];
		$file = fopen($file_name,"r");
		$headers = fgetcsv($file);

			for($i = 0; $i < count($headers); $i++){
				echo $headers[$i]."<br/>";
			}

		$index = 0;

		while(false != ($line=fgetcsv($file))){
			
			$inventory = new ParseObject("Inventory");

			for($i = 0; $i < count($headers); $i++){

				if($headers[$i] == "id"){
//					$inventory->set("product_id", $line[$i]);
				}else{
//					echo $headers[$i]."==>".$line[$i]."<br/>";
					$inventory->set($headers[$i], $line[$i]);
				}

			}

			try{
				$inventory->save();
				echo $index." => Inserted into database => ".$inventory->getObjectId()."<br/>";
				$index = $index+1;

			}catch(ParseException $ex){
				echo "Failed to insert to into database ==> ".$ex->getMessage()."<br/>";
			}

//			print_r(fgetcsv($file));
		}

		//header("Location:../manage_inventory.php");
		fclose($file);

	}

?>
