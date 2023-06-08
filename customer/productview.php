<?php
include('../db/connection.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product View</title>
    <link rel="icon" href="../assets/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <style>
        .product-quantity h3 {
            margin-top: -3px;
            margin-left: 5px;
        }

        .product-quantity #quantity {
            border: none;
            outline: none;
            width: 30px;
            font-weight: 600;
            background: transparent;

        }
    </style>
</head>

<body>

    <div class='nav-bar'>
        <?php
        require("navbar.php");
        ?>
    </div>

    <?php
    $sql = "SELECT * FROM PRODUCT WHERE PRODUCT_ID= :p_id";
    $stid = oci_parse($connection, $sql);
    oci_bind_by_name($stid, ":p_id", $_GET['p_id']);

    oci_execute($stid);
    while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
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

    <div class="productview-container">
        <div class="product-detail">
            <div class="product-part1">
                <div class="product-image">
                    <?php
                    echo "<img src=\"../db/uploads/products/" . $p_image . "\" alt='$p_name' /> ";
                    ?>
                </div>
                <div class="product-samples">
                    <?php
                    echo "<img src=\"../db/uploads/products/" . $p_image . "\" alt='$p_name' /> ";
                    echo "<img src=\"../db/uploads/products/" . $p_image . "\" alt='$p_name' /> ";
                    echo "<img src=\"../db/uploads/products/" . $p_image . "\" alt='$p_name' /> ";
                    echo "<img src=\"../db/uploads/products/" . $p_image . "\" alt='$p_name' /> ";

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
                    $stid = oci_parse($connection, $sql);
                    oci_bind_by_name($stid, ":s_id", $p_shop);

                    oci_execute($stid);
                    while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
                        $shop_logo = $row['SHOP_LOGO'];
                        $shop_name = $row['SHOP_NAME'];
                        $shop_desc = $row['SHOP_DESC'];
                    }
                    echo "<img class='shop-logo' src=\"../db/uploads/shops/" . $shop_logo . "\" alt='$shop_name'  /> ";
                    ?>

                    <div class="shop-info">
                        <?php
                        echo "<h3>" . ucfirst($shop_name) . "</h3>";

                        echo "<p>" . $shop_desc . "</p>";
                        ?>
                    </div>
                </div>
                <!-- product-name -->
                <?php
                $count = $ratecount = $rating = 1;
                $sql = "SELECT r.*
                            FROM REVIEW r
                            JOIN USER_I u ON r.USER_ID = u.USER_ID
                            WHERE r.PRODUCT_ID = :product_id";
                $stid = oci_parse($connection, $sql);
                oci_bind_by_name($stid, ":product_id", $p_id);
                oci_execute($stid);
                while ($data = oci_fetch_array($stid)) {
                    $count += 1;
                    if (!empty($data['RATING'])) {
                        $rating = (int)$data['RATING'];
                    }
                    $ratecount += $rating;
                }
                $ratecount = number_format(($ratecount / $count), 1);
                echo "<span class='offer_name'>Rating\t($ratecount)</span>";
                ?>
                <h2><?php echo ucfirst($p_name); ?></h2>
                <span>
                    <?php
                    echo $p_quantity;
                    ?>
                    gm
                </span>
                <div class="product-price">
                    <?php
                    if ($p_offer) {
                        // echo $product_offer;
                        $sql = "SELECT OFFER_PERCENTAGE , OFFER_NAME FROM OFFER WHERE OFFER_ID = :offer_id";
                        $stmt = oci_parse($connection, $sql);
                        oci_bind_by_name($stmt, ":offer_id", $p_offer);
                        oci_execute($stmt);
                        $row = oci_fetch_array($stmt, OCI_ASSOC);
                        $discount = (int)$row['OFFER_PERCENTAGE'];
                        $total_price =  $p_price -  $p_price * ($discount / 100);

                        echo "<span class='cut'>&pound;" . $p_price . "</span>";
                        echo "<span class='main'>&pound;" . $total_price . "</span>";
                        echo "<span class='offer_name'>" . $row['OFFER_NAME'] . " (" . $discount . "%)</span>";
                    } else {
                        echo "<span class='main'>&pound; " . $p_price . "</span>";
                    }
                    ?>

                </div>
                <span>Available Stocks :
                    <?php
                    if ($p_stock <= 0) {
                        echo "out of stock";
                    } else {
                        echo $p_stock;
                    }

                    ?>
                </span>

                <div class="product-quantity">
                    <h4>Quantity :</h4>
                    <button onclick="removequantity()">-</button>
                    <h3>
                        <input type='hidden' value='<?php echo $p_id; ?>' id='product_id'>
                        <input type="text" min="1" value='1' id='quantity' disabled>
                    </h3>
                    <?php

                    echo "<button onclick='addedquantity($p_stock)'>+</button>";
                    ?>
                </div>

                <div class="buttons">
                    <?php
                    // echo "<button>Add to basket</button>";
                    // add to cart
                    if ($p_stock <= 0) {
                        echo "<button id='outstock'>Add to Basket</button>";
                    } else {
                        if (isset($_SESSION['userID'])) {
                            echo "<button  id='add' onclick='add_database()'>Add to Basket</button>";
                        } else {
                            echo "<button  id='addcart' onclick='add_session()'>Add to Basket</button>";
                        }
                    }


                    //add to wishlist
                    // echo "<button >Add to List &#9825; </button>";
                    if (isset($_SESSION['userID'])) {
                        echo "<button  id='add' onclick='addtowishlist($p_id)'>Add to List &#9825; </button>";
                    } else {
                        echo "<button  id='addwishlist' onclick='addwishlist($p_id)'>Add to List &#9825;</button>";
                    }

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
                <?php
                if (isset($_SESSION['userID'])) {
                    $user_id = $_SESSION['userID'];
                } else {
                    $user_id = '-';
                }

                echo "
                <div class='stars'>
                    <span class='material-symbols-outlined' onclick='rating(1,$p_id,$user_id)'>
                        star
                    </span>
                    <span class='material-symbols-outlined' onclick='rating(2,$p_id,$user_id)'>
                        star
                    </span>
                    <span class='material-symbols-outlined' onclick='rating(3,$p_id,$user_id)'>
                        star
                    </span>
                    <span class='material-symbols-outlined' onclick='rating(4,$p_id,$user_id)'>
                        star
                    </span>
                    <span class='material-symbols-outlined' onclick='rating(5,$p_id,$user_id)'>
                        star
                    </span>
                </div>";

                if (isset($_SESSION['userID'])) {
                    echo "<button onclick='addrating()'>Add Stars</button>";
                } else {
                    echo "<button onclick='login()'>Add Stars</button>";
                }
                ?>
            </div>
        </div>

        <!-- reviews -->
        <div class='product-reviews'>
            <h3>Product Review:</h3>

            <?php
            $sql = "SELECT R.*, U.*
                    FROM REVIEW R
                    JOIN USER_I U ON R.USER_ID = U.USER_ID
                    WHERE R.PRODUCT_ID = :product_id";
            $stid = oci_parse($connection, $sql);
            oci_bind_by_name($stid, ":product_id", $p_id);
            oci_execute($stid);
            while ($row = oci_fetch_array($stid)) {
                if (!empty($row['REVIEW_DESCRIPTION'])) {
                    $username = $row['FIRST_NAME'] . " " . $row['LAST_NAME'];
                    $review = $row['REVIEW_DESCRIPTION'];

                    echo "<div class='display-review'>";
                    echo " <label>$username: </label>";
                    echo " <p>$review</p>";
                    echo " </div>";
                }
            }
            ?>

            <div class="write-review">
                <textarea name="reviews" id="user_review" Placeholder="Write your reviews....."></textarea>

                <?php

                if (isset($_SESSION['userID'])) {
                    echo "<button onclick='product_review($p_id,$user_id)'>Add Review</button>";
                } else {
                    echo "<button onclick='login()'>Add Review</button>";
                }

                ?>
            </div>
        </div>

        <!-- prodcuts -->
        <div class="display-product">
            <div class="product-view">
                <h3>More Products From This Shop</h3>
                <?php echo "<a href='products.php?s_id=$p_shop'>See All >> </a>" ?>
            </div>

            <div class="productview-lists">

                <?php
                $sql = 'SELECT * FROM PRODUCT WHERE SHOP_ID = :s_id';
                $stid = oci_parse($connection, $sql);
                oci_bind_by_name($stid, ':s_id', $p_shop);
                oci_execute($stid);

                while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
                    $product_name = $row['PRODUCT_NAME'];
                    $product_id = $row['PRODUCT_ID'];
                    $category_id = $row['CATEGORY_ID'];
                    $product_category = $row['PRODUCT_TYPE'];
                    $product_quantity = $row['QUANTITY'];
                    $product_image = $row['PRODUCT_IMAGE'];
                    $product_price = $row['PRODUCT_PRICE'];
                    $product_stock = $row['STOCK_NUMBER'];

                    if (!empty($row['OFFER_ID'])) {
                        $product_offer = $row['OFFER_ID'];
                    } else {
                        $product_offer = '';
                    }


                    echo "<div class='single' >";
                    echo "<div class='img' onclick='viewproduct($product_id)'>";
                    echo "<img src=\"../db/uploads/products/" . $product_image . "\" alt='$product_name' /> ";
                    // echo "<div class='tag'>";
                    if (!empty($product_offer)) {
                        echo "<div class='offer'>Offer</div>";
                    } else {
                        echo "";
                    }
                    if ((int)$product_stock <= 0) {
                        echo "<div class='outofstock'>out of stock</div>";
                    } else {
                        echo "";
                    }
                    // echo "</div>";    
                    echo "</div>";

                    echo "<div class='content'>";
                    echo "<h5>" . ucfirst($product_name) . "</h5>";
                    echo "<span class='piece'>" . $product_quantity . " gm</span>";
                    echo "<div class='price'>";
                    if ($product_offer) {
                        // echo $product_offer;
                        $sql = "SELECT OFFER_PERCENTAGE FROM OFFER WHERE OFFER_ID = :offer_id";
                        $stmt = oci_parse($connection, $sql);
                        oci_bind_by_name($stmt, ":offer_id", $product_offer);
                        oci_execute($stmt);
                        $row = oci_fetch_array($stmt, OCI_ASSOC);
                        $discount = (int)$row['OFFER_PERCENTAGE'];
                        $total_price = $product_price - $product_price * ($discount / 100);

                        echo "<span class='cut'>&pound;" . $product_price . "</span>";
                        echo "<span class='main'>&pound;" . $total_price . "</span>";
                    } else {
                        echo "<span class='main'>&pound; " . $product_price . "</span>";
                    }

                    echo "</div>";

                    if ((int)$product_stock <= 0) {
                        echo "<div class='btn' id='outstock' >Add +</div>";
                    } else {
                        if (isset($_SESSION['userID'])) {
                            echo "<button class='btn' id='add' onclick='addtocart($product_id,1)'>Add +</button>";
                        } else {
                            echo "<button class='btn' id='addcart' onclick='addcart($product_id,1)'>Add +</button>";
                        }
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
        function viewproduct(p_id) {
            window.location.href = "productview.php?p_id=" + p_id;
        }

        sessionStorage.clear();

        function rating(rate, product_id, user_id) {
            sessionStorage.setItem("star", rate);
            sessionStorage.setItem("p_id", product_id);
            sessionStorage.setItem("u_id", user_id);

            var starSpans = document.querySelectorAll('.stars span');

            // Iterate through each span and add the yellow color
            for (var i = 0; i < starSpans.length; i++) {
                if (i < rate) {
                    starSpans[i].style.color = 'orange';
                } else {
                    starSpans[i].style.color = 'gray'; // Set the remaining stars to black
                }
            }
        }

        // review 
        function product_review(product_id, user_id) {
            const review = document.getElementById('user_review').value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    window.location.reload();
                    // alert(this.responseText); // replace 'this.responseText' with the actual response text from the server
                }
            };
            xmlhttp.open(
                "GET",
                "addrating.php?action=review&pid=" + product_id + "&uid=" + user_id + "&review=" + review,
                true
            );
            xmlhttp.send();
        }


        // add rating
        function addrating() {
            const rate = sessionStorage.getItem('star');
            const product_id = sessionStorage.getItem('p_id');
            const user_id = sessionStorage.getItem('u_id');
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    window.location.reload();
                    // alert(this.responseText); // replace 'this.responseText' with the actual response text from the server
                }
            };
            xmlhttp.open(
                "GET",
                "addrating.php?action=rating&pid=" + product_id + "&uid=" + user_id + "&rate=" + rate,
                true
            );
            xmlhttp.send();
        }

        function login() {
            window.location.href = "../login.php";
        }

        function removequantity() {
            const quantity = document.getElementById('quantity').value;
            if (quantity > 1) {
                const subtract = parseInt(quantity) - 1;
                document.getElementById('quantity').value = subtract;
            }
        }

        function addedquantity(stocklevel) {
            const quantity = document.getElementById('quantity').value;
            // const stocklevel = document.getElementById('stocklevel').value;

            if (quantity < stocklevel) {
                const addition = parseInt(quantity) + 1;
                document.getElementById('quantity').value = addition;
            }
        }

        function add_session() {
            const product_id = document.getElementById('product_id').value;
            const quantity = document.getElementById('quantity').value;
            addcart(product_id, quantity);
        }

        function add_database() {
            const product_id = document.getElementById('product_id').value;
            const quantity = document.getElementById('quantity').value;
            addtocart(product_id, quantity);
        }
    </script>
    <script src="addremove.js"></script>
</body>

</html>