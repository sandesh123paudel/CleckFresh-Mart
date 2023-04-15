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

    <link rel="stylesheet" href="css/prodve.css" />
</head>
<body>
    
<div class='navbar'>
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
                <h4>Karan Chaudhary: </h4>
                <p>
                    Lorem ipsum dolor sit amet, consectertur adipiscing elite. cras lacus metus, convallis ut leo nec, tincidunt elite justo, Ut felies
                    orci, hendrerit a pulvinar et, gravida ac lerom.Quickly Build a Website With Our Unified Platform. Grow Your Business With Shopify®. 
                    Easily Create a Website With Our Unified Platform. Start a Free Trial Now! Drop Shipping Integration. Mobile Commerce Ready. Social
                    Media Integration. Fraud Prevention.
                </p>
            </div>

            <div class="write-review">
                <input type="textarea"  placeholder="Write Your reviews.."/>
                <button>Add Review</button>
            </div>
        </div>

        <!-- prodcuts -->
        <div class="display-product">
            <div class="product-view">
                <h3>More Products From This Shop</h3>
                <a href="#">See All >> </a>
            </div>
            
            <div class="product-related">
                <div class="product-info">
                    <img src="../logo/apple2.webp" alt="product" />
                    <h3>Red Apple</h3>
                    <h4>500g</h4>
                    <div class="product-pp">
                        <h3> &#8356; 20.00</h3>
                        <h3> &#8356; 20.00</h3>
                        <!-- discount price -->
                    </div>
                    <button>ADD +</button>

                    <div class="offer">
                        <p>out of stock</p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php
        require("footer.php");
    ?>
</body>
</html>