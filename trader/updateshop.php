<?php
  session_start();
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
          $previouslogo = $_FILES['previouslogo'];
          $logo = $_FILES['shoplogo']['name'];


          $utype = $_FILES['shopimage']['type'];

          $utmpname = $_FILES['shopimage']['tmp_name'];
          $utmplogo = $_FILES['shoplogo']['tmp_name'];

          $usize = $_FILES['shopimage']['size'];
          $ulocation = "../db/uploads/shops/".$image;
          $ulocationlogo = "../db/uploads/shops/".$logo;

          // if both image field is not empty
          if(!empty($image) && !empty($logo)){
            $sql = "UPDATE SHOP SET USER_ID =:user_id,SHOP_NAME= :sname,SHOP_TYPE= :stype,SHOP_IMAGE= :simage,EMAIL= :email,CONTACT= :phone,SHOP_LOGO =:logo  WHERE SHOP_ID= :sid ";
            
            $stid = oci_parse($connection,$sql);
                                    
            oci_bind_by_name($stid ,':sid',$sid);  
            oci_bind_by_name($stid, ':user_id', $_SESSION['userID']);            
            oci_bind_by_name($stid ,':sname',$name);
            oci_bind_by_name($stid ,':stype',$category);
            oci_bind_by_name($stid ,':simage',$image);
            oci_bind_by_name($stid ,':email',$femail);
            oci_bind_by_name($stid ,':phone',$contact);
            oci_bind_by_name($stid ,':phone',$contact);
            oci_bind_by_name($stid , ':logo' ,$logo);
            
            if(unlink("../db/uploads/shops/".$previous) && unlink("../db/uploads/shops/".$previouslogo)){
              if(move_uploaded_file($utmpname,$ulocation) && move_uploaded_file($utmplogo,$ulocationlogo) ){
                if(oci_execute($stid)){
                    header('location:traderdashboard.php?cat=Shoplist');
                }
              }
            }
          }
          // if image filed is not empty
          if(!empty($image)){
            $sql = "UPDATE SHOP SET USER_ID =:user_id,SHOP_NAME= :sname,SHOP_TYPE= :stype,SHOP_IMAGE= :simage,EMAIL= :email,CONTACT= :phone,SHOP_LOGO = :previouslogo WHERE SHOP_ID= :sid ";
            
            $stid = oci_parse($connection,$sql);
                                    
            oci_bind_by_name($stid ,':sid',$sid);  
            oci_bind_by_name($stid, ':user_id', $_SESSION['userID']);            
            oci_bind_by_name($stid ,':sname',$name);
            oci_bind_by_name($stid ,':stype',$category);
            oci_bind_by_name($stid ,':simage',$image);
            oci_bind_by_name($stid ,':email',$femail);
            oci_bind_by_name($stid ,':phone',$contact);
            oci_bind_by_name($stid ,':phone',$contact);
            oci_bind_by_name($stid , ':previouslogo' ,$previouslogo);
            
            if(unlink("../db/uploads/shops/".$previous) ){
              if(move_uploaded_file($utmpname,$ulocation) ){
                if(oci_execute($stid)){
                    header('location:traderdashboard.php?cat=Shoplist');
                }
              }
            }
          }
          // if logo field is not empty
          if(!empty($logo)){
              $sql = "UPDATE SHOP SET USER_ID =:user_id,SHOP_NAME= :sname,SHOP_TYPE= :stype,SHOP_IMAGE= :simage,EMAIL= :email,CONTACT= :phone,SHOP_LOGO = :logo WHERE SHOP_ID= :sid ";
            
            $stid = oci_parse($connection,$sql);
                                    
            oci_bind_by_name($stid ,':sid',$sid);  
            oci_bind_by_name($stid, ':user_id', $_SESSION['userID']);            
            oci_bind_by_name($stid ,':sname',$name);
            oci_bind_by_name($stid ,':stype',$category);
            oci_bind_by_name($stid ,':simage',$previous);
            oci_bind_by_name($stid ,':email',$femail);
            oci_bind_by_name($stid ,':phone',$contact);
            oci_bind_by_name($stid ,':phone',$contact);
            oci_bind_by_name($stid , ':logo' ,$logo);
            
            if(unlink("../db/uploads/shops/".$previouslogo) ){
              if(move_uploaded_file($utmplogo,$ulocationlogo) ){
                if(oci_execute($stid)){
                    header('location:traderdashboard.php?cat=Shoplist');
                }
              }
            }
          }
          // if both image field is empty
          else{
            $sql1 = "UPDATE SHOP SET SHOP_NAME= :sname,SHOP_TYPE= :category,SHOP_IMAGE= :previous,EMAIL= :email,CONTACT= :phone, SHOP_LOGO= :logoprevious  WHERE SHOP_ID= :sid ";
           
            $stid1 = oci_parse($connection,$sql1);
                                    
            oci_bind_by_name($stid1 ,':sid',$sid);
            oci_bind_by_name($stid1 ,':sname',$name);
            oci_bind_by_name($stid1 ,':category',$category);
            oci_bind_by_name($stid1 ,':previous',$previous);
            oci_bind_by_name($stid1 ,':email',$email);
            oci_bind_by_name($stid1 ,':phone',$phone);
            oci_bind_by_name($stid1 , ':logoprevious' ,$previouslogo);

            if(oci_execute($stid1)){
                header('location:traderdashboard.php?cat=Shoplist');
            }
          }         
      }

?>