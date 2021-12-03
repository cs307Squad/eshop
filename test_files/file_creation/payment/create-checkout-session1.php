<?php

require 'vendor/autoload.php';
\Stripe\Stripe::setApiKey('sk_test_51JgKEBJytYJMwZffQlyBWq1QGaA705mTU6g1reBu5WW1hVuHC1o0IcpqdxRLWBGaX26wgcc99mC8W63bjrEA2bzI002UMB8ahG');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://34.125.248.39/DemoProduct/product_pages/';

$stripe = new \Stripe\StripeClient(
  'sk_test_51JgKEBJytYJMwZffQlyBWq1QGaA705mTU6g1reBu5WW1hVuHC1o0IcpqdxRLWBGaX26wgcc99mC8W63bjrEA2bzI002UMB8ahG'
);
$stripe->customers->create([
  'description' => 'First Customer',
]);



$checkout_session = \Stripe\Checkout\Session::create([
  'line_items' => [[
    # TODO: replace this with the `price` of the product you want to sell
    'price' => 'price_1K2jNyJytYJMwZff7oPlnw0j',
    'quantity' => 1,
  ]],
  'payment_method_types' => [
    'card',
  ],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . 'checkout.php',
  'cancel_url' => $YOUR_DOMAIN . '../get_inventory1.php',
]);

$myfile = fopen("testfile.txt", "w");
fwrite($myfile, $checkout_session->url);
fclose($myfile);
header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);

?>
