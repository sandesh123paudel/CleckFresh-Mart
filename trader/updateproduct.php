<?php
  include('../db/connection.php');


//   Update Product code
  if(isset($_POST['updateProduct']))
  {
          $uid = $_POST['uid'];
          $name = $_POST['productname'];
          $category_id = (int) $_POST['productcategory'];
          $category = $_SESSION['type'];
          $description = $_POST['description'];
          $shop_id = (int) $_POST['shopname'];
          $price = $_POST['productprice'];
          $offer_id = (int) $_POST['offer'];
          $quantity = (int) $_POST['quantity'];
          $stock =  (int) $_POST['productstock'];
          $previous = $_POST['previous'];

          // image uploads
          $image = $_FILES["productimage"]["name"];
          $utype = $_FILES['productimage']['type'];
          $utmpname = $_FILES['productimage']['tmp_name'];
          $usize = $_FILES['productimage']['size'];
          $ulocation = "../db/uploads/products/".$image;

          if(!empty($image)){     
            
            $sql = "UPDATE PRODUCT SET CATEGORY_ID = :category_id, SHOP_ID = :shop_id, OFFER_ID = :offer_id, PRODUCT_NAME = :name, PRODUCT_PRICE = :price, 
            PRODUCT_TYPE= :category, PRODUCT_DESCP= :description, QUANTITY = :quantity, STOCK_NUMBER = :stock, PRODUCT_IMAGE = :image WHERE PRODUCT_ID= :uid";
  
            $stid = oci_parse($connection,$sql);

            oci_bind_by_name($stid ,':uid',$uid);
            oci_bind_by_name($stid ,':category_id',$category_id);
            oci_bind_by_name($stid ,':shop_id',$shop_id);
            oci_bind_by_name($stid ,':offer_id',$offer_id);
            oci_bind_by_name($stid ,':name',$name);
            oci_bind_by_name($stid ,':price',$price);
            oci_bind_by_name($stid ,':category',$category);
            oci_bind_by_name($stid ,':description',$description);
            oci_bind_by_name($stid ,':quantity',$quantity);
            oci_bind_by_name($stid ,':stock',$stock);
            oci_bind_by_name($stid ,':image',$image);

            if(unlink("../db/uploads/products".$previous)){
              if(move_uploaded_file($utmpname,$ulocation)){
                if(oci_execute($stid)){
                  header('Location:traderdashboard.php');
                }
              }
            }
          }
          else{
            $sql = "UPDATE PRODUCT SET CATEGORY_ID = :category_id, SHOP_ID = :shop_id, OFFER_ID = :offer_id, PRODUCT_NAME = :name, PRODUCT_PRICE = :price, 
            PRODUCT_TYPE= :category, PRODUCT_DESCP= :description, QUANTITY = :quantity, STOCK_NUMBER = :stock, PRODUCT_IMAGE = :previous WHERE PRODUCT_ID= :uid";
             
            $stid = oci_parse($connection,$sql);

            oci_bind_by_name($stid ,':uid',$uid);
            oci_bind_by_name($stid ,':category_id',$category_id);
            oci_bind_by_name($stid ,':shop_id',$shop_id);
            oci_bind_by_name($stid ,':offer_id',$offer_id);
            oci_bind_by_name($stid ,':name',$name);
            oci_bind_by_name($stid ,':price',$price);
            oci_bind_by_name($stid ,':category',$category);
            oci_bind_by_name($stid ,':description',$description);
            oci_bind_by_name($stid ,':quantity',$quantity);
            oci_bind_by_name($stid ,':stock',$stock);
            oci_bind_by_name($stid ,':previous',$previous);

            if(oci_execute($stid)){
                header('Location:traderdashboard.php');
            }
          }                 
  }

?>