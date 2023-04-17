<?php
  include('../db/connection.php');

//   update Shop code

  if(isset($_POST['updateshop']))
  {
          $sid = $_POST['uid'];
          $name = $_POST['shopname'];
          $phone = $_POST['phone'];
          $email = $_POST['email'];
          $category = $_POST['shopcategory'];

          $previous = $_POST['previous'];
          $image = $_FILES["shopimage"]["name"];

          $utype = $_FILES['shopimage']['type'];
          $utmpname = $_FILES['shopimage']['tmp_name'];
          $usize = $_FILES['shopimage']['size'];
          $ulocation = "../db/uploads/shops/".$image;
          
          if(!empty($image)){
            $sql = "UPDATE SHOP SET SHOP_NAME= :name,SHOP_TYPE= :type,SHOP_IMAGE= :image,EMAIL= :email,CONTACT= :phone  WHERE SHOP_ID= :sid ";
            
            $stid = oci_parse($connection,$sql);
                                    
            oci_bind_by_name($stid ,':sid',$sid);
            oci_bind_by_name($stid ,':name',$name);
            oci_bind_by_name($stid ,':type',$type);
            oci_bind_by_name($stid ,':image',$image);
            oci_bind_by_name($stid ,':email',$email);
            oci_bind_by_name($stid ,':phone',$phone);
            
            if(unlink("../db/uploads/shops".$previous)){
              if(move_uploaded_file($utmpname,$ulocation)){
                if(oci_execute($stid)){
                    header('location:traderdashboard.php');
                }
              }
            }
          }
          else{
            $sql1 = "UPDATE SHOP SET SHOP_NAME= :name,SHOP_TYPE= :category,SHOP_IMAGE= :previous,EMAIL= :email,CONTACT= :phone  WHERE SHOP_ID= :sid ";
            $stid1 = oci_parse($connection,$sql1);
                                    
            oci_bind_by_name($stid1 ,':sid',$sid);
            oci_bind_by_name($stid1 ,':name',$name);
            oci_bind_by_name($stid1 ,':category',$category);
            oci_bind_by_name($stid1 ,':previous',$previous);
            oci_bind_by_name($stid1 ,':email',$email);
            oci_bind_by_name($stid1 ,':phone',$phone);

            if(oci_execute($stid1)){
                header('location:traderdashboard.php?cat=Shoplist');
            }
          }         
      }

?>