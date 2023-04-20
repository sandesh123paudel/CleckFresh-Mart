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
    <link rel="stylesheet" href="css/overv.css" />
</head>
<body>
    <div class="overview-container">
        <div class="trader">
            <div class="trader-info">
                <h2>Greeting, <label><?php echo $_SESSION['username']; ?></label></h2>
                <p>Here's what's happening with your store today.</p>
            </div>
            <a href="traderdashboard.php?cat=Addproduct&name=Products">Add Product +</a>
        </div>
        

        <div class="trader-report">
            
            <div class="report">
                <div class="report-info">
                    <h3>300</h3>
                    <p>New orders today</p>
                </div>
                <div class="icon">
                    <span class="material-symbols-outlined" >
                        local_mall
                    </span>
                </div>
                
            </div>

            <div class="report">
                <div class="report-info">
                    <h3>
                        <?php
                            $sql = "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM PRODUCT WHERE PRODUCT_TYPE = :p_type ";
                            $stid = oci_parse($connection,$sql);
                            oci_bind_by_name($stid , ':p_type', $_SESSION['type']);

                            oci_define_by_name($stid , 'NUMBER_OF_ROWS', $totalproduct);
                            
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
                            $stid1 = oci_parse($connection,$sql1);
                            oci_bind_by_name($stid1 , ':p_type', $_SESSION['type']);

                            oci_define_by_name($stid1 , 'NUMBER_OF_ROWS', $totalshop);
                            
                            oci_execute($stid1);
                            oci_fetch($stid1);

                            echo $totalshop;
                        ?>
                    </h3>
                    <p>Total Shops</p>
                </div>
                <div class="icon">
                    <span class="material-symbols-outlined">
                        apartment
                    </span>
                </div>
                
            </div>

            <div class="report">
                <div class="report-info">
                    <h3>Report</h3>
                    <p>View Report</p>
                </div>
                <div class="icon">
                    <span class="material-symbols-outlined">
                        analytics
                    </span>
                </div>
                
            </div>

            <div class="report">
                <div class="report-info">
                    <h3>&#163; 3000</h3>
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