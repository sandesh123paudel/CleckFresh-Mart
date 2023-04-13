<?php
  // inculde database connection
  include('../db/connection.php');
  $errname = $errprice = $errqty = $errstock =$errimage ='';
  if(isset($_POST['addProduct']))
  {
      if(empty($_POST['productname'])){
          $errname ="Name is required";
      }
      if(empty($_POST['productprice'])){
          $errprice ="Price is required";
      }
      if(empty($_POST['quantity'])){
          $errqty ="Category is required";
      }
      if(empty($_POST['productstock'])){
          $errstock="Stock is required";
      }
      if(empty($_FILES["productimage"]["name"])){
          $errimage ="Image is required";
      }
      else{
          $name = $_POST['productname'];
          $category = $_POST['productcategory'];
          $description = $_POST['description'];
          $shop = $_POST['shopname'];
          $price = $_POST['productprice'];
          $offer = $_POST['offer'];
          $quantity =  $_POST['quantity'];
          $stock =   $_POST['productstock'];
          // image uploads
          $image = $_FILES["productimage"]["name"];
          $utype = $_FILES['productimage']['type'];
          $utmpname = $_FILES['productimage']['tmp_name'];
          $usize = $_FILES['productimage']['size'];
          $ulocation = "../db/uploads/products/".$image;
              if($utype=="image/jpeg" || $utype=="image/jpg" || $utype=="image/png" || $utype=="image/gif" || $utype=="image/webp")
              {
                  $sql = "INSERT INTO products (Name,Category,Description,ShopName,Image,Price,Offer,Quantity,Stock) 
                      VALUES('$name','$category','$description','$shop','$image','$price','$offer','$quantity','$stock')";
                  $qry = mysqli_query($connection,$sql) or die(mysqli_error($connection));
                  if($qry){
                      if(move_uploaded_file($utmpname,$ulocation)){
                          echo "<script>window.alert('Data Inserted Successfully!')</script>";
                          // header("Location:traderdashboard.php");
                      } 
                      else{
                          echo "Unable to insert file";
                      }     
                  }
              }
              else{
                  $errimage ="Image type doesnot match";
              }
      }
  }
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
    <div class="product-container">
      <h2>ADD NEW PRODUCT</h2>
      <!-- form to add products -->
      <form method="POST" enctype="multipart/form-data" action="">
        <!-- Part 1 -->
        <div class="product-part1">
          <!-- Image upload -->
          <div class="image-file">
            <label>Product Images </label>
            <p>
              Upload Image
              <span class="error">
                *
                <?php echo $errimage; ?>
              </span>
            </p>
            <input
              type="file"
              class="inputbox"
              name="productimage"
              placeholder="UploadImage"
            />
          </div>
          <!--  -->
          <div class="info1">
            <h3>Product Information</h3>
            <p>Please Provide detailed Information</p>
          </div>

          <div class="info2">
            <label
              >Product Name
              <span class="error">
                *
                <?php echo $errname; ?>
              </span>
            </label>
            <input
              type="text"
              class="inputbox"
              name="productname"
              placeholder="Product Name"
            />
          </div>

          <div class="info2">
            <label>Product Category</label>

            <input
              type="text"
              class="inputbox"
              name="productcategory"
              placeholder="Product Category"
            />
          </div>

          <div class="info2">
            <label>Description</label>
            <textarea
              name="description"
              class="inputbox "
              cols="30"
              rows="5"
              placeholder="Write description about products..."
            ></textarea>
          </div>

          <div class="info2">
            <label>Shop Name</label>
            <input
              type="text"
              class="inputbox"
              name="shopname"
              placeholder="Shop Name"
            />
          </div>
        </div>
        <!-- part 2 -->
        <div class="product-part2">
          <div class="part2-info">
            <h3>Pricing</h3>
            <p>Please provide detailed information</p>
          </div>

          <div class="info2">
            <label
              >Base Price
              <span class="error">
                *
                <?php echo $errprice; ?>
              </span></label
            >
            <input
              type="text"
              class="inputbox"
              name="productprice"
              placeholder="Base Price"
            />
          </div>

          <div class="info2">
            <label>Offer Type</label>
            <select class="inputbox" name="offer">
              <option value="">Choose Offer Type</option>
              <option value="10">Offer 1</option>
              <option value="20">Offer 2</option>
              <option value="30">Offer 3</option>
            </select>
          </div>
          <div class="info2">
            <label
              >Quantity
              <span class="error">
                *
                <?php echo $errqty; ?>
              </span></label
            >
            <select class="inputbox" name="quantity">
              <option value="">Please Select Quantity</option>
              <option value="10">10</option>
              <option value="20">20</option>
              <option value="30">30</option>
            </select>
          </div>
          <div class="info2">
            <label
              >Stock
              <span class="error">
                *
                <?php echo $errstock; ?>
              </span></label
            >
            <input
              type="text"
              class="inputbox"
              name="productstock"
              placeholder="Product Stock"
            />
          </div>
        </div>

        <div class="add-product">
          <input
            type="submit"
            name="addProduct"
            value="Add Product +"
            class="addbtn"
          />
        </div>
      </form>
    </div>
  </body>
</html>