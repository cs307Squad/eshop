<?php

	    $cookie_name = "product";
            $cookie_value = "Tailored Jeans";
	    $price_name = "price";
	    $price_value = 390;
	    $index_name = "index";
	    $index = 194;
	    $customer_name = "customer";
	    $customer_value = "1";


            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
            setcookie($price_name, $price_value, time() + (86400 * 30), "/");
            setcookie($index_name, $index, time() + (86400 * 30), "/");
            setcookie($customer_name, $customer_value, time() + (86400 * 30), "/");
//	    header("Location:checkout.php");

echo"
<!DOCTYPE html>
<html>

<head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title>WIHOLL Womens Tops V Neck Summer Petal Sleeve Casual</title>
    <link href=\"style.css\" rel=\"stylesheet\">
</head>

<body>

    <div class=\"card\">
        <img src=\"https://images-na.ssl-images-amazon.com/images/I/51vrIA7y1cL._AC_UL200_SR200,200_.jpg\" alt=\"Denim Jeans\" style=\"width:100%\">
        <h1>Tailored Jeans</h1>
        <p class=\"price\">$390</p>
        <p>WIHOLL Womens Tops V Neck Summer Petal Sleeve Casual Tshirts</p>

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
        <div class=\"fb-share-button\" data-href=\"http://34.125.248.39/DemoProduct/product_pages/1.html\" data-layout=\"button_count\">
        </div><br/>

        <form action=\"create-checkout-session.php\" method=\"POST\">
            <p><button name=\"submit\" type=\"submit\" id=\"checkout-button\">Checkout</button></p>
        </form>
        <!-- Load Facebook SDK for JavaScript -->

    </div>

</body>
<html>
";
?>
