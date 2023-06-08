<?php
session_start();

include("../db/connection.php");
include_once 'config.php';

if (isset($_GET['PayerID'])) {
    $payment_detail = "completed";

    $user_id = $_SESSION['userID'];
    $order_id = $_SESSION['order_id'];
    $collect_date = $_SESSION['order_date'];

    $status = "completed";
    $updatesql = "UPDATE ORDER_I SET ORDER_STATUS = :ustatus WHERE ORDER_ID = :order_id";
    $sitd = oci_parse($connection, $updatesql);
    oci_bind_by_name($sitd, ":order_id", $_SESSION['order_id']);
    oci_bind_by_name($sitd, ":ustatus", $status);
    oci_execute($sitd);

    $sqlq = "SELECT * FROM USER_I WHERE USER_ID = :id"; // selecting the all data from the user
    $stmt = oci_parse($connection, $sqlq);
    oci_bind_by_name($stmt, ":id", $user_id);
    // exeucuting the query
    oci_execute($stmt);
    while ($row = oci_fetch_array($stmt, OCI_ASSOC)) {
        $fname = $row['FIRST_NAME'];
        $lname = $row['LAST_NAME'];
        $email = $row['EMAIL'];
    }

    $username = $fname . " " . $lname;
    $femail = $email;
    $invoice_price = $_SESSION['totalprice'];

    $sub = "Payment Receipt from CleckFreshMart";
    $message = "Dear " . $username .
        "\n\nPlease find our payment receipt attached to this email" .
        ",\n\nYou have successfully paid your total amount : £ " . $invoice_price .
        "\nNow You can pick your order from your collection place.
        \nYour Order ID : " . $_SESSION['order_id'] .
        "\nYour collection time : " . $_SESSION['collection_date'] .
        "\nBe there on time.
        \n Thank You for shopping.  
        \nYour payment invoice link: http://localhost/learning/karan/customer/paymentinvoice.php?order_id=$order_id&user_id=$user_id
        \n\nThank you.
        \nHave a great day!
        \nCleckFreshMart";
    include_once('../sendmail.php');

    $sql = "INSERT INTO PAYMENT (USER_ID,ORDER_ID,TOTAL_AMOUNT,PAYMENT_DETAILS) VALUES (:user_id,:order_id,:total_amount,:payment_detail)";
    $stmt = oci_parse($connection, $sql);
    oci_bind_by_name($stmt, ":user_id", $_SESSION['userID']);
    oci_bind_by_name($stmt, ":order_id", $_SESSION['order_id']);
    oci_bind_by_name($stmt, ":total_amount", $invoice_price);
    oci_bind_by_name($stmt, ":payment_detail", $payment_detail);

    oci_execute($stmt);

    $sqlpayment = "SELECT u.*,op.*
        FROM PAYMENT p
        JOIN ORDER_PRODUCT op ON p.ORDER_ID = op.ORDER_ID
        JOIN PRODUCT pr ON op.PRODUCT_ID = pr.PRODUCT_ID
        JOIN SHOP s ON pr.SHOP_ID = s.SHOP_ID
        JOIN USER_I u ON s.USER_ID = u.USER_ID
        WHERE p.ORDER_ID = :order_id";

    $stmtpayment = oci_parse($connection, $sqlpayment);
    oci_bind_by_name($stmtpayment, ":order_id", $_SESSION['order_id']);
    oci_execute($stmtpayment);

    while ($row = oci_fetch_array($stmtpayment)) {

        $trader_id = $row['USER_ID'];
        $product_id = $row['PRODUCT_ID'];

        // inserting in report of payment details
        $insertsql = "INSERT INTO REPORT (PRODUCT_ID,TRADER_ID,ORDER_ID) VALUES (:product_id,:trader_id,:order_id)";
        $stmtinsert = oci_parse($connection, $insertsql);
        oci_bind_by_name($stmtinsert, ":product_id", $product_id);
        oci_bind_by_name($stmtinsert, ":trader_id", $trader_id);
        oci_bind_by_name($stmtinsert, ":order_id",  $_SESSION['order_id']);
        oci_execute($stmtinsert);
    }

    header('location:http://localhost/learning/karan/customer/homepage.php');

    // echo "<script>alert('Payment has been Successfull')</script>";

} else {
    echo "<script>alert('Your Payment is Failed Please try again')</script>";
}
