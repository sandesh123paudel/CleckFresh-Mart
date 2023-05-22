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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="css/orderslist.css">
</head>

<body>

    <div class="order">
        <div class="order_header">
            <h3>Orders History Lists</h3>
        </div>
        <div class="line"></div>
    </div>
    <div class="user-container">

        <table>
            <!-- table heading -->
            <tr>
                <th>ORDER ID</th>
                <th>CUSTOMER</th>
                <th>PRODUCT</th>
                <th>QTY</th>
                <th>PRICE(&#163;)</th>
                <th>DATE</th>
                <th>STATUS</th>
            </tr>

            <?php

            $sql = "SELECT o.*,op.*,p.*,u.*
                FROM ORDER_I o
                JOIN ORDER_PRODUCT op ON o.ORDER_ID = op.ORDER_ID
                JOIN PRODUCT p ON op.PRODUCT_ID = p.PRODUCT_ID
                JOIN SHOP s ON p.SHOP_ID = s.SHOP_ID
                JOIN USER_I u ON s.USER_ID = u.USER_ID
                WHERE u.USER_ID = :user_id";

            $stid = oci_parse($connection, $sql);
            oci_bind_by_name($stid, ":user_id", $_SESSION['traderID']);
            oci_execute($stid);

            while ($row = oci_fetch_array($stid)) {
                $product_image = $row['PRODUCT_IMAGE'];
                $order_id = $row['ORDER_ID'];
                $order_date = $row['ORDER_DATE'];
                $order_price = $row['TOTAL_PRICE'];
                $order_status = $row['ORDER_STATUS'];
                $order_item = $row['NO_OF_ITEM'];

                $sqq = "SELECT u.* 
                FROM CART c
                JOIN ORDER_I o ON o.CART_ID= c.CART_ID 
                JOIN USER_I u ON c.USER_ID = u.USER_ID 
                WHERE o.ORDER_ID = :order_id";

                $stidd = oci_parse($connection, $sqq);
                oci_bind_by_name($stidd, ":order_id", $order_id);
                oci_execute($stidd);
                $data = oci_fetch_array($stidd);
                $user_name = $data['FIRST_NAME'] . " " . $data['LAST_NAME'];

                echo "
                <tr>
                    <td>" . $order_id . "</td>
                    <td>" . $user_name . "</td>
                    <td><img id='image' src='../db/uploads/products/$product_image' alt='' /></td>
                    <td>" . $order_item . "</td>
                    <td><b> &pound; " . $order_price . "</b></td>
                    <td>" . $order_date . "</td>
                    
                    <td> 
                        <div class='action'>";
                if ($order_status == 'completed') {
                    echo "<p id='green' >Delivered</p>";
                } else if ($order_status == 'removed') {
                    echo "<p id='red'>Cancelled</p>";
                } else {
                    echo "<p id='red'>Pending...</p>";
                }

                echo "</div>
                    </td> ";
            }
            ?>
        </table>
    </div>

</body>

</html>