<?php
session_start();
include('../db/connection.php');

//reveiving data from add to cart button
$product_id = $_GET['id'];
if(!empty($_GET['quantity'])){
    $quantity = $_GET['quantity'];
}

// add to cart
if ($_GET['action'] == 'addcart') {
    
    if (empty($_SESSION['cart'])) {
        $_SESSION['cart'][] = array('product_id' => $product_id, 'product_quantity' => $quantity);
        echo "Added to Cart";
    } else {
        $check_product = array_column($_SESSION['cart'], 'product_id');

        if (in_array($product_id, $check_product)) {
            echo "Already added to Cart";
        } else {
            $_SESSION['cart'][] = array('product_id' => $product_id, 'product_quantity' => $quantity);
            echo "Added to Cart";
        }
    }
}

else if ($_GET['action'] == 'addwishlist') {

    if (empty($_SESSION['wishlist'])) {
        $_SESSION['wishlist'][] = array('product_id' => $product_id);
        echo "Added to wishlist ";
    } else {
        $check_product = array_column($_SESSION['wishlist'], 'product_id');

        if (in_array($product_id, $check_product)) {
            echo "Already added to wishlist";
        } else {
            $_SESSION['wishlist'][] = array('product_id' => $product_id);
            echo "Added to wishlist";
        }
    }
}



// remove from cart
else if ($_GET['action'] == 'removecart') {
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($value['product_id'] === $_GET['id']) { // receiving data from remove button
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
            // header('location:viewcart.php');
            echo "Successfully Remove from Cart";
        }
    }
}

// remove from wishlist
else if ($_GET['action'] == 'removewishlist') {
    foreach ($_SESSION['wishlist'] as $key => $value) {
        if ($value['product_id'] === $_GET['id']) { // receiving data from remove button
            unset($_SESSION['wishlist'][$key]);
            $_SESSION['wishlist'] = array_values($_SESSION['wishlist']);
            // header('location:viewcart.php');
            echo "Successfully remove from Wishlist";
        }
    }
}

else if ($_GET['action'] == 'addupdatecart') {
    $product_id = $_GET['id']; // Store the product ID
    $quantity = (int)$_GET['quantity']; // Store the quantity
    $sql = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = :product_id";
    $stid = oci_parse($connection,$sql);
    oci_bind_by_name($stid,":product_id" , $product_id);
    oci_execute($stid);
    $data = oci_fetch_array($stid);
    $stock = $data['STOCK_NUMBER'];

    foreach ($_SESSION['cart'] as $key => $value) {
        if ($value['product_id'] === $product_id) {
            if($value['product_quantity'] == $stock){
                return;
            }

            $upquantity = (int)$value['product_quantity'] + $quantity;
            $_SESSION['cart'][$key]['product_quantity'] = $upquantity;
            echo "Successfully updated Cart";
            break; // Exit the loop after updating the cart
        }
    }
}

else if ($_GET['action'] == 'removeupdatecart') {
    $product_id = $_GET['id']; // Store the product ID
    
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($value['product_id'] === $product_id) {
            $upquantity = (int)$value['product_quantity'];
            
            if ($upquantity > 1) {
                $upquantity = $upquantity - 1;
                $_SESSION['cart'][$key]['product_quantity'] = $upquantity;
            } else {
                return; // Remove the item from the cart
            }
            
            echo "Successfully updated Cart";
            break; // Exit the loop after updating the cart
        }
    }
}