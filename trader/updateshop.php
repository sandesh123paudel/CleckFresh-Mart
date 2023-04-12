<?php
  include('connection.php');

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
            $sql = "UPDATE shop SET Name='$name',Category='$category',Image='$image',Email='$email',Phone='$phone'  WHERE Id='$uid' ";
            $qry = mysqli_query($connection,$sql) or die(mysqli_error($connection));
            
            if(unlink("../db/uploads/shops".$previous)){
              if(move_uploaded_file($utmpname,$ulocation)){
                if($qry){
                    header('location:traderdashboard.php');
                }
              }
            }
          }
          else{
            $sql = "UPDATE shop SET Name='$name',Category='$category',Image='$previous',Email='$email',Phone='$phone'  WHERE Id='$uid' ";
            $qry = mysqli_query($connection,$sql) or die(mysqli_error($connection));
            
            if($qry){
                header('location:traderdashboard.php');
            }
          }         
      }

?>