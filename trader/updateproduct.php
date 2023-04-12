<?php
  include('connection.php');


//   Update Product code
  if(isset($_POST['updateProduct']))
  {
        $uid = $_POST['uid'];
          $name = $_POST['productname'];
          $category = $_POST['productcategory'];
          $description = $_POST['description'];
          $shop = $_POST['shopname'];
          $price = $_POST['productprice'];
          $offer = $_POST['offer'];
          $quantity =  $_POST['quantity'];
          $stock =   $_POST['productstock'];
          $previous = $_POST['previous'];
          // image uploads
          $image = $_FILES["productimage"]["name"];
          $utype = $_FILES['productimage']['type'];
          $utmpname = $_FILES['productimage']['tmp_name'];
          $usize = $_FILES['productimage']['size'];
          $ulocation = "../db/uploads/products/".$image;

          if(!empty($image)){
            $sql = "UPDATE products SET Name='$name', Category='$category',Description='$description',
            ShopName='$shop',Image='$image',Price='$price',Offer='$offer',Quantity='$quantity',Stock='$stock' WHERE Id='$uid' ";
            $qry = mysqli_query($connection,$sql) or die(mysqli_error($connection));
            
            if(unlink("../db/uploads/products".$previous)){
              if(move_uploaded_file($utmpname,$ulocation)){
                if($qry){
                  header('Location:traderdashboard.php');
                }
              }
            }
          }
          else{
            $sql = "UPDATE products SET Name='$name', Category='$category',Description='$description',
            ShopName='$shop',Image='$previous',Price='$price',Offer='$offer',Quantity='$quantity',Stock='$stock' WHERE Id='$uid'";
            $qry = mysqli_query($connection,$sql) or die(mysqli_error($connection));
            
            if($qry){
                header('Location:traderdashboard.php');
            }
          }                 
  }

?>