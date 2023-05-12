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
            // api url
            $data = array(
                'id' => '1002',
                'filter' => 'SHOP_ID'
            );

            $json_data = json_encode($data);

            $ch = curl_init('http://localhost/learning/karan/api/api_fetch_single.php');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt(
                $ch,
                CURLOPT_HTTPHEADER,
                array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($json_data)
                )
            );

            $result = curl_exec($ch);
            $products = json_decode($result, true);


            $products = array_slice($products, 0, 5);

            foreach ($products as $product) {

                echo "<div class='single' >";
                echo "<div class='img' >";
                echo "<img src=\"../db/uploads/products/" . $product['PRODUCT_IMAGE'] . "\" alt='' /> ";
                //    echo "<div class='tag'>";


                // echo "</div>";    
                echo "</div>";
                echo "<div class='content'>";
                echo "<h5>" .  $product['PRODUCT_NAME'] . "</h5>";
                echo "<span class='piece'>" . $product['PRODUCT_PRICE'] . " gm </span>";
                echo "<div class='price'>";
                echo $product['QUANTITY'];
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