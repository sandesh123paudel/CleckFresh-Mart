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
    <!-- <link rel="stylesheet" href="css/overview.css" /> -->
</head>

<body>
    <div class="overview-container">
        <div class="trader">
            <div class="trader-info">
                <h2>Greeting, Admin</h2>
                <!-- <h2>Greeting, <label><?php echo $_SESSION['username']; ?></label></h2> -->
                <p>Here's what's happening with your store today.</p>
            </div>
        </div>


        <div class="trader-report">

            <div class="report">
                <div class="report-info">
                    <?php
                    $order_count = 0;
                    $sql = "SELECT o.*, u.* 
                    FROM ORDER_I o 
                    JOIN CART c ON c.CART_ID = o.CART_ID
                    JOIN USER_I u ON c.USER_ID = u.USER_ID ";
                    $stid = oci_parse($connection, $sql);
                    // exeucuting the query
                    oci_execute($stid);
                    while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
                        $order_count += 1;
                    }
                    echo " <h3>" . $order_count . "</h3>";
                    ?>

                    <p>Total orders </p>
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
                        $sql = "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM PRODUCT";
                        $stid = oci_parse($connection, $sql);

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
                        $sql1 = "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM SHOP";
                        $stid1 = oci_parse($connection, $sql1);

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


            <a href="http://localhost:8080/apex/f?p=101:9999:14337463141200::YES:::">
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
                    $totalamount = 0;
                    $sql = "SELECT * FROM PAYMENT";
                    $stid = oci_parse($connection, $sql);
                    oci_execute($stid);
                    while ($row = oci_fetch_array($stid)) {
                        $totalamount += (float)$row['TOTAL_AMOUNT'];
                    }
                    echo "<h3>&#163; " . number_format($totalamount, 2) . "</h3>";
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