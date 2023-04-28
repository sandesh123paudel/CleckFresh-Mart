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
    <link rel="stylesheet" href="css/add.css" />
</head>
<body>
    <?php

        if(isset($_GET['id']) && isset($_GET['action'])){
            $eid = $_GET['id'];

            $sql = "SELECT * FROM  SHOP WHERE SHOP_ID = :eid";

            $stid = oci_parse($connection,$sql);
            oci_bind_by_name($stid, ':eid' ,$eid);
            oci_execute($stid);
              
        }    

        while($row = oci_fetch_array($stid, OCI_ASSOC)){
            $eid = $row['SHOP_ID'];
            $ename = $row['SHOP_NAME'];
            $ecategory = $row['SHOP_TYPE'];
            $eemail = $row['EMAIL'];
            $ephone = $row['CONTACT'];
            $eimage = $row['SHOP_IMAGE'];
            $elogo = $row['SHOP_LOGO']; 
        }     

    ?>

    <div class='product-container'>
        <h2>UPDATE SHOP</h2>
        <form method='POST' enctype='multipart/form-data' action='updateshop.php'>

            <div class='product-part1'>
                <input type='hidden' name='uid' value='<?php echo $eid ; ?>'>
                <div class='image-file'>
                    <label>Shop Images</label>
                    <p>Upload Image</p>
                    <input type='hidden' name='previousimage' value='<?php echo $eimage; ?>' />
                    <input type='file' class='inputbox' name='shopimage' placeholder='UploadImage' value='<?php echo $eimage; ?>'/>
                </div>

                <div class='image-file'>
                    <label>Shop Logo</label>
                    <p>Upload Logo</p>
                    <input type='hidden' name='previouslogo' value='<?php echo $elogo; ?>' />
                    <input type='file' class='inputbox' name='shoplogo' placeholder='UploadImage' value='<?php echo $elogo; ?>'/>
                </div>
              
                    <div class='info1'>
                        <h3>Shop Information</h3>
                        <p>Please Provide detailed Information</p>
                    </div>
                    
                    <div class='info2'>
                        <label>Shop Name</label>
                        <input type='text' class='inputbox' name='shopname' placeholder='Shop Name' value='<?php echo $ename; ?>'/>
                    </div>

                    <div class='info2'>
                        <label>Shop Category</label>
                        <select class='inputbox selectbox' name='shopcategory'>
                            <option value="<?php echo $ecategory; ?>"><?php echo $ecategory; ?></option>
                        </select>
                        <!-- <input type='text' class='inputbox' name='shopcategory' placeholder='Shop Category' value='<?php echo $ecategory; ?>' /> -->
                    </div>
                    
                    <div class='info2'>
                        <label>Email</label>
                        <input type='email' class='inputbox' name='email' placeholder='Email' value='<?php echo $eemail; ?>'/>
                    </div>

                    
                    <div class='info2'>
                        <label>Phone Number</label>
                        <input type='number' class='inputbox' name='phone' maxlength='10' placeholder='Phone Number' value='<?php echo $ephone; ?>' />
                    </div> 
            </div>
            <div class='add-product'>
                <input type='submit' name='updateshop' value='Update Shop +' class='addbtn' />
            </div>
        </form>
    </div>  
</body>
</html>