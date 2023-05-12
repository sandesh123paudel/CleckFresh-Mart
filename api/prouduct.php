<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../customer/css/indexs.css" />
    <!--jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>



</head>

<body>

    <div class="product-container">
        <div class="product-header">
            <h3> Products Lists </h3>
        </div>

        <div class="product-lists">

            <?php

            $rest_api_url = 'http://localhost/learning/karan/api/api_fetch_all.php';
            // $rest_api_url = 'http://localhost/learning/karan/api/api_fetch_single.php';

            // Reads the JSON file.
            $json_data = file_get_contents($rest_api_url);

            // Decodes the JSON data into a PHP array.
            $response_data = json_decode($json_data);

            // All the users data exists in 'data' object
            $products = $response_data;

            // It cuts the long data into small & select only the first 5 records.
            $products=array_slice($products,0,10);

            // It traverses the array and display user data
            foreach ($products as $product) {

                echo "<div class='single' >";
                echo "<div class='img' >";
                echo "<img src=\"../db/uploads/products/" . $product->PRODUCT_IMAGE . "\" alt='' /> ";
                //    echo "<div class='tag'>";


                // echo "</div>";    
                echo "</div>";
                echo "<div class='content'>";
                echo "<h5>" .  $product->PRODUCT_IMAGE . "</h5>";
                echo "<span class='piece'>" . $product->PRODUCT_NAME . " gm </span>";
                echo "<div class='price'>";
                echo  $product->PRODUCT_PRICE;
                echo "</div>";
                echo "<input type='hidden' data-quantity='1' >";

                echo "<div class='btn' id='outstock' >Add +</div>";

                echo "</div>";
                echo "</div>";
            }
            ?>

        </div>

    </div>

</body>

</html>