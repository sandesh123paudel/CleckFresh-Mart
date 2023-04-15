<?php
  include("../db/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="css/add.css" />
  </head>
  <body>

  <?php


    if(isset($_GET['id']) && isset($_GET['action'])){
      $eid = $_GET['id'];
      
      // echo $eid;

      $sql = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = :eid";

      $stid = oci_parse($connection,$sql);
      oci_bind_by_name($stid, ':eid' ,$eid);
      oci_execute($stid);

    }

    while($row = oci_fetch_array($stid, OCI_ASSOC)){
      $pid = $row['PRODUCT_ID'];
      $pcategory_id = (int)$row['CATEGORY_ID'];
      $pshop_id = (int)$row['SHOP_ID'];
      $poffer_id = (int)$row['OFFER_ID'];
      $pname = $row['PRODUCT_NAME'];
      $pprice = $row['PRODUCT_PRICE'];
      // $pcategory = $row['PRODUCT_TYPE'];
      $pdescription = $row['PRODUCT_DESCP'];
      $pquantity =  (int)$row['QUANTITY'];
      $pstock =  (int)$row['STOCK_NUMBER'];
      $pimage = $row['PRODUCT_IMAGE'];
    }

    echo "<div class='product-container'>";
      echo "<h2>UPDATE PRODUCT</h2>";
      echo "<form method='POST' enctype='multipart/form-data' action='updateproduct.php'>";
          echo "<input type='hidden' name='uid' value='$pid'>";
        echo "<div class='product-part1'>";
          echo "<div class='image-file'>";
            echo "<label>Product Images</label>";
            echo "<p>Upload Image</p>";
            echo "<input type='hidden' name='previous' value='$pimage' />";
            echo "<input type='file' class='inputbox' name='productimage' placeholder='UploadImage' value='$pimage' />";
          echo "</div>";
          echo "<div class='info1'>";
            echo "<h3>Product Information</h3>";
            echo "<p>Please Provide detailed Information</p>";
          echo "</div>";

          echo "<div class='info2'>";
            echo "<label>Product Name</label>";
            echo "<input type='text' class='inputbox' name='productname' placeholder='Product Name'  value='$pname' />";
          echo "</div>";

          echo "<div class='info2'>";
            echo "<label>Product Category</label>";
            
            $sql = "SELECT * FROM CATEGORY WHERE CATEGORY_ID = :cat_id";
            $stid = oci_parse($connection,$sql);
            oci_bind_by_name($stid, ':cat_id', $pcategory_id); 
            oci_execute($stid);

            while($row = oci_fetch_array($stid,OCI_ASSOC)){
              echo "<option value=".$row['CATEGORY_ID'].">".$row['CATEGORY_NAME']."</option>";
            }
          
            // echo "<input type='text' class='inputbox' name='productcategory' placeholder='Product Category' value='$pcategory' />";
            
          echo "</div>";

          echo "<div class='info2'>";
            echo "<label>Description</label>";
            echo "<textarea name='description' class='inputbox' cols='30' rows='5' placeholder='Write description about products...' >
              ". $pdescription ."</textarea> ";
          echo "</div>";

          echo "<div class='info2'>";
            echo "<label>Shop Name</label>";

            $sql = "SELECT * FROM SHOP WHERE SHOP_ID = :shop_id";
            $stid = oci_parse($connection,$sql);
            oci_bind_by_name($stid, ':shop_id', $pshop_id); 
            oci_execute($stid);

            while($row = oci_fetch_array($stid,OCI_ASSOC)){
              echo "<option value=".$row['SHOP_ID'].">".$row['SHOP_NAME']."</option>";
            }

            // echo "<input
            //   type='text'
            //   class='inputbox'
            //   name='shopname'
            //   placeholder='Shop Name'
            //   value='$pshop'
            // />";
          echo "</div>";
        echo "</div>";
        
        echo "
        
        <div class='product-part2'>
          <div class='part2-info'>
            <h3>Pricing</h3>
            <p>Please provide detailed information</p>
          </div>

          <div class='info2'>
            <label>Base Price</label>
            <input
              type='text'
              class='inputbox'
              name='productprice'
              placeholder='Base Price'
              value='$pprice'
            />
          </div>

          <div class='info2'>
            <label>Offer Type</label>
            <select class='inputbox selectbox' name='offer'>".
              
                $sql = "SELECT * FROM OFFER WHERE OFFER_ID = :offer_id";
                $stid = oci_parse($connection,$sql);
                oci_bind_by_name($stid,":offer_id",$poffer_id );
                oci_execute($stid);

                while($row = oci_fetch_array($stid,OCI_ASSOC)){
                  echo "<option value=".$row['OFFER_ID'].">".$row['OFFER_NAME']."</option>";
                }
                // options for selecting offers
                $sql1 = "SELECT * FROM OFFER";
                $stid1 = oci_parse($connection,$sql1);
                oci_execute($stid1);

                while($row = oci_fetch_array($stid1,OCI_ASSOC)){
                  echo "<option value=".$row['OFFER_ID'].">".$row['OFFER_NAME']."</option>";
                }
                
              ."
            </select>
          </div>
          <div class='info2'>
            <label>Quantity</label>
            
            <select class='inputbox selectbox' name='quantity'>
              <option value='$pquantity'>$pquantity</option>
              <option value='250'>250gm</option>
              <option value='500'>500gm</option>
              <option value='1000'>1000gm</option>
            </select>

          </div>
          <div class='info2'>
            <label>Stock</label>
            <input
              type='text'
              class='inputbox'
              name='productstock'
              placeholder='Product Stock'
              value='$pstock'
            />
          </div>
        </div>

        <div class='add-product'>
          <input
            type='submit'
            name='updateProduct'
            value='Update Product +'
            class='addbtn'
          />
         
        </div>
      </form>
    </div>";

    ?>

  </body>
</html>
