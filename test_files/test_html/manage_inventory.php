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

echo "

<!DOCTYPE html>
<html lang='en'>
<head>
	<title>Inventory</title>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
<!--===============================================================================================-->	
	<link rel='icon' type='image/png' href='images/icons/favicon.ico'/>
<!--===============================================================================================-->
	<link rel='stylesheet' type='text/css' href='vendor/bootstrap/css/bootstrap.min.css'>
<!--===============================================================================================-->
	<link rel='stylesheet' type='text/css' href='fonts/font-awesome-4.7.0/css/font-awesome.min.css'>
<!--===============================================================================================-->
	<link rel='stylesheet' type='text/css' href='vendor/animate/animate.css'>
<!--===============================================================================================-->
	<link rel='stylesheet' type='text/css' href='vendor/select2/select2.min.css'>
<!--===============================================================================================-->
	<link rel='stylesheet' type='text/css' href='vendor/perfect-scrollbar/perfect-scrollbar.css'>
<!--===============================================================================================-->
	<link rel='stylesheet' type='text/css' href='css/util.css'>
	<link rel='stylesheet' type='text/css' href='css/main.css'>
<!--===============================================================================================-->
</head>
<body>

	<button><a href='database/pick.html'>Upload Inventory</a></button><br/>
	<button><a href='file_creation/create_files.php'>Create Product Pages</a></button>
	<form method='POST' action='save_product.php'> 
	<div class='limiter'>
		<div class='container-table100'>
			<div class='wrap-table100'>
				<div class='table100 ver1 m-b-110'>
					<table data-vertable='ver1'>
						<thead>
							<tr class='row100 head'>
								<th class='column100 column1' data-column='column1'></th>
								<th class='column100 column2' data-column='column2'>Product Name</th>
								<th class='column100 column3' data-column='column3'>Raw Price</th>
								<th class='column100 column4' data-column='column4'>Discount</th>
								<th class='column100 column5' data-column='column5'>Total Purchases</th>
								<th class='column100 column6' data-column='column6'>Product Page</th>
								<th class='column100 column7' data-column='column7'>Inventory</th>
								<th class='column100 column8' data-column='column8'>Action</th>
							</tr>
						</thead>
						<tbody>

";

$query = new ParseQuery("Inventory");
$query->limit(100);
$results = $query->find();
for($i = 0; $i < count($results); $i++){
    $object = $results[$i];
    $name = $object->get("name");
    $price = $object->get("raw_price");
    $discount = $object->get("discount");
    $purchases = $object->get("purchases");
    $page_link = $object->get("product_link");
    $category = $object->get("subcategory");
    $total = $object->get("total");
    echo "
        <tr class='row100'>
            <td class='column100 column1' data-column='column1'></td>
            <td class='column100 column2' data-column='column2'>".$name."<br/><input type='text' name='name$i' placeholder='new_value'/></td>
            <td class='column100 column3' data-column='column3'>".$price."<br/><input type='text' name='price$i' placeholder='new_value'/></td>
            <td class='column100 column4' data-column='column4'>".$discount."<br/><input type='text' name='discount$i' placeholder='new_value'/></td>
            <td class='column100 column5' data-column='column5'>".$purchases."<br/><input type='text' name='purchases$i' placeholder='new_value'/></td>
            <td class='column100 column6' data-column='column6'>".$page_link."<br/><input type='text' name='page_link$i' placeholder='new_value'/></td>
            <td class='column100 column7' data-column='column7'>".$total."<br/><input type='text' name='total$i' placeholder='new_value'/></td>
            <td class='column100 column8' data-column='column8'><input type='submit' name='submit$i' value='Save' /></td>
    </tr>
    ";


}

echo "</tbody></table>
</div></div></div></div></form></body></html>
";

?>
