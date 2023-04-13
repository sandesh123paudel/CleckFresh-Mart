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

  <?php

include('../db/connection.php');

    if(isset($_GET['id']) && isset($_GET['action'])){
      $eid = $_GET['id'];

      $sql = "SELECT * FROM products WHERE Id = $eid";
      $qry = mysqli_query($connection,$sql) or die(mysqli_error($connection));
    }

    while($row = mysqli_fetch_array($qry)){
      $eid = $row['Id'];
      $ename = $row['Name'];
      $ecategory = $row['Category'];
      $edescription = $row['Description'];
      $eshop = $row['ShopName'];
      $eprice = $row['Price'];
      $eoffer = $row['Offer'];
      $equantity =  $row['Quantity'];
      $estock =  $row['Stock'];
      $eimage = $row['Image'];
    }

    echo "<div class='product-container'>";
      echo "<h2>UPDATE PRODUCT</h2>";
      echo "<form method='POST' enctype='multipart/form-data' action='updateproduct.php'>";
          echo "<input type='hidden' name='uid' value='$eid'>";
        echo "<div class='product-part1'>";
          echo "<div class='image-file'>";
            echo "<label>Product Images</label>";
            echo "<p>Upload Image</p>";
            echo "<input type='hidden' name='previous' value='$eimage' />";
            echo "<input type='file' class='inputbox' name='productimage' placeholder='UploadImage' value='$eimage' />";
          echo "</div>";
          echo "<div class='info1'>";
            echo "<h3>Product Information</h3>";
            echo "<p>Please Provide detailed Information</p>";
          echo "</div>";

          echo "<div class='info2'>";
            echo "<label>Product Name</label>";
            echo "<input type='text' class='inputbox' name='productname' placeholder='Product Name'  value='$ename' />";
          echo "</div>";

          echo "<div class='info2'>";
            echo "<label>Product Category</label>";
            echo "<input type='text' class='inputbox' name='productcategory' placeholder='Product Category' value='$ecategory' />";
            
          echo "</div>";

          echo "<div class='info2'>";
            echo "<label>Description</label>";
            echo "<textarea name='description' class='inputbox' cols='30' rows='5' placeholder='Write description about products...' >$edescription
            </textarea> ";
          echo "</div>";

          echo "<div class='info2'>";
            echo "<label>Shop Name</label>";
            echo "<input
              type='text'
              class='inputbox'
              name='shopname'
              placeholder='Shop Name'
              value='$eshop'
            />";
          echo "</div>";
        echo "</div>";
        
        echo "
        
        <div class='product-part2'>
          <div class='part2-info'>
            <h3>Pricing</h3>
            <p>Please provide detailed information</p>
          </div>

          <div class='info2'>
            <label>Base Price</label>
            <input
              type='text'
              class='inputbox'
              name='productprice'
              placeholder='Base Price'
              value='$eprice'
            />
          </div>

          <div class='info2'>
            <label>Offer Type</label>
            <select class='inputbox selectbox' name='offer'>
              <option value='$eoffer'>Choose Offer Type</option>
              <option value='10'>Offer 1</option>
              <option value='20'>Offer 2</option>
              <option value='30'>Offer 3</option>
            </select>
          </div>
          <div class='info2'>
            <label>Quantity</label>
            <select class='inputbox selectbox' name='quantity'>
              <option value='$equantity'>Please Select Quantity</option>
              <option value='10'>10</option>
              <option value='20'>20</option>
              <option value='30'>30</option>
            </select>
          </div>
          <div class='info2'>
            <label>Stock</label>
            <input
              type='text'
              class='inputbox'
              name='productstock'
              placeholder='Product Stock'
              value='$estock'
            />
          </div>
        </div>

        <div class='add-product'>
          <input
            type='submit'
            name='updateProduct'
            value='Update Product +'
            class='addbtn'
          />
         
        </div>
      </form>
    </div>";

    ?>

  </body>
</html>
