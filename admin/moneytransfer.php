<?php
session_start();
include('../db/connection.php');

if (isset($_GET['action']) && isset($_GET['order_id'])) {
    if ($_GET['action'] == 'transfer') {

        $order_id = $_GET['order_id'];
        $total_price = 0;
        $discount_price = 0;

        $sqlpayment = "SELECT u.*,op.*,pr.*
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
            $product_name = $row['PRODUCT_NAME'];

            if (!empty($row['OFFER_ID'])) {
                $sql = "SELECT * FROM OFFER WHERE OFFER_ID = :offer_id";
                $stid = oci_parse($connection, $sql);
                oci_bind_by_name($stid, ":offer_id", $row['OFFER_ID']);
                oci_execute($stid);
                $data = oci_fetch_array($stid);
                $discount_per = (int)$data['OFFER_PERCENTAGE'];
                $total_price = $product_price - $product_price * ($discount_per / 100);
            } else {
                $total_price = $product_price;
            }

            $username = $user_name;
            $femail = $email;

            $sub = "Notification from CleckFreshMart";
            $message = "Dear " . $username . ",\n\n\tYour product is successfully sold.
            \n\tProduct Name : $product_name \n\t\tProduct amount receive : £ $total_price";
            include('../sendmail.php');
        }
        $transfer = "transfered";
        $update = 'UPDATE ORDER_I SET ORDER_STATUS = :transfer WHERE ORDER_ID = :order_id';
        $updatestmt = oci_parse($connection, $update);
        oci_bind_by_name($updatestmt, ":transfer", $transfer);
        oci_bind_by_name($updatestmt, ":order_id", $order_id);

        if (oci_execute($updatestmt)) {
            header("location:dashboard.php?cat=Order Lists");
        }
    } else if ($_GET['action'] == 'delete') {

        $order_id = $_GET['order_id'];
        $sql = "DELETE FROM ORDER_PRODUCT WHERE ORDER_ID = :order_id";
        $stid = oci_parse($connection, $sql);
        oci_bind_by_name($stid, ":order_id", $order_id);
        oci_execute($stid);

        $delete = "removed";
        $update = 'UPDATE ORDER_I SET ORDER_STATUS = :remove WHERE ORDER_ID = :order_id';
        $updatestmt = oci_parse($connection, $update);
        oci_bind_by_name($updatestmt, ":remove", $delete);
        oci_bind_by_name($updatestmt, ":order_id", $order_id);
        if (oci_execute($updatestmt)) {
            header("location:dashboard.php?cat=Order Lists");
        }
    }
}
