<?php
session_start();
include('../db/connection.php');


$order_id = $_SESSION['order_id'];

// $order_id = 7088;

$sqlpayment = "SELECT u.*,op.*,pr.*,s.*
    FROM PAYMENT p
    JOIN ORDER_PRODUCT op ON p.ORDER_ID = op.ORDER_ID
    JOIN PRODUCT pr ON op.PRODUCT_ID = pr.PRODUCT_ID
    JOIN SHOP s ON pr.SHOP_ID = s.SHOP_ID
    JOIN USER_I u ON s.USER_ID = u.USER_ID
    WHERE p.ORDER_ID = :order_id";

$stmtpayment = oci_parse($connection, $sqlpayment);
oci_bind_by_name($stmtpayment, ":order_id", $order_id);
oci_execute($stmtpayment);

while ($row = oci_fetch_array($stmtpayment)) {
    $email = $row['EMAIL'];
    $user_name = $row['FIRST_NAME'] . " " . $row['LAST_NAME'];
    $trader_id = $row['USER_ID'];
    $product_id = $row['PRODUCT_ID'];
    $product_price = $row['PRODUCT_PRICE'];
    $product_name = ucfirst($row['PRODUCT_NAME']);
    $shop_name = ucfirst($row['SHOP_NAME']);

    $insertsql = "INSERT INTO REPORT (PRODUCT_ID,TRADER_ID,ORDER_ID) VALUES (:product_id,:trader_id,:order_id)";
    $stmtinsert = oci_parse($connection, $insertsql);
    oci_bind_by_name($stmtinsert, ":product_id", $product_id);
    oci_bind_by_name($stmtinsert, ":trader_id", $trader_id);
    oci_bind_by_name($stmtinsert, ":order_id", $order_id);
    oci_execute($stmtinsert);

    $username = $user_name;
    $femail = $email;

    $sub = "Notification from CleckFreshMart";
    $message = "Dear " . $username . ",\n\n\tYour product is successfully sold.
    \n\tShop Name: $shop_name\n\t Product Name : $product_name \n\t\tProduct amount receive : £ $product_price";
    include('../sendmail.php');
}