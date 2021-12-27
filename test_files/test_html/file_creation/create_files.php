<?php

//shell_exec("sudo mkdir test");
//include ("parse_connect.php");
require 'vendor/autoload.php';
//$app_id=“KSDJFKASJFI3S8DSJFDH”;
//$master_key = “LASDK823JKHR87SDFJSDHF8DFHASFDF”;
//$rest_key = “abcdefghiklmnopqrstuvwxyz”;


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


mkdir("products");

$query = new ParseQuery("Inventory");
$query->limit(10000);
$results = $query->find();
echo "Successfully retrieved " . count($results) . " products.";
// Do something with the returned ParseObject values
for ($i = 0; $i < count($results); $i++) {
    $object = $results[$i];
    $id = $object->getObjectId();
    $category = $object->get("subcategory");
    $name = $object->get("name");
    $price = $object->get("raw_price");
	$image_link = $object->get('variation_0_image');
	$image_tag = "<img src='$image_link' style=\"width:100%\">";
    $file_link = "http://18.119.0.28/test_files/test_html/file_creation/products/".$id.".html";
    $file = fopen("products/".$id.".html", "w") or die ("Failed to create file");
    $text = "
    
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset=\"utf-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <title>".$name."</title>
        <link href=\"../style.css\" rel=\"stylesheet\">
    </head>
    <body>
        <div class=\"card\">
            ".$image_tag."
            <h1>".$name."</h1>
            <p class=\"price\">".$price."</p>
            <p>".$name."</p>
            <div id=\"fb-root\"></div>
            <script>
                (function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = \"https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0\";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
            </script>
            <!-- Your share button code -->
            <div class=\"fb-share-button\" data-href=\"$file_link\" data-layout=\"button_count\">
            </div><br/>
    <br/>
        <form action=\"https://test.bitpay.com/checkout\" method=\"post\">
      <input type=\"hidden\" name=\"action\" value=\"checkout\" />
      <input type=\"hidden\" name=\"posData\" value=\"\" />
      <input type=\"hidden\" name=\"notificationType\" value=\"json\" />
      <input type=\"hidden\" name=\"data\" value=\"QxLrK8CtUhfe/pzYsj1gk8Nung2twWAxHxNYfMTYOt8ijMbhQdSDCZFpOjIwmy4zvHwsHBXbC6zXCmW6ja3F5v8QQO96iwzjr3QIKkHwqrp+eMDlm5E0yaZjTUXh8d6GoeZ6Eew7pE/5o8cxqCuo1PpVkCUl16ROh1hhwummTSktp28MWL1XKlPCXns9+JmZHGlkSjuhHgY31E/eoDZTp9+wqz0JcSCoHGnvUj68/O4laA2TQuIHrGLU9EgHTKklPtVAhDsIDVgTEPenPzjNLdulBS5EA8tgLeMtMZzuRpsASlyGGcr0//7+Ry8ek5/tfNWiVC5V0WlqhoDEp7hw4w==\" />
      <input type=\"image\" src=\"https://test.bitpay.com/cdn/en_US/bp-btn-pay-currencies.svg\" name=\"submit\" style=\"width: 210px\" alt=\"BitPay, the easy way to pay with bitcoins.\">
    </form>
    <form action=\"upload.php\" method=\"post\" enctype=\"multipart/form-data\">
      Select image to upload:
      <input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\">
                <p><button name=\"echeck\" type=\"submit\" id=\"checkout-button\">Pay With Echeck</button></p>
    </form>
            <form action=\"../save.php\" method=\"POST\">
		<select name='destination'>
			<option value='0'>Personal</optional>
			<option value='1'>For Store</optional>
		</select>
                <p><button name=\"submit\" type=\"submit\" id=\"checkout-button\">Traditional Checkout</button></p>
            </form>
            <!-- Load Facebook SDK for JavaScript -->
        </div>
    </body>
    <html>
    
    ";
    fwrite($file, $text);
    fclose($file);

    $object->set("product_link", $file_link);

	try {
   	 $object->save();
	 echo "Object link added<br/>";
	} catch (ParseException $ex) {  
  // Execute any logic that should take place if the save fails.
  // error is a ParseException object with an error code and message.
  	echo 'Failed to create new object, with error message: ' . $ex->getMessage();
	}

    echo "Successfully created ".$id."html<br/>";



}



?>
