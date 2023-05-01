<?php
  // inculde database connection
  include('../db/connection.php');

  $errname = $errprice= $errcategory= $errshop= $errqty = $errstock =$errimage ='';
  $errcount = 0;

  if(isset($_POST['addProduct']))
  {
      if(empty($_POST['productname'])){
          $errname ="Name is required";
      }
      if(empty($_POST['productprice'])){
          $errprice ="Price is required";
      }
      if(empty($_POST['quantity'])){
          $errqty ="Quantity is required";
      }
      if(empty($_POST['productstock'])){
          $errstock="Stock is required";
      }
      if(empty($_POST['productcategory'])){
        $errcategory="Category is required";
      }
      if(empty($_POST['shopname'])){
        $errshop="ShopName is required";
      }
      if(empty($_FILES["productimage"]["name"])){
          $errimage ="Image is required";
      }
      else{
          $description = $offer_id ='';
          $name = $_POST['productname'];
          $category_id =  $_POST['productcategory'];
          $category = $_SESSION['type'];
          $description = $_POST['description'];
          
          $shop_id =  $_POST['shopname'];
          $price = $_POST['productprice'];
          $offer_id =  $_POST['offer'];
          $quantity =  $_POST['quantity'];
          $stock =   $_POST['productstock'];

          // image uploads
          $image = $_FILES["productimage"]["name"];
          $utype = $_FILES['productimage']['type'];
          $utmpname = $_FILES['productimage']['tmp_name'];
          $ulocation = "../db/uploads/products/".$image;

          $sql = "SELECT * FROM PRODUCT WHERE PRODUCT_NAME= :p_name";
          $stid1 = oci_parse($connection,$sql);
          oci_bind_by_name($stid1 , ":p_name" , $name);
          oci_execute($stid1);
          $p_name='';
          while($row = oci_fetch_array($stid1,OCI_ASSOC)){
            $p_name = $row['PRODUCT_NAME'];
          }
          
          if($p_name == $name){
            $errcount+=1;
            $errname="Product Name is Already exists";
          }

          if($errcount == 0)
          {
              if($utype=="image/jpeg" || $utype=="image/jpg" || $utype=="image/png" || $utype=="image/gif" || $utype=="image/webp")
              {
                  $sql1 = "INSERT INTO PRODUCT (CATEGORY_ID, SHOP_ID, OFFER_ID, PRODUCT_NAME, PRODUCT_PRICE, PRODUCT_TYPE, PRODUCT_DESCP, QUANTITY, STOCK_NUMBER, PRODUCT_IMAGE) 
                  VALUES(:category_id, :shop_id,:offer_id, :name, :price, :category, :description, :quantity, :stock, :image )";
                
                  $stid = oci_parse($connection,$sql1);
                  
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

                  if(oci_execute($stid)){
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
      <form method="POST" 
       action="">
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
            <label>Product Category
            <span class="error">
                *
                <?php echo $errcategory; ?>
              </span>
            </label>
            
            <!-- <input
              type="text"
              class="inputbox"
              name=""
              placeholder="Product Category"
              value="<?php echo $_SESSION['type']; ?>";
            /> -->
            
            <select class="inputbox" name="productcategory">
              <!-- <option value="<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['type']; ?></option> -->
              <?php
                $sql = "SELECT * FROM CATEGORY WHERE CATEGORY_NAME = :cat_name";
                $stid = oci_parse($connection,$sql);
                oci_bind_by_name($stid, ':cat_name', $_SESSION['type']); 
                oci_execute($stid);

                while($row = oci_fetch_array($stid,OCI_ASSOC)){
                  echo "<option value=".$row['CATEGORY_ID'].">".$row['CATEGORY_NAME']."</option>";
                }
                ?>
            </select>

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
            <label>Shop Name
            <span class="error">
                *
                <?php echo $errshop; ?>
              </span>
            </label>
            <select class="inputbox" name="shopname">
              <option value="">Please Select Shop</option>
              <?php
                $sql = "SELECT * FROM SHOP WHERE USER_ID = :user_id";
                $stid = oci_parse($connection,$sql);
                oci_bind_by_name($stid, ':user_id', $_SESSION['userID']); 
                oci_execute($stid);

                while($row = oci_fetch_array($stid,OCI_ASSOC)){
                  echo "<option value=".$row['SHOP_ID'].">".$row['SHOP_NAME']."</option>";
                }
                
                ?>
            </select>
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
              <?php
                $sql = "SELECT * FROM OFFER";
                $stid = oci_parse($connection,$sql);
                oci_execute($stid);

                while($row = oci_fetch_array($stid,OCI_ASSOC)){
                  echo "<option value=".$row['OFFER_ID'].">".$row['OFFER_NAME']."</option>";
                }
                ?>
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
              <option value="250">250gm</option>
              <option value="500">500gm</option>
              <option value="1000">1000gm</option>
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
              type="number"
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