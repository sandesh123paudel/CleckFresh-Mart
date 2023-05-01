<?php
session_start();
  include('../db/connection.php');


//   Update Product code
  if(isset($_POST['updateProduct']))
  {
          $uid = $_POST['uid'];
          $name = $_POST['productname'];
          $category_id =  $_POST['productcategory'];
          $category = $_SESSION['type'];
          $description = $_POST['description'];
          $shop_id =  $_POST['shopname'];
          $price = $_POST['productprice'];
          $offer_id =  $_POST['offer'];
          $quantity =  $_POST['quantity'];
          $stock =   $_POST['productstock'];
          $previous = $_POST['previousimage'];

          $image = $_FILES["productimage"]["name"];
          $utype = $_FILES['productimage']['type'];
          $utmpname = $_FILES['productimage']['tmp_name'];
          $usize = $_FILES['productimage']['size'];
          $ulocation = "../db/uploads/products/".$image;

          if(!empty($image)){     
            
            $sql = "UPDATE PRODUCT SET CATEGORY_ID= :category_id, SHOP_ID= :shop_id, OFFER_ID= :offer_id, PRODUCT_NAME= :pname, PRODUCT_PRICE= :price, PRODUCT_TYPE= :category, PRODUCT_DESCP= :pdescription, QUANTITY= :quantity, STOCK_NUMBER= :stock, PRODUCT_IMAGE= :uimage WHERE PRODUCT_ID= :puid ";

            $stid = oci_parse($connection, $sql);
    
            oci_bind_by_name($stid, ':puid', $uid);
            oci_bind_by_name($stid ,':category_id',$category_id);
            oci_bind_by_name($stid ,':shop_id',$shop_id);
            oci_bind_by_name($stid ,':offer_id',$offer_id);
            oci_bind_by_name($stid ,':pname',$name);
            oci_bind_by_name($stid ,':price',$price);
            oci_bind_by_name($stid ,':category',$category);
            oci_bind_by_name($stid ,':pdescription',$description);
            oci_bind_by_name($stid ,':quantity',$quantity);
            oci_bind_by_name($stid ,':stock',$stock);
            oci_bind_by_name($stid ,':uimage',$image);

            if (unlink("../db/uploads/products/" . $previous)) {
                if (move_uploaded_file($utmpname, $ulocation)) {
                    if (oci_execute($stid)) {
                        header('Location:traderdashboard.php?cat=Productlist');
                    }
                }
            }
          }
          else{
            $sql = "UPDATE PRODUCT SET CATEGORY_ID= :category_id, SHOP_ID= :shop_id, OFFER_ID= :offer_id, PRODUCT_NAME= :pname, PRODUCT_PRICE= :price, PRODUCT_TYPE= :category, PRODUCT_DESCP= :pdescription, QUANTITY= :quantity, STOCK_NUMBER= :stock, PRODUCT_IMAGE= :previous WHERE PRODUCT_ID= :puid ";

            $stid = oci_parse($connection, $sql);
    
            oci_bind_by_name($stid, ':puid', $uid);
            oci_bind_by_name($stid ,':category_id',$category_id);
            oci_bind_by_name($stid ,':shop_id',$shop_id);
            oci_bind_by_name($stid ,':offer_id',$offer_id);
            oci_bind_by_name($stid ,':pname',$name);
            oci_bind_by_name($stid ,':price',$price);
            oci_bind_by_name($stid ,':category',$category);
            oci_bind_by_name($stid ,':pdescription',$description);
            oci_bind_by_name($stid ,':quantity',$quantity);
            oci_bind_by_name($stid ,':stock',$stock);
            oci_bind_by_name($stid ,':previous',$previous);
            $result = oci_execute($stid);
            
            if($result){
                header('location:traderdashboard.php?cat=Productlist');
            }
          }                 
  }

?>