<?php
session_start();

echo $_SESSION['userID'] . "\n";
echo $_SESSION['order_id'] . "\n";
echo $_SESSION['totalprice'] . "\n";

include("../db/connection.php");
include_once 'config.php';

if (isset($_GET['PayerID'])) {
    $payment_detail = "completed";

    $status = "completed";
    $updatesql = "UPDATE ORDER_I SET STATUS = :ustatus WHERE ORDER_ID = :order_id";
    $sitd = oci_parse($connection, $updatesql);
    oci_bind_by_name($sitd, ":order_id", $_SESSION['order_id']);
    oci_bind_by_name($sitd, ":ustatus", $status);
    oci_execute($sitd);

    $sql = "INSERT INTO PAYMENT (USER_ID,ORDER_ID,TOTAL_AMOUNT,PAYMENT_DETAILS) VALUES (:user_id,:order_id,:total_amount,:payment_detail)";
    $stmt = oci_parse($connection, $sql);
    oci_bind_by_name($stmt, ":user_id", $_SESSION['userID']);
    oci_bind_by_name($stmt, ":order_id", $_SESSION['order_id']);
    oci_bind_by_name($stmt, ":total_amount", $_SESSION['totalprice']);
    oci_bind_by_name($stmt, ":payment_detail", $payment_detail);

    if (oci_execute($stmt)) {
        header('location:http://localhost/learning/karan/customer/homepage.php');
    }

    echo "<script>alert('Payment has been Successfull')</script>";
} else {
    echo "<script>alert('Your Payment is Failed Please try again')</script>";
}
