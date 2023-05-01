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
      
      $sql = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = :eid";

      $stid = oci_parse($connection,$sql);
      oci_bind_by_name($stid, ':eid' ,$eid);
      oci_execute($stid);

    }
    // $pid = $pcategory_id=$pshop_id=$poffer_id=$pname= $pprice=$pdescription=$pquantity=$pstock=$pimage='';
    while($row = oci_fetch_array($stid, OCI_ASSOC)){
      $pid = $row['PRODUCT_ID'];
      $pcategory_id = $row['CATEGORY_ID'];
      $pshop_id = $row['SHOP_ID'];
      
      if(isset($row['OFFER_ID'])){
        $poffer_id = $row['OFFER_ID'];
      }
      else{
        $poffer_id ='';
      }
      $pname = $row['PRODUCT_NAME'];
      $pprice = $row['PRODUCT_PRICE'];
      // $pcategory = $row['PRODUCT_TYPE'];
      if(isset($row['PRODUCT_DESCP'])){
        $pdescription = $row['PRODUCT_DESCP'];
      }
      else{
        $pdescription = '';
      }
     
      $pquantity =  $row['QUANTITY'];
      $pstock =  $row['STOCK_NUMBER'];
      $pimage = $row['PRODUCT_IMAGE'];
    }
    // echo "Image : $pimage";
?>
     <div class='product-container'>
       <h2>UPDATE PRODUCT</h2>
       <form method='POST' enctype="multipart/form-data" action='updateproduct.php'>
           <input type='hidden' name='uid' value='<?php echo $pid; ?>'>
         <div class='product-part1'>
           <div class='image-file'>
             <label>Product Images</label>
             <p>Upload Image</p>
             <input type='hidden' name='previousimage' value='<?php echo $pimage; ?>' />
             <input type='file' class='inputbox' name='productimage' placeholder='UploadImage' />
           </div>
           <div class='info1'>
             <h3>Product Information</h3>
             <p>Please Provide detailed Information</p>
           </div>

           <div class='info2'>
             <label>Product Name</label>
             <input type='text' class='inputbox' name='productname' placeholder='Product Name'  value='<?php echo $pname; ?>' />
           </div>

           <div class='info2'>
             <label>Product Category</label>
             <select class='inputbox selectbox' name='productcategory'>
              <?php
                $sql = "SELECT * FROM CATEGORY WHERE CATEGORY_ID = :cat_id";
                $stid = oci_parse($connection,$sql);
                oci_bind_by_name($stid, ':cat_id', $pcategory_id); 
                oci_execute($stid);

                while($row = oci_fetch_array($stid,OCI_ASSOC)){
                  echo "<option value=".$row['CATEGORY_ID'].">".$row['CATEGORY_NAME']."</option>";
                }
              ?>
            </select>

             <!-- <input type='text' class='inputbox' name='productcategory' placeholder='Product Category' value='$pcategory' /> -->
            
           </div>

           <div class='info2'>
             <label>Description</label>
             <textarea name='description' class='inputbox' cols='30' rows='5' placeholder='Write description about products...' ><?php echo $pdescription; ?> </textarea> 
           </div>

           <div class='info2'>
             <label>Shop Name</label>
             <select class='inputbox selectbox' name='shopname'>

              <?php
              $sql = "SELECT * FROM SHOP WHERE SHOP_ID = :shop_id";
              $stid = oci_parse($connection,$sql);
              oci_bind_by_name($stid, ':shop_id', $pshop_id) ;
              oci_execute($stid);

              while($row = oci_fetch_array($stid,OCI_ASSOC)){
                echo "<option value=".$row['SHOP_ID'].">".$row['SHOP_NAME']."</option>";
              } 
            ?>
            </select>

            <!-- <input
               type='text'
               class='inputbox'
               name='shopname'
               placeholder='Shop Name'
               value='<?php echo $pshop; ?>'
             /> -->
           </div>
         </div>
        
         
        
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
              value='<?php echo $pprice; ?>'
            />
          </div>

          <div class='info2'>
            <label>Offer Type</label>
            <select class='inputbox selectbox' name='offer'>
              <?php
                $sql = "SELECT * FROM OFFER WHERE OFFER_ID = :offer_id";
                $stid = oci_parse($connection,$sql);
                oci_bind_by_name($stid,':offer_id',$poffer_id );
                oci_execute($stid);

                while($row = oci_fetch_array($stid,OCI_ASSOC)){
                  echo "<option value=".$row['OFFER_ID'].">".$row['OFFER_NAME']."</option>";
                }
                // options for selecting offers
                $sql1 = "SELECT * FROM OFFER";
                $stid1 = oci_parse($connection,$sql1);
                oci_execute($stid1);
                echo "<option value=''>Select an offer</option>";
                while($row = oci_fetch_array($stid1,OCI_ASSOC)){
                   echo "<option value=".$row['OFFER_ID'].">".$row['OFFER_NAME']."</option>";
                }
                ?>
            </select>
          </div>
          <div class='info2'>
            <label>Quantity</label>
            
            <select class='inputbox selectbox' name='quantity'>
              <option value="<?php echo $pquantity; ?>"><?php echo $pquantity; ?>gm</option>
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
              value='<?php echo $pstock; ?>' 
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
    </div>

  </body>
</html>
