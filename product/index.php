<?php

    if(isset($_COOKIE["product"])) {
        $id = $_COOKIE["product"];

        $query = "select * from Product where Product_Code = '$id'";
        $result = mysqli_query($conn, $query);
        if(!$result){
            echo $conn->error;
        }else{

            $prod = $result->fetch_assoc();
            $prodname = $prod['Name'];
            $image = $prod['Image_Url'];
            $price = $prod['Price'];
            $description = $prod['Description'];


            echo"
            
            <!DOCTYPE html>
            <html>
            
            <head>
                <meta charset='utf-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1'>
                <title>Tutorial</title>
                <!-- Fonts -->
                <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet'>
                <link href='style.css' rel='stylesheet'>
                <meta name='robots' content='noindex,follow' />
            
            </head>
            
            <body>
                <main class='container'>
            
            
                    <!-- Right Column -->
                    <div class='right-column'>
            
                        <!-- Product Description -->
                        <div class='product-description'>
                        <div class='right-column'>

                        <!-- Product Description -->
                        <div class='product-description'>
                            <span>$prodname</span>
                            <h1>$prodname EP</h1>
                            <p>$description</p>
                        </div>
                        </div>

                        <!-- Product Pricing -->
                        <div class='product-price'>
                            <span>$$price</span>
                            <a href='#' class='cart-btn'>Add to cart</a>
                        </div>
                        </div>
                    </main>
                
                    <!-- Scripts -->
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js' charset='utf-8'></script>
                    <script src='script.js' charset='utf-8'></script>
                </body>
                
                </html>
            

            ";

        }

        // header("Location:home.php");
    }

?>