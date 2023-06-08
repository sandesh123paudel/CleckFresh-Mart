<?php
session_start();
include("../db/connection.php");


// $sqls = "SELECT * FROM ORDER_I WHERE CART_ID= :cart_id AND COLLECTION_SLOT_ID = :slot_id AND ORDER_DATE= :cdate";
$sqls = "SELECT * FROM ORDER_I WHERE CART_ID= :cart_id AND COLLECTION_SLOT_ID = :slot_id AND COLLECTION_DATE= :cdate AND TOTAL_PRICE = :price";
$stmt = oci_parse($connection, $sqls);
oci_bind_by_name($stmt, ":cart_id", $_SESSION['cart_id']);
oci_bind_by_name($stmt, ":slot_id", $_SESSION['collectionslot_id']);
oci_bind_by_name($stmt, ":cdate",  $_SESSION['collect_date']);
oci_bind_by_name($stmt, ":price", $_SESSION['totalprice']);

oci_execute($stmt);
while ($data = oci_fetch_array($stmt, OCI_ASSOC)) {
    $order_id = $data['ORDER_ID'];
    $date = DateTime::createFromFormat('d-M-y', $data['ORDER_DATE']);
    $order_date = $date->format('d/m/Y');
}

// echo "\n" . $_SESSION['cart_id'];
// echo "\n" . $_SESSION['collectionslot_id'];
// echo "\n" . $_SESSION['collect_date'];
// echo "\n" . $_SESSION['totalprice'];
// echo "\n" . $order_id;
// echo "\n" .$order_date;

$_SESSION['order_id'] = $order_id;

$_SESSION['order_date'] = $order_date;

$sqlt = "SELECT * FROM CART_PRODUCT WHERE CART_ID = :cart_id";
$stms = oci_parse($connection, $sqlt);
oci_bind_by_name($stms, ":cart_id", $_SESSION['cart_id']);
oci_execute($stms);

while ($data = oci_fetch_array($stms, OCI_ASSOC)) {
    $product_id = $data['PRODUCT_ID'];
    $quantity = $data['QUANTITY'];

    $sql = "INSERT INTO ORDER_PRODUCT(ORDER_ID,PRODUCT_ID,ORDER_QUANTITY) VALUES (:order_id,:pid,:qty)";
    $stid = oci_parse($connection, $sql);
    oci_bind_by_name($stid, ":order_id", $order_id);
    oci_bind_by_name($stid, ":pid", $product_id);
    oci_bind_by_name($stid, ":qty", $quantity);
    oci_execute($stid);

    // update product stock

    $selsql = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = :pid";
    $stmt = oci_parse($connection, $selsql);
    oci_bind_by_name($stmt, ":pid", $product_id);
    oci_execute($stmt);
    $data = oci_fetch_array($stmt);
    $stock = $data['STOCK_NUMBER'];
    $updatestock = (int)$stock - (int) $quantity;

    $updatesql = "UPDATE PRODUCT SET STOCK_NUMBER = :stock WHERE PRODUCT_ID = :pid";
    $updatestmt = oci_parse($connection, $updatesql);
    oci_bind_by_name($updatestmt, ":stock", $updatestock);
    oci_bind_by_name($updatestmt, ":pid", $product_id);
    oci_execute($updatestmt);
}

// inserting in invoice table
$payment = "PAYPAL";
$invoice_price = $_SESSION['totalprice'];
$invoicesql = "INSERT INTO INVOICE (ORDER_ID,INVOICE_DATE,PAYMENT_FROM,PAYMENT_TO,TOTAL_AMOUNT) VALUES (:order_id,:invoice_date,:payment_from,:payment_to,:totalprice)";
$invoicestmt = oci_parse($connection, $invoicesql);
oci_bind_by_name($invoicestmt, ":order_id", $order_id);
oci_bind_by_name($invoicestmt, ":invoice_date",  $order_date);
oci_bind_by_name($invoicestmt, ":payment_from", $payment);
oci_bind_by_name($invoicestmt, ":payment_to", $_SESSION['userID']);
oci_bind_by_name($invoicestmt, ":totalprice", $invoice_price);
oci_execute($invoicestmt);


// delet all the cart product items from cart_product table
$delsql = "DELETE FROM CART_PRODUCT WHERE CART_ID = :cart_id";
$delstmt = oci_parse($connection, $delsql);
oci_bind_by_name($delstmt, ":cart_id", $_SESSION['cart_id']);
oci_execute($delstmt);


// header("location:invoice.php?order_id=$order_id&order_date=$order_date&price=$invoice_price");
header("location:invoice.php?order_id=$order_id");
