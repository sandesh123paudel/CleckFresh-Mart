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

    <link rel="stylesheet" href="css/products.css" />

</head>
<body>
    
<div class='nav-bar'>
    <?php
        require("navbar.php");
    ?>
</div>

    <div class="product-container">
        <div class="product-detail">
            <div class="product-part1">
                <div class="product-image">
                    <img src="../logo/apple2.webp" alt="apple" />
                </div>
                <div class="product-samples">
                    <img src="../logo/apple2.webp" alt="apple" />
                    <img src="../logo/apple2.webp" alt="apple" />
                    <img src="../logo/apple2.webp" alt="apple" />
                    <img src="../logo/apple2.webp" alt="apple" />
                </div>
            </div>
            <!-- product ingo -->
            <div class="product-part2">
                <!-- shop details -->
                <div class="product-shop">
                    <h5>Zappa</h5>
                    <div class="shop-info">
                        <h3>Zappa</h3>
                        <p>We sell green groceries</p>
                    </div>
                </div>
                <!-- product-name -->
                <h2>Natural Greenery Apples</h2>
                <span>500g</span>
                <div class="product-price">
                    <h3> &#8356; 20.00</h3>
                </div>
                <span>Available Stocks : 20</span>
                <div class="product-quantity">
                    <h4>Quantity :</h4>
                    <button>-</button>
                    <h4>1</h4>
                    <button>+</button>
                </div>

                <div class="buttons">
                    <button>Add to basket</button>
                    <button>Add to List &#9825; </button>
                </div>
                
            </div>
        </div>
        <!-- description -->
        <div class="product-desc">
            <h3>Description :</h3>
            <p>
                Lorem ipsum dolor sit amet, consectertur adipiscing elite. cras lacus metus, convallis ut leo nec, tincidunt elite justo, Ut felies
                orci, hendrerit a pulvinar et, gravida ac lerom.Quickly Build a Website With Our Unified Platform. Grow Your Business With Shopify®.
                 Easily Create a Website With Our Unified Platform. Start a Free Trial Now! Drop Shipping Integration. Mobile Commerce Ready. Social 
                 Media Integration. Fraud Prevention.
            </p>
            <p>
                Lorem ipsum dolor sit amet, consectertur adipiscing elite. cras lacus metus, convallis ut leo nec, tincidunt elite justo, Ut felies
                orci, hendrerit a pulvinar et, gravida ac lerom.Quickly Build a Website With Our Unified Platform. Grow Your Business With Shopify®. 
                Easily Create a Website With Our Unified Platform. Start a Free Trial Now! Drop Shipping Integration. Mobile Commerce Ready. Social
                Media Integration. Fraud Prevention.
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
                        $sql='SELECT * FROM PRODUCT';
                        $stid = oci_parse($connection,$sql);
                        oci_execute($stid);

                        while($row = oci_fetch_array($stid,OCI_ASSOC)){
                            $product_name=$row['PRODUCT_NAME'];
                            $product_id = $row['PRODUCT_ID'];
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

                            
                            echo "<div class='single'>";
                                echo "<div class='img'>";
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
        </div>
    </div>

    <?php
        require("footer.php");
    ?>
</body>
</html>