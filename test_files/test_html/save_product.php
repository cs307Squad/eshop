<?php
require '../vendor/autoload.php';
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

$query = new ParseQuery("Inventory");
$query->limit(100);
$results = $query->find();
echo "HI<br/>";
for($i = 0; $i < 100; $i++){

	$button = "submit".$i;
    if(isset($_POST[$button])){
	echo "HI found<br/>";
        $object = $results[$i];

       $name_index = "name".$i;
       $price_index = "price".$i;
       $discount_index = "discount".$i;
       $purchases_index = "purchases".$i;
       $page_index = "page_link".$i;
       $total_index = "total".$i;
       
       $name = $_POST[$name_index];
        $price = $_POST[$price_index];
        $discount = $_POST[$discount_index];
        $purchases = $_POST[$purchases_index];
        $page_link = $_POST[$page_index];
        $total = $_POST[$total_index];

/*
        $name = $_POST['name$i'];
        $price = $_POST['price$i'];
        $discount = $_POST['discount$i'];
        $purchases = $_POST['purchases$i'];
        $page_link = $_POST['page_link$i'];
        $total = $_POST['total$i'];
*/
	if($name != ""){
        	$object->set("name", $name);
	}
	if($price != ""){
        	$object->set("raw_price", $price);
	}
	if($discount != ""){
        	$object->set("discount", $discount);
	}
	if($purchases != ""){
        	$object->set("purchases", $purchases);
	}

	if($page_link != ""){
        	$object->set("product_link", $page_link);
	}

	if($total != ""){
		$object->set("total", $total);
        }


        try {
            $object->save();
            echo 'Saved objectId: ' . $object->getObjectId();
            //Add file redirection
	   header("Location:manage_inventory.php");
        } catch (ParseException $ex) {  
        // Execute any logic that should take place if the save fails.
        // error is a ParseException object with an error code and message.
        echo 'Failed to create new object, with error message: ' . $ex->getMessage();
        }

        break;

    }
}

?>
