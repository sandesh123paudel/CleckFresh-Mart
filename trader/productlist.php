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
    <link rel="stylesheet" href="css/shop.css">
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
            // selecting all items from product
                $sql = "SELECT * FROM PRODUCT WHERE PRODUCT_TYPE = :product_cat";
                $stid = oci_parse($connection,$sql);
                oci_bind_by_name($stid,':product_cat',$_SESSION['type']);

                oci_execute($stid);
                
                while($row = oci_fetch_array($stid, OCI_ASSOC)){
                    $pid = $row['PRODUCT_ID'];
                    $s_id = $row['SHOP_ID'];

                    $sql1 = "SELECT SHOP_NAME FROM SHOP WHERE SHOP_ID = :s_id";
                    $stid1 = oci_parse($connection,$sql);
                    oci_bind_by_name($stid1,':product_cat',$s_id);

                    if(oci_execute($stid1)){
                        echo "<div class='card'>";
                            echo "<div class='card-info'>";
                                echo "<div class='card-details'>";
                                    echo "<label>P_ID :  ".$row['PRODUCT_ID']."</label>";
                                    echo "<label>Name:  ".$row['PRODUCT_NAME']."</label>";
                                    
                                    echo "<label>Shop Name:  ".$row['SHOP_ID']."</label>";

                                    echo "<label>Price:  <span>".$row['PRODUCT_PRICE'] ."<span></label>";
                                echo "</div>";
                                
                                echo "<div class='image'>";
                                    echo "<img src=\"../db/uploads/products/".$row['PRODUCT_IMAGE']."\" alt=".$row['PRODUCT_NAME']." >";
                                echo "</div>";
                            echo "</div>"; 
        
                            echo "<div class='btns'>";
                                echo "<a href='traderdashboard.php?cat=EditProduct&id=$pid&action=edit&name=Products' id='edit'>Edit</a>";
                                echo "<a href='deleteproduct.php?&id=$pid&action=delete' id='delete'>Delete</a>";
                            echo "</div>";
                    
                        echo "</div>";
                    }
                }


            ?>
           
        </div>
    </div>
    
</body>
</html>