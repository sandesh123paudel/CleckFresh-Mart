<?php
  include('../db/connection.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="css/productsvi.css" />

</head>
<body>
    
<div class='nav-bar'>
    <?php
        require("navbar.php");
    ?>
</div>


    <?php
        
        $sql = "SELECT * FROM PRODUCT WHERE PRODUCT_ID= :p_id";
        $stid = oci_parse($connection,$sql);
        oci_bind_by_name($stid, ":p_id" ,$_GET['p_id']);
        
        oci_execute($stid);
        while($row = oci_fetch_array($stid,OCI_ASSOC)){
            $p_id = $row['PRODUCT_ID'];
            $p_category = $row['CATEGORY_ID'];
            $p_shop = $row['SHOP_ID'];
            $p_offer = $row['OFFER_ID'];
            $p_name = $row['PRODUCT_NAME'];
            $p_price = $row['PRODUCT_PRICE'];
            $p_type = $row['PRODUCT_TYPE'];
            $p_description = $row['PRODUCT_DESCP'];
            $p_quantity = $row['QUANTITY'];
            $p_stock = $row['STOCK_NUMBER'];
            $p_image = $row['PRODUCT_IMAGE'];
        }

    ?>

    <div class="product-container">
        <div class="product-detail">
            <div class="product-part1">
                <div class="product-image">
                    <?php
                        echo "<img src=\"../db/uploads/products/".$p_image."\" alt='$p_name' /> ";
                    ?>
                </div>
                <div class="product-samples">
                    <?php
                        echo "<img src=\"../db/uploads/products/".$p_image."\" alt='$p_name' /> ";
                        echo "<img src=\"../db/uploads/products/".$p_image."\" alt='$p_name' /> ";
                        echo "<img src=\"../db/uploads/products/".$p_image."\" alt='$p_name' /> ";
                        echo "<img src=\"../db/uploads/products/".$p_image."\" alt='$p_name' /> ";

                    ?>
                </div>
            </div>
            <!-- product info -->
            <div class="product-part2">
                <!-- shop details -->
                <div class="product-shop">
                    <!-- <h5>Zappa</h5> -->
                    <?php
                    
                        $sql = "SELECT * FROM SHOP WHERE SHOP_ID= :s_id";
                        $stid = oci_parse($connection,$sql);
                        oci_bind_by_name($stid, ":s_id" ,$p_shop);
                        
                        oci_execute($stid);
                        while($row = oci_fetch_array($stid,OCI_ASSOC)){
                            $shop_logo = $row['SHOP_LOGO'];
                            $shop_name = $row['SHOP_NAME'];
                            $shop_desc = $row['SHOP_DESC'];
                            
                        }
                        echo "<img class='shop-logo' src=\"../db/uploads/shops/".$shop_logo."\" alt='$shop_name'  /> ";
                    ?>

                    <div class="shop-info">
                        <?php echo "<h3>$shop_name</h3>"; ?>
                        <p><?php echo "$shop_desc"; ?></p>
                    </div>
                </div>
                <!-- product-name -->
                <h2><?php  echo $p_name; ?></h2>
                <span>
                    <?php
                        echo $p_quantity;
                    ?>
                    gm
                </span>
                <div class="product-price">
                    <?php
                        if($p_offer){
                                // echo $product_offer;
                            $sql = "SELECT OFFER_PERCENTAGE , OFFER_NAME FROM OFFER WHERE OFFER_ID = :offer_id";
                            $stmt = oci_parse($connection, $sql);
                            oci_bind_by_name($stmt, ":offer_id" ,$p_offer);
                            oci_execute($stmt);
                            $row =oci_fetch_array($stmt,OCI_ASSOC);
                            $discount = (int)$row['OFFER_PERCENTAGE'];
                            $total_price =  $p_price -  $p_price*($discount/100);

                            echo "<span class='cut'>&pound;". $p_price."</span>";
                            echo "<span class='main'>&pound;".$total_price."</span>";
                            echo "<span class='offer_name'>".$row['OFFER_NAME']." (".$discount."%)</span>";
                        }
                        else{
                            echo "<span class='main'>&pound; ". $p_price."</span>";
                        }
                    ?>

                </div>
                <span>Available Stocks : 
                    <?php 
                        if($p_stock <=0){
                            echo "out of stock";
                        }
                        else{
                            echo $p_stock . "KG";
                        }
                        
                    ?>
                </span>
                <div class="product-quantity">
                    <h4>Quantity :</h4>
                    <button >-</button>
                    <h4>
                        1
                    </h4>
                    <button>+</button>
                </div>

                <div class="buttons">
                    <?php
                    echo "<button>Add to basket</button>";
                    echo "<button >Add to List &#9825; </button>";

                    ?>
                </div>
                
            </div>
        </div>
        <!-- description -->
        <div class="product-desc">
            <h3>Description :</h3>           
            <p>
                <?php
                    echo $p_description;    
                ?>
            </p>
        </div>

        <!-- rating -->
        <div class="product-rating">
            <h3>Add Rating</h3>
            <div class="product-stars">
                <div class="stars">
                    <span class="material-symbols-outlined">
                        star
                    </span>
                    <span class="material-symbols-outlined">
                        star
                    </span>
                    <span class="material-symbols-outlined">
                        star
                    </span>
                    <span class="material-symbols-outlined">
                        star
                    </span>
                    <span class="material-symbols-outlined">
                        star
                    </span>
                </div>
                <button>Add Stars</button>
            </div>
            
        </div>

        <!-- reviews -->
        <div class="product-reviews">
            <h3>Product Review:</h3>

            <div class="display-review">
                <label>Karan Chaudhary: </label>
                <p>
                    Lorem ipsum dolor sit amet, consectertur adipiscing elite. cras lacus metus, convallis ut leo nec, tincidunt elite justo, Ut felies
                    orci, hendrerit a pulvinar et, gravida ac lerom.Quickly Build a Website With Our Unified Platform. Grow Your Business With Shopify®. 
                    Easily Create a Website With Our Unified Platform. Start a Free Trial Now! Drop Shipping Integration. Mobile Commerce Ready. Social
                    Media Integration. Fraud Prevention.
                </p>
            </div>

            <div class="write-review">
                <textarea name="reviews" id=""  Placeholder="Write your reviews....." ></textarea>
                <button>Add Review</button>
            </div>
        </div>

        <!-- prodcuts -->
        <div class="display-product">
            <div class="product-view">
                <h3>More Products From This Shop</h3>
                <a href="#">See All >> </a>
            </div>
            
                <div class="product-lists">

                    <?php
                        $sql='SELECT * FROM PRODUCT WHERE SHOP_ID = :s_id';
                        $stid = oci_parse($connection,$sql);
                        oci_bind_by_name($stid ,':s_id' ,$p_shop);
                        oci_execute($stid);

                        while($row = oci_fetch_array($stid,OCI_ASSOC)){
                            $product_name=$row['PRODUCT_NAME'];
                            $product_id = $row['PRODUCT_ID'];
                            $category_id = $row['CATEGORY_ID'];
                            $product_category = $row['PRODUCT_TYPE'];
                            $product_quantity = $row['QUANTITY'];
                            $product_image = $row['PRODUCT_IMAGE'];
                            $product_price = $row['PRODUCT_PRICE'];
                            $product_stock = $row['STOCK_NUMBER'];

                            if(!empty($row['OFFER_ID'])){
                                $product_offer = $row['OFFER_ID'];
                            }
                            else{
                                $product_offer='';
                            }

                            
                            echo "<div class='single'  >";
                                echo "<div class='img' onclick='viewproduct($product_id)'>";
                                    echo "<img src=\"../db/uploads/products/".$product_image."\" alt='$product_name' /> ";
                                    // echo "<div class='tag'>";
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
                                    echo "<span class='piece'>".$product_quantity." gm</span>";
                                    echo "<div class='price'>";
                                    if($product_offer){
                                        // echo $product_offer;
                                        $sql = "SELECT OFFER_PERCENTAGE FROM OFFER WHERE OFFER_ID = :offer_id";
                                        $stmt = oci_parse($connection, $sql);
                                        oci_bind_by_name($stmt, ":offer_id" ,$product_offer);
                                        oci_execute($stmt);
                                        $row =oci_fetch_array($stmt,OCI_ASSOC);
                                        $discount = (int)$row['OFFER_PERCENTAGE'];
                                        $total_price = $product_price - $product_price*($discount/100);
        
                                        echo "<span class='cut'>&pound;".$product_price."</span>";
                                        echo "<span class='main'>&pound;".$total_price."</span>";
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
        </div>
    </div>

    <?php
        require("footer.php");
    ?>



<script>
        function viewproduct(p_id){
            window.location.href="productview.php?p_id="+p_id;
        }
</script>

</body>
</html>