<?php

// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md
require_once 'vendor/autoload.php';

use Twilio\Rest\Client;

// Find your Account SID and Auth Token at twilio.com/console
// and set the environment variables. See http://twil.io/secure
$sid = getenv("TWILIO_ACCOUNT_SID");
$token = getenv("TWILIO_AUTH_TOKEN");
$twilio = new Client($sid, $token);

$message = $twilio->messages
 ->create("+17654254610", // to
                           [
                               "body" => "This is a test purchase echeck from eshop",
                               "from" => "+12178852381",
                               "mediaUrl" => ["http://34.125.248.39/eshop/product_pages/uploads/sample_image.png"]
                  ]
                  );
print($message->sid);
