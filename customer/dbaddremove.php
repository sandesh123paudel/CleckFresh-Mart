<?php
session_start();
include("../db/connection.php");

    $product_id = $_GET['id'];
    
    if (!empty($_GET['quantity'])) {
        $quantity = $_GET['quantity'];
    }

    $sql = "SELECT CART.CART_ID, WISHLIST.WISHLIST_ID 
    FROM CART 
    JOIN WISHLIST ON CART.USER_ID = WISHLIST.USER_ID 
    WHERE CART.USER_ID = :user_id";

    $stmt = oci_parse($connection, $sql);

    oci_bind_by_name($stmt, ':user_id', $_SESSION['userID']);

    oci_execute($stmt);

    while ($row = oci_fetch_assoc($stmt)) {
        $cart_id = $row['CART_ID'];
        $wishlist_id = $row['WISHLIST_ID'];
    }

    //  add to cart
    if ($_GET['action'] == 'addcart') {
        $check = "SELECT * FROM CART_PRODUCT WHERE CART_ID = :cart_id AND PRODUCT_ID = :pid";
        $checkstid = oci_parse($connection,$check);
        oci_bind_by_name($checkstid,":pid", $product_id);
        oci_bind_by_name($checkstid,":cart_id", $cart_id);
        oci_execute($checkstid);
        if(oci_fetch_array($checkstid)){
            echo "Already Added to Cart";
        }
        else{
            $sql = "INSERT INTO CART_PRODUCT(CART_ID,PRODUCT_ID,QUANTITY) VALUES (:cart_id,:pid,:qty)";
            $stid = oci_parse($connection, $sql);
            oci_bind_by_name($stid, ":cart_id", $cart_id);
            oci_bind_by_name($stid, ":pid", $product_id);
            oci_bind_by_name($stid, ":qty", $quantity);
            if(oci_execute($stid)){
                echo "Added Successfully";
            }
        }
    }

    // remove from cart
    else if ($_GET['action'] == 'removecart') {
        $sql = "DELETE FROM CART_PRODUCT WHERE PRODUCT_ID = :pid";
        $stid = oci_parse($connection, $sql);
        oci_bind_by_name($stid, ":pid", $product_id);
        if(oci_execute($stid)){
            echo "Successfully remove from Cart";
        }
    }
    
    // update cart
    if ($_GET['action'] == 'updatecart') {
        $sql = "UPDATE CART_PRODUCT SET QUANTITY = :qty  WHERE PRODUCT_ID = :pid";
        $stid = oci_parse($connection, $sql);
        oci_bind_by_name($stid, ":qty", $quantity);
        oci_bind_by_name($stid, ":pid", $product_id);
        oci_execute($stid);
    }
    // add to wishlist

    if ($_GET['action'] == 'addwishlist') {

        $check = "SELECT * FROM WISHLIST_PRODUCT WHERE WISHLIST_ID = :wishlist_id AND PRODUCT_ID = :pid";
        $checkstid = oci_parse($connection,$check);
        oci_bind_by_name($checkstid,":wishlist_id", $wishlist_id);
        oci_bind_by_name($checkstid,":pid", $product_id);
        oci_execute($checkstid);
        if(oci_fetch_array($checkstid)){
            echo "Already Added to Wishlist";
        }
        else{
            $sql = "INSERT INTO WISHLIST_PRODUCT (WISHLIST_ID,PRODUCT_ID) VALUES (:wishlist_id,:pid)";
            $stid = oci_parse($connection, $sql);
            oci_bind_by_name($stid, ":wishlist_id", $wishlist_id);
            oci_bind_by_name($stid, ":pid", $product_id);
            if(oci_execute($stid)){
                echo "Added to Wishlist";
            }
        }
    }
    // remove from wishlist
    if ($_GET['action'] == 'removewishlist') {
        $sql = "DELETE FROM WISHLIST_PRODUCT WHERE PRODUCT_ID = :pid";
        $stid = oci_parse($connection, $sql);
        oci_bind_by_name($stid, ":pid", $product_id);
        if(oci_execute($stid))
        {
            echo "Successfully remove from wishlist";
        }
        
    }

?>