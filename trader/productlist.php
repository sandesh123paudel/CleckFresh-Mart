<?php
  include('../db/connection.php');
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="css/shops.css">
</head>
<body>
    <div class="shop-container">
        <div class="shop_header">
            <h3>Productss Lists</h3>

                <div class="search-box">
                    <div class="search">
                        <input type="text" placeholder="Search...">
                        <span class="material-symbols-outlined">
                            search
                        </span>
                    </div>

                    <select name="" id="">
                        <option value="">All</option>
                        <option value="">A-Z</option>
                        <option value="">Z-A</option>
                    </select>
                </div>
            
        </div>

        
        <div class="shopitems">
            <?php
            // selecting all items from shops
                $sql = "SELECT * FROM PRODUCT";

                $stid = oci_parse($connection,$sql);
                oci_execute($stid);
                
                while($row = oci_fetch_array($stid, OCI_ASSOC)){
                    $pid = $row['PRODUCT_ID'];

                    echo "<div class='shop-item'>";
                        echo "<img src=\"../db/uploads/products/".$row['PRODUCT_IMAGE']."\" alt=".$row['PRODUCT_NAME']." >";
                        echo "<h3>".$row['PRODUCT_NAME']."</h3>";
                        echo "<div class='buttons'>";
                            echo "<a href='traderdashboard.php?cat=editproduct&id=$pid&action=edit' id='edit'>Edit</a>";
                            echo "<a href='deleteproduct.php?&id=$pid&action=delete' id='delete'>Delete</a>";
                        echo "</div>";
                    echo "</div>";
                }
            ?>
           
        </div>
    </div>
    
</body>
</html>