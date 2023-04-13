<?php
  include('../db/connection.php');

//   update Shop code

  if(isset($_POST['updateshop']))
  {
          $uid = $_POST['uid'];
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
            $sql = "UPDATE shop SET Name= :name,Category= :category,Image= :image,Email= :email,Phone= :phone  WHERE Id= :uid ";
            
            $stid = oci_parse($connection,$sql);
                                    
            oci_bind_by_name($stid ,':uid',$uid);
            oci_bind_by_name($stid ,':name',$name);
            oci_bind_by_name($stid ,':category',$category);
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
            $sql = "UPDATE shop SET Name= :name,Category= :category,Image= :previous,Email= :email,Phone= :phone  WHERE Id= :uid ";
            $stid = oci_parse($connection,$sql);
                                    
            oci_bind_by_name($stid ,':uid',$uid);
            oci_bind_by_name($stid ,':name',$name);
            oci_bind_by_name($stid ,':category',$category);
            oci_bind_by_name($stid ,':previous',$previous);
            oci_bind_by_name($stid ,':email',$email);
            oci_bind_by_name($stid ,':phone',$phone);

            if(oci_execute($stid)){
                header('location:traderdashboard.php');
            }
          }         
      }

?>