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

// update cart
else if ($_GET['action'] == 'updatecart') {
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($value['product_id'] === $_GET['id']) { // receiving data from remove button
            $_SESSION['cart'][$key] = array('product_id' => $product_id, 'product_quantity' => $quantity);
            // header('location:viewcart.php');
            echo "Successfully updated Cart";
        }
    }
}




//extracting the cart in cart product
    // $price = 0;
    // $total = 0;
    // if (isset($_SESSION['cart'])) {
    //     foreach ($_SESSION['cart'] as $key => $value) {
    //         $price = $value['productPrice'] * $value['productquantity'];
    //         $total += $value['productPrice'] * $value['productquantity']; {
    //             // code to display cart items
    //         }
    //     }
    // }
    
    //  navbar to increase the count number 
    // $count = 0;
    // if (isset($_SESSION['cart'])) {
    //     $count = count($_SESSION['cart']);
    // }

?>