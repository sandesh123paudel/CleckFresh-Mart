<?php
  include('../db/connection.php');

if(isset($_POST['filter'])){
    echo $_POST['filter'];
}

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
            <h3>Productss Lists</h3>
                <div class="search-box">
                    
                        <div class="search">
                            <form action="">
                                <input type="text" placeholder="Search...">
                                
                                <button type="submit" class='searchbtn'>
                                    <i class="fa fa-search"></i>
                                </button>
                            </from>
                        </div>
                   

                        <select name="filter" >
                            <option value="" >All</option>
                            <?php
                                $sql = "SELECT * FROM SHOP WHERE SHOP_TYPE = :s_cat";
                                $stid = oci_parse($connection,$sql);
                                oci_bind_by_name($stid,':s_cat' ,$_SESSION['type']);
                                oci_execute($stid);
                                while($row = oci_fetch_array($stid,OCI_ASSOC)){
                                    $s_id = $row['SHOP_ID'];
                                    $s_name = $row['SHOP_NAME'];
                                    $_SESSION['shopid']=$s_id;
                                    echo "<option value='$s_id' >".$s_name."</option>";
                                }
                            ?>
                        </select>          
                </div>

        </div>

        
        <div class="shopitems">
            <?php
            // selecting all items from product

                if(isset($_GET['shopid'])){
                    $sql = "SELECT * FROM PRODUCT WHERE SHOP_ID = :s_id";
                    $stid = oci_parse($connection,$sql);
                    oci_bind_by_name($stid,':s_id',$_GET['shopid']);
                }
                else{
                    $sql = "SELECT * FROM PRODUCT WHERE PRODUCT_TYPE = :product_cat";
                    $stid = oci_parse($connection,$sql);
                    oci_bind_by_name($stid,':product_cat',$_SESSION['type']);
                }
                
    
                oci_execute($stid);
                
                while($row = oci_fetch_array($stid, OCI_ASSOC)){
                    $pid = $row['PRODUCT_ID'];
                    $s_id = $row['SHOP_ID'];

                    $sql1 = "SELECT SHOP_NAME AS SHOPNAME FROM SHOP WHERE SHOP_ID = :s_id ";
                            $stid1 = oci_parse($connection,$sql1);
                            oci_bind_by_name($stid1 , ':s_id', $s_id);

                            oci_define_by_name($stid1 , 'SHOPNAME', $shopname);
                            oci_execute($stid1);
                            
                    if(oci_fetch($stid1)){
                        echo "<div class='card'>";
                            echo "<div class='card-info'>";
                                echo "<div class='card-details'>";
                                    echo "<label>P_ID :  ".$row['PRODUCT_ID']."</label>";
                                    echo "<label>Name:  ".substr($row['PRODUCT_NAME'],0,25)."</label>";
                                    
                                    echo "<label>Shop Name:  ". substr($shopname,0,25)."</label>";

                                    echo "<label>Price:  <span> &pound; ".$row['PRODUCT_PRICE'] ."<span></label>";
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