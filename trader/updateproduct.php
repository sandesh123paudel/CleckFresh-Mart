<?php
session_start();
  include('../db/connection.php');


//   Update Product code
  if(isset($_POST['updateProduct']))
  {
          $uid = $_POST['uid'];
          echo "UID: $uid <br>";
          $name = $_POST['productname'];
          echo "Name : $name";
          $category_id =  $_POST['productcategory'];
          echo "Category_ID: $category_id <br>";
          $category = $_SESSION['type'];
          echo "Category $category <br>";
          $description = $_POST['description'];
          echo "Description: $description <br>";
          $shop_id =  $_POST['shopname'];
          echo "Shop ID : $shop_id <br>";
          $price = $_POST['productprice'];
          echo "price: $price <br>";
          $offer_id =  $_POST['offer'];
          echo "offer_id: $offer_id <br>";
          $quantity =  $_POST['quantity'];
          echo "Quantity: $quantity <br>";
          $stock =   $_POST['productstock'];
          echo "Stock : $stock <br>";
          $previous = $_POST['previousimage'];
          echo "Image : $previous <br>";

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

            if (unlink("../db/uploads/products/" . $uprevious)) {
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