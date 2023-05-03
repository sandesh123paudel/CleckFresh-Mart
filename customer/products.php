<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/indexs.css" />

</head>
<body>
    <div class="nav-bar">
        <?php
            require('navbar.php');
        ?>
    </div>
    
    <div class="product-container">
        <div class="product-header">
            <h3> <?php 
                if(isset($_GET['cat_id'])){
                    $sql='SELECT CATEGORY_NAME FROM CATEGORY WHERE CATEGORY_ID= :c_id';
                    $stid = oci_parse($connection,$sql);
                    oci_bind_by_name($stid,':c_id' ,$_GET['cat_id']);
                    oci_execute($stid);
                    while($row = oci_fetch_array($stid,OCI_ASSOC)){
                        $cat_name = $row['CATEGORY_NAME'];
                    }
                }
                if(isset($_GET['cat_name'])){
                    $cat_name = $_GET['cat_name'];
                }
                
                echo "<span>".strtoupper($cat_name)."</span>";

            ?> Products Lists </h3>
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
                $category_id =$row['CATEGORY_ID'];
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


                echo "<div class='single' >";
                    echo "<div class='img' onclick='viewproduct($product_id)'>";
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
                                echo "<span class='main'>&pound; ".$product_price."</span>";
                            }

                        echo "</div>";

                        if((int)$product_stock <= 0 ){
                            echo "<div class='btn' id='outstock' >Add +</div>";
                        }
                        else{

                            echo "<div class='btn' onclick='addtocart($product_id)'>Add +</div>";
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

    <script>
        function viewproduct(p_id){
            window.location.href="productview.php?p_id="+p_id;
        }
    </script>

<script src="addtocart.js"></script>

</body>
</html>