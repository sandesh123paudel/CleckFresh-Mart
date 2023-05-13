<?php
include("../db/connection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/indexs.css" />
    <!--jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#filter").change(function() {
                var shop_id = $("#filter").val();
                var shop_name = $("#shop_name").val();
                // alert("YOur filter id is : " + shop_id);
                document.location.href = "products.php?s_id=" + shop_id;
            });
        });
    </script>

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
                    if (isset($_GET['cat_id'])) {
                        $sql = 'SELECT CATEGORY_NAME FROM CATEGORY WHERE CATEGORY_ID= :c_id';
                        $stid = oci_parse($connection, $sql);
                        oci_bind_by_name($stid, ':c_id', $_GET['cat_id']);
                        oci_execute($stid);
                        while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
                            $cat_name = $row['CATEGORY_NAME'];
                        }
                    }
                    if (!isset($_GET['cat_name'])) {
                        $cat_name = "Filters Shop ";
                    }
                    if (isset($_GET['cat_name'])) {
                        $cat_name = $_GET['cat_name'];
                    }
                    if (isset($_GET['s_name'])) {
                        $cat_name = $_GET['s_name'];
                    }
                    if (isset($_GET['search'])) {
                        $cat_name = $_GET['search'];
                    }

                    echo "<span>" . strtoupper($cat_name) . "</span>";

                    ?> Products Lists </h3>


            <select id='filter' name='filter'>
                <option value="all">Filter by Shop</option>
                <?php
                $sql = "SELECT * FROM SHOP ";
                $stid = oci_parse($connection, $sql);
                oci_execute($stid);
                while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
                    // session unset
                    unset($_SESSION['shopid']);

                    $s_id = $row['SHOP_ID'];
                    $s_name = $row['SHOP_NAME'];
                    $_SESSION['shopid'] = $s_id;
                    // echo "<option type='hidden' id='shop_name' value='$s_name'>";
                    echo "<option value='$s_id'  >" . $s_name . "</option>";
                }
                ?>
            </select>


        </div>

        <div class="product-lists">

            <?php
            if (isset($_GET['offer_name'])) {
                $offerSql = "SELECT * FROM OFFER";
                $stmt = oci_parse($connection, $offerSql);
                oci_execute($stmt);
                while ($row = oci_fetch_array($stmt, OCI_ASSOC)) {
                    $offer_id = $row['OFFER_ID'];
                    $sql = 'SELECT * FROM PRODUCT WHERE OFFER_ID= :off_id AND ROWNUM <= 8';
                    $stid = oci_parse($connection, $sql);
                    oci_bind_by_name($stid, ':off_id', $offer_id);
                    oci_execute($stid);

                    while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
                        $product_name = $row['PRODUCT_NAME'];
                        $product_id = $row['PRODUCT_ID'];
                        $product_image = $row['PRODUCT_IMAGE'];
                        $product_price = $row['PRODUCT_PRICE'];

                        echo "<div class='single'>";
                        echo "<div class='img' onclick='viewproduct($product_id)'>";
                        echo "<img src=\"../db/uploads/products/" . $product_image . "\" alt='$product_name' /> ";
                        echo "<div class='offer'>Offer</div>";
                        echo "</div>";
                        echo "<div class='content'>";
                        echo "<h5>Fresh Blackberries</h5>";
                        echo "<span class='piece'>24 PieceS</span>";

                        echo "<input type='hidden' data-quantity='1' >";

                        echo "<div class='price'>";
                        echo "<span class='cut'>$50.00</span>";
                        echo "<span class='main'>$20.00</span>";
                        echo "</div>";

                        // echo "<a href=''><div class='btn'>Add +</div></a>";
                        if (isset($_SESSION['userID'])) {
                            echo "<button class='btn' id='add' onclick='addtocart($product_id,1)'>Add +</button>";
                        } else {
                            echo "<button class='btn' id='addcart' onclick='addcart($product_id,1)'>Add +</button>";
                        }

                        echo "</div>";
                        echo "</div>";
                    }
                }
            } else {
                if (isset($_GET['cat_id'])) {
                    $sql = 'SELECT * FROM PRODUCT WHERE CATEGORY_ID= :c_id';
                    $stid = oci_parse($connection, $sql);
                    oci_bind_by_name($stid, ':c_id', $_GET['cat_id']);
                }
                if (isset($_GET['cat_name'])) {
                    if ($_GET['cat_name'] == 'trending') {
                        $sql = "SELECT * FROM PRODUCT WHERE ROWNUM <= 20";
                        $stid = oci_parse($connection, $sql);
                    }
                    if ($_GET['cat_name'] == 'all') {
                        $sql = 'SELECT * FROM PRODUCT';
                        $stid = oci_parse($connection, $sql);
                    }
                }
                if (isset($_GET['s_id'])) {
                    $sql = 'SELECT * FROM PRODUCT WHERE SHOP_ID= :s_id';
                    $stid = oci_parse($connection, $sql);
                    oci_bind_by_name($stid, ':s_id', $_GET['s_id']);
                }
                if (isset($_GET['p_name'])) {
                    $sql = "SELECT * FROM PRODUCT WHERE PRODUCT_NAME LIKE '%' || :product_name || '%'";
                    $stid = oci_parse($connection, $sql);
                    oci_bind_by_name($stid, ':product_name', $_GET['p_name']);
                }

                oci_execute($stid);
                while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
                    $product_name = $row['PRODUCT_NAME'];
                    $product_id = $row['PRODUCT_ID'];
                    $category_id = $row['CATEGORY_ID'];
                    $product_category = $row['PRODUCT_TYPE'];
                    $product_quantity = $row['QUANTITY'];
                    $product_image = $row['PRODUCT_IMAGE'];
                    $product_price = $row['PRODUCT_PRICE'];
                    if (!empty($row['OFFER_ID'])) {
                        $product_offer = $row['OFFER_ID'];
                    } else {
                        $product_offer = '';
                    }
                    $product_stock = $row['STOCK_NUMBER'];


                    echo "<div class='single' >";
                    echo "<div class='img' onclick='viewproduct($product_id)'>";
                    echo "<img src=\"../db/uploads/products/" . $product_image . "\" alt='$product_name' /> ";
                    //    echo "<div class='tag'>";
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
                    echo "<h5>" . $product_name . "</h5>";
                    echo "<span class='piece'>" . $product_quantity . " gm </span>";
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
                    echo "<input type='hidden' data-quantity='1' >";

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
            }

            ?>

        </div>

    </div>

    <?php
    require('footer.php');
    ?>

    <script src="addremove.js"></script>
    <script>
        function viewproduct(p_id) {
            window.location.href = "productview.php?p_id=" + p_id;
        }
    </script>
</body>

</html>