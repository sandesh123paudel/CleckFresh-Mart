<?php
include('../db/connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wishlist</title>
    <link rel="icon" href="../assets/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="css/cartpage.css" />

    <script src="addremove.js"></script>

</head>

<body>

    <div class='nav-bar'>
        <?php
        require('navbar.php');
        ?>
    </div>

    <div class="cart-container">
        <div class="title">
            <span class="material-symbols-outlined">
                arrow_back_ios_new
            </span>
            <h3>Shopping Continue</h3>
        </div>
        <div class="line"></div>

        <div class="cart-info">
            <h4>My Wishlist (<?php
                                if (isset($_SESSION['wishlist'])) {
                                    echo count($_SESSION['wishlist']);
                                } else if (isset($_SESSION['userID'])) {
                                    unset($_SESSION['wishlist_id']);

                                    $stmt = "SELECT * FROM WISHLIST WHERE USER_ID = :id";
                                    $stid = oci_parse($connection, $stmt);
                                    oci_bind_by_name($stid, ":id", $_SESSION['userID']);
                                    oci_execute($stid);

                                    $row = oci_fetch_array($stid, OCI_ASSOC);
                                    $_SESSION['wishlist_id'] = $row['WISHLIST_ID'];
                                    // echo $_SESSION['cart_id'];

                                    $sql = "SELECT COUNT(*) AS NUM_OF_ROWS FROM WISHLIST_PRODUCT WHERE WISHLIST_ID = :wishlist_id";
                                    $stmts = oci_parse($connection, $sql);
                                    oci_bind_by_name($stmts, ":wishlist_id", $_SESSION['wishlist_id']);

                                    oci_define_by_name($stmts, "NUM_OF_ROWS", $wishlist_num);
                                    oci_execute($stmts);
                                    oci_fetch($stmts);
                                    echo $wishlist_num;
                                } else {
                                    echo '0';
                                }
                                ?> items)</h4>
            <p>You have <?php
                        if (isset($_SESSION['wishlist'])) {
                            echo count($_SESSION['wishlist']);
                        } else if (isset($_SESSION['userID'])) {
                            echo $wishlist_num;
                        } else {
                            echo '0';
                        }
                        ?> items in your wishlist</p>
        </div>

        <div class="wishlist-container">

            <?php
            if (isset($_SESSION['wishlist'])) {

                foreach ($_SESSION['wishlist'] as $key => $value) {
                    $sql = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = :id";
                    $stid = oci_parse($connection, $sql);
                    oci_bind_by_name($stid, ":id", $value['product_id']);
                    oci_execute($stid);

                    while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
                        $product_id = $row['PRODUCT_ID'];
                        $product_name = $row['PRODUCT_NAME'];

                        echo "
                    <div class='wishlist-item'>
                        <div class='img' >
                            <img src=\"../db/uploads/products/" . $row['PRODUCT_IMAGE'] . "\" alt='$product_name' /> 
                            <div onclick='removewishlist($product_id)'> 
                                <span  class='closebtn' >&times;</span>
                            </div>
                        </div>
                    
                        <h3>" . substr($row['PRODUCT_NAME'], 0, 14) . "</h3>
                        <h4> &pound; " . $row['PRODUCT_PRICE']  . "</h4>";

                        echo "<button  id='addcart' onclick='addcart($product_id,1)'>Add +</button>";

                        echo "</div>";
                    }
                }
            } else if (isset($_SESSION['userID'])) {
                $sqlpr = "SELECT p.*
                FROM WISHLIST_PRODUCT wp 
                JOIN PRODUCT p ON wp.PRODUCT_ID = p.PRODUCT_ID
                WHERE wp.WISHLIST_ID = :wishlist_id";

                $stmts = oci_parse($connection, $sqlpr);
                oci_bind_by_name($stmts, ":wishlist_id", $_SESSION['wishlist_id']);
                oci_execute($stmts);

                while ($data = oci_fetch_array($stmts, OCI_ASSOC)) {
                    $product_id = $data['PRODUCT_ID'];
                    $product_name = $data['PRODUCT_NAME'];

                    echo "
                    <div class='wishlist-item'>
                        <div class='img' >
                            <img src=\"../db/uploads/products/" . $data['PRODUCT_IMAGE'] . "\" alt='$product_name' />";

                    if (isset($_SESSION['userID'])) {
                        echo "<div onclick='removewishlistdb($product_id)'>";
                    } else {
                        echo "<div onclick='removewishlist($product_id)'>";
                    }

                    echo "<span class='closebtn'>&times;</span>
                            </div>
                        </div>
                    
                        <h3>" . substr($data['PRODUCT_NAME'], 0, 14) . "</h3>
                        <h4>&pound; " . $data['PRODUCT_PRICE'] . "</h4>";

                    echo "<button id='add' onclick='addtocart($product_id,1)'>Add +</button>";

                    echo "</div>";
                }
            }

            ?>

        </div>
    </div>

    <?php
    require('footer.php');
    ?>
</body>

</html>