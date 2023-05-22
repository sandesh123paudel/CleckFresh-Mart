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
    <link rel="stylesheet" href="css/over.css" />
</head>

<body>
    <div class="overview-container">
        <div class="trader">
            <div class="trader-info">
                <h2>Greeting, <label>
                        <?php
                        $sql = 'SELECT * FROM USER_I WHERE USER_ID= :id ';
                        $stid = oci_parse($connection, $sql);
                        oci_bind_by_name($stid, ':id', $_SESSION['traderID']);
                        oci_execute($stid);
                        $username = '';
                        while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
                            $username = $row['FIRST_NAME'];
                        }
                        echo $username;

                        ?></label></h2>
                <p>Here's what's happening with your store today.</p>
            </div>
            <a href="traderdashboard.php?cat=Addproduct&name=Products">Add Product +</a>
        </div>


        <div class="trader-report">

            <div class="report">
                <div class="report-info">
                    <?php
                    $order_count = 0;
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
                        $order_count += 1;
                    }

                    echo "<h3>" . $order_count . "</h3>";
                    ?>

                    <p>Total orders</p>
                </div>
                <div class="icon">
                    <span class="material-symbols-outlined">
                        local_mall
                    </span>
                </div>
            </div>

            <div class="report">
                <div class="report-info">
                    <h3>
                        <?php
                        $sql = "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM PRODUCT WHERE PRODUCT_TYPE = :p_type ";
                        $stid = oci_parse($connection, $sql);
                        oci_bind_by_name($stid, ':p_type', $_SESSION['type']);

                        oci_define_by_name($stid, 'NUMBER_OF_ROWS', $totalproduct);

                        oci_execute($stid);
                        oci_fetch($stid);

                        echo $totalproduct;
                        ?>

                    </h3>


                    <p>Total Products</p>
                </div>
                <div class="icon">
                    <span class="material-symbols-outlined">
                        work
                    </span>
                </div>

            </div>

            <div class="report">
                <div class="report-info">
                    <h3>
                        <?php
                        $sql1 = "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM SHOP WHERE SHOP_TYPE = :p_type ";
                        $stid1 = oci_parse($connection, $sql1);
                        oci_bind_by_name($stid1, ':p_type', $_SESSION['type']);

                        oci_define_by_name($stid1, 'NUMBER_OF_ROWS', $totalshop);

                        oci_execute($stid1);
                        oci_fetch($stid1);

                        echo $totalshop;
                        ?>
                    </h3>
                    <p>Total Shops</p>
                </div>
                <div class="icon">
                    <span class="material-symbols-outlined">storefront</span>
                </div>

            </div>

            <a href="http://localhost:8080/apex/">
                <!-- <div class="report"> -->
                <div class="report-info">
                    <h3>Report</h3>
                    <p>View Report</p>
                </div>
                <div class="icon">
                    <span class="material-symbols-outlined">
                        analytics
                    </span>
                </div>
                <!-- </div> -->
            </a>

            <div class="report">
                <div class="report-info">
                    <?php
                    $total_amount = 0;

                    $sqlpayment = "SELECT op.*,pr.*,r.*
                    FROM REPORT r
                    JOIN ORDER_PRODUCT op ON r.ORDER_ID = op.ORDER_ID
                    JOIN PRODUCT pr ON op.PRODUCT_ID = pr.PRODUCT_ID
                    JOIN SHOP s ON pr.SHOP_ID = s.SHOP_ID
                    JOIN USER_I u ON s.USER_ID = u.USER_ID
                    WHERE u.USER_ID = :user_id";

                    $stmtpayment = oci_parse($connection, $sqlpayment);
                    oci_bind_by_name($stmtpayment, ":user_id", $_SESSION['traderID']);
                    oci_execute($stmtpayment);

                    while ($row = oci_fetch_array($stmtpayment)) {
                        $product_price = (float)$row['PRODUCT_PRICE'] * $row['ORDER_QUANTITY'];
                        $total_amount += $product_price;
                    }

                    echo "<h3>&pound; " . number_format($total_amount, 2) . "</h3>";
                    ?>

                    <p>Total Earnings</p>
                </div>
                <div class="icon">
                    <span class="material-symbols-outlined">
                        paid
                    </span>
                </div>
            </div>

        </div>
    </div>
</body>

</html>