<?php

if(isset($_POST['submit'])){
            $cookie_name = "product";
            $cookie_value = 196;
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
            header("Location:checkout.php");
}

echo"


<!DOCTYPE html>
<html>

<head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title>Women's Buttery Soft High Waisted Yoga Pants</title>
    <link href=\"style.css\" rel=\"stylesheet\">
</head>

<body>

    <div class=\"card\">
        <img src=\"https://images-na.ssl-images-amazon.com/images/I/71cR4LGejFS._AC_UL200_SR200,200_.jpg\" alt=\"Denim Jeans\" style=\"width:100%\">
        <h1>Colorfulkoala Women's Buttery Soft High Waisted Yoga Pants</h1>
        <p class=\"price\">$264</p>
        <p>Colorfulkoala Women's Buttery Soft High Waisted Yoga Pants Full-Length Leggings</p>

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
        <div class=\"fb-share-button\" data-href=\"http://34.125.248.39/DemoProduct/product_pages/3.html\" data-layout=\"button_count\">
        </div><br/>


        <form action=\"create-checkout-session2.php\" method=\"POST\">
            <p><button name=\"submit\" type=\"submit\" id=\"checkout-button\">Checkout</button></p>
        </form>
    </div>

</body>
<html>
";
?>
