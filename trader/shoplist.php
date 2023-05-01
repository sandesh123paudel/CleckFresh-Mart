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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/shop.css">
</head>
<body>
    <div class="shop-container">
        <div class="shop_header">
            <h3>Shops Lists</h3>
                <div class="search-box">
                        <div class="search">
                            <form action="">
                                <input type="text" placeholder="Search...">
                                
                                <button type="submit" class='searchbtn'>
                                    <i class="fa fa-search"></i>
                                </button>
                            </from>
                        </div>

                    <select name="filter" id="">
                        <option value="">All</option>
                        <option value="Asce">Asce</option>
                        <option value="Desc">Desc</option>
                    </select>  
                </div>  
        </div>

        
        <div class="shopitems">
            <?php
     
            // selecting all items from shops
                $sql = "SELECT * FROM SHOP WHERE SHOP_TYPE = :shop_cat";
                $stid = oci_parse($connection,$sql);
                oci_bind_by_name($stid,':shop_cat',$_SESSION['type']);
                oci_execute($stid);
                
                while($row = oci_fetch_array($stid,OCI_ASSOC)){
                    $id = $row['SHOP_ID'];

                    echo "<div class='shop-item'>";
                        echo "<div class='image'>";
                        echo "<img src=\"../db/uploads/shops/".$row['SHOP_LOGO']."\" alt=".$row['SHOP_NAME']." >";
                        echo "</div>";
                        echo "<div class='shop-info'>";
                        echo "<label>Shop ID: ".$row['SHOP_ID']."</label>";
                        echo "<label >Shop Name: ". substr($row['SHOP_NAME'],0,25)."</label>";
                        echo "</div>";
                        
                        echo "<div class='buttons'>";
                            echo "<a href='traderdashboard.php?cat=EditShop&id=$id&action=edit&name=Shops' id='edit'>Edit</a>";
                            echo "<a href='deleteshop.php?id=$id&action=delete' id='delete'>Delete</a>";
                        echo "</div>";
                        
                    echo "</div>";
                }
            ?>
           
        </div>
    </div>
    
</body>
</html>