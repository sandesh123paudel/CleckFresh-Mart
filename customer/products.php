<!-- <?php

    if(isset($_GET['p_id'])){
        echo $_GET['p_id'];
    }
?> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/indeex.css" />

</head>
<body>
    <div class="nav-bar">
        <?php
            require('navbar.php');
        ?>
    </div>
    
    <div class="product-container">
        <div class="product-header">
            <h3>Product Lists of <?php 
                $sql='SELECT CATEGORY_NAME FROM CATEGORY WHERE CATEGORY_ID= :c_id';
                $stid = oci_parse($connection,$sql);
                oci_bind_by_name($stid,':c_id' ,$_GET['cat_id']);
                oci_execute($stid);
                while($row = oci_fetch_array($stid,OCI_ASSOC)){
                    $cat_name = $row['CATEGORY_NAME'];
                }
                echo strtoupper($cat_name);
            ?></h3>
        </div>

    <div class="product-lists">

        <?php
            if(isset($_GET['cat_id'])){
                $sql='SELECT * FROM PRODUCT WHERE CATEGORY_ID= :c_id';
                $stid = oci_parse($connection,$sql);
                oci_bind_by_name($stid, ':c_id' ,$_GET['cat_id']);
            }
            else{
                $sql='SELECT * FROM PRODUCT';
                $stid = oci_parse($connection,$sql);
            }
           
            oci_execute($stid);
            
            while($row = oci_fetch_array($stid,OCI_ASSOC)){
                $product_name=$row['PRODUCT_NAME'];
                $product_id = $row['PRODUCT_ID'];
                $product_category = $row['PRODUCT_TYPE'];
                $product_quantity = $row['QUANTITY'];
                $product_image = $row['PRODUCT_IMAGE'];
                $product_price = $row['PRODUCT_PRICE'];
                if(!empty($row['OFFER_ID'])){
                    $product_offer = $row['OFFER_ID'];
                }
                else{
                    $product_offer='';
                }
                $product_stock = $row['STOCK_NUMBER'];


                echo "<div class='single' onclick='viewproduct($product_id)'>";
                    echo "<div class='img'>";
                        echo "<img src=\"../db/uploads/products/".$product_image."\" alt='$product_name' /> ";
                        //    echo "<div class='tag'>";
                            if(!empty($product_offer)){
                                echo "<div class='offer'>Offer</div>";
                            }
                            else{
                                echo "";
                            }

                            if((int)$product_stock <= 0 ){
                                echo "<div class='outofstock'>out of stock</div>";
                            }
                            else{
                                echo "";
                            }
                            // echo "</div>";    
                    echo "</div>";
                    echo "<div class='content'>";
                        echo "<h5>".$product_name."</h5>";
                        echo "<span class='piece'>".$product_quantity." gm </span>";
                        echo "<div class='price'>";
                            if($product_offer){
                                echo "<span class='cut'>$50.00</span>";
                            }
                            else{
                                echo "<span class='main'>$ ".$product_price."</span>";
                            }

                        echo "</div>";

                        if((int)$product_stock <= 0 ){
                            echo "<a href='#'><div class='btn' id='outstock' >Add +</div></a>";
                        }
                        else{
                            echo "<a href='productview.php?id=$product_id&cat=$product_category'><div class='btn'>Add +</div></a>";
                        }

                    echo "</div>";
                echo "</div>";
            }

        ?>

    </div>

    </div>

    <?php
        require('footer.php');
    ?>  

    <!-- <script>
        function viewproduct(p_id){
            var product_id = p_id;
            window.location.href="products.php?p_id=product_id";
        }
    </script> -->
</body>
</html>