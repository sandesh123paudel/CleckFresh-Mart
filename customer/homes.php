<div class="home-container">

  <div class="header-title">
    <h3>Trending Products</h3>
    <a href="products.php?cat_name=trending"><span>See all >></span></a>
  </div>
  <!-- Trending container -->
  <div class="trending-container">

    <?php
    $sql = "SELECT * FROM PRODUCT WHERE ROWNUM <= 8";
    $stmt = oci_parse($connection, $sql);
    oci_execute($stmt);

    while ($row = oci_fetch_array($stmt, OCI_ASSOC)) {
      $product_name = $row['PRODUCT_NAME'];
      $product_id = $row['PRODUCT_ID'];
      $product_category = $row['PRODUCT_TYPE'];
      $product_quantity = $row['QUANTITY'];
      $product_image = $row['PRODUCT_IMAGE'];
      $product_price = $row['PRODUCT_PRICE'];

      echo "<div class='single-container'>";
      echo "<div class='image' onclick='viewproduct($product_id)'>";
      echo "<img src=\"../db/uploads/products/" . $product_image . "\" alt='$product_name' /> ";
      echo "</div>";
      echo "<h5 class='title'>$product_name</h5>";
      echo "<span class='size'>$product_quantity gm</span>";
      echo "<p class='price'>&pound; $product_price</p>";
      // echo "<a href=''><div class='btn'>Add +</div></a>";
      echo "<input type='hidden' data-quantity='1' >";

      if (isset($_SESSION['userID'])) {
        echo "<button class='btn' id='add' onclick='addtocart($product_id,1)'>Add +</button>";
      } else {
        echo "<button class='btn' id='addcart' onclick='addcart($product_id,1)'>Add +</button>";
      }
      echo "</div>";
    }
    ?>
    <!-- fetching data using api -->

    <?php
    // $rest_api_url = 'http://localhost/learning/karan/api/api_fetch_all.php';
    // // $rest_api_url = 'http://localhost/learning/karan/api/api_fetch_single.php';

    // // Reads the JSON file.
    // $json_data = file_get_contents($rest_api_url);

    // // Decodes the JSON data into a PHP array.
    // $response_data = json_decode($json_data);

    // // All the users data exists in 'data' object
    // $products = $response_data;

    // // It cuts the long data into small & select only the first 5 records.
    // $products=array_slice($products,0,7);

    // foreach ($products as $product) {
    //   echo "<div class='single-container'>";
    //   echo "<div class='image' onclick='viewproduct($product->PRODUCT_ID)'>";
    //   echo "<img src=\"../db/uploads/products/" . $product->PRODUCT_IMAGE . "\" alt='$product->PRODUCT_NAME' /> ";
    //   echo "</div>";
    //   echo "<h5 class='title'>$product->PRODUCT_NAME</h5>";
    //   echo "<span class='size'>$product->QUANTITY gm</span>";
    //   echo "<p class='price'>&pound; $product->PRODUCT_PRICE</p>";
    //   // echo "<a href=''><div class='btn'>Add +</div></a>";
    //   echo "<input type='hidden' data-quantity='1' >";

    //   if (isset($_SESSION['userID'])) {
    //     echo "<button class='btn' id='add' onclick='addtocart($product->PRODUCT_ID,1)'>Add +</button>";
    //   } else {
    //     echo "<button class='btn' id='addcart' onclick='addcart($product->PRODUCT_ID,1)'>Add +</button>";
    //   }
    //   echo "</div>";
    // }
    ?>



  </div>

  <!-- shops -->
  <div class="shop-title">
    <h3>Our Shops</h3>
  </div>

  <div class="shop-container">
    <?php
    $sql = "SELECT * FROM SHOP WHERE ROWNUM <= 7 ";
    $stmt = oci_parse($connection, $sql);
    oci_execute($stmt);

    while ($row = oci_fetch_array($stmt, OCI_ASSOC)) {
      $shop_id = $row['SHOP_ID'];
      $shop_image = $row['SHOP_IMAGE'];
      $shop_logo = $row['SHOP_LOGO'];
      $shop_name = $row['SHOP_NAME'];
      $shop_desc = $row['SHOP_DESC'];

      echo "<a href='products.php?s_name=$shop_name&s_id=$shop_id' class='single'>";
      echo "<div>";
      echo "<div class='img'>";
      echo "<img src=\"../db/uploads/shops/" . $shop_image . "\" alt='$shop_name' /> ";
      echo "</div>";
      echo "<div class='logo'>";
      echo "<img src=\"../db/uploads/shops/" . $shop_logo . "\" class='logo-img' alt='$shop_name' /> ";
      echo "</div>";
      echo "<div class='summary'>";
      echo "<h2>" . $shop_name . "</h2>";
      echo "<p>$shop_desc</p>";
      echo "</div>";
      echo "</div>";
      echo "</a>";
    }

    // // fetching using shops
    // $rest_api_url = 'http://localhost/learning/karan/api/api_fetch_shop.php';
    // // $rest_api_url = 'http://localhost/learning/karan/api/api_fetch_single.php';

    // // Reads the JSON file.
    // $json_data = file_get_contents($rest_api_url);

    // // Decodes the JSON data into a PHP array.
    // $response_data = json_decode($json_data);

    // // All the users data exists in 'data' object
    // $shops = $response_data;
    // $shops=array_slice($shops,0,7);
    // foreach($shops as $shop){
    //   echo "<a href='products.php?s_name=$shop->SHOP_NAME&s_id=$shop->SHOP_ID' class='single'>";
    //     echo "<div>";
    //     echo "<div class='img'>";
    //     echo "<img src=\"../db/uploads/shops/" . $shop->SHOP_IMAGE . "\" alt='$shop->SHOP_NAME' /> ";
    //     echo "</div>";
    //     echo "<div class='logo'>";
    //     echo "<img src=\"../db/uploads/shops/" . $shop->SHOP_LOGO . "\" class='logo-img' alt='$shop->SHOP_LOGO' /> ";
    //     echo "</div>";
    //     echo "<div class='summary'>";
    //     echo "<h2>" . $shop->SHOP_NAME . "</h2>";
    //     echo "<p>$shop->SHOP_DESC</p>";
    //     echo "</div>";
    //     echo "</div>";
    //     echo "</a>";
    // }

    ?>
  </div>

  <!-- Offer products -->
  <div class="header-title">
    <h3>Offer Products</h3>
    <a href="products.php?offer_name=offer&cat_name=offer"><span>See all >></span></a>
  </div>

  <div class="offer-container">
    <?php
    $offerSql = "SELECT * FROM OFFER";
    $stmt = oci_parse($connection, $offerSql);
    oci_execute($stmt);
    while ($row = oci_fetch_array($stmt, OCI_ASSOC)) {
      $offer_id = $row['OFFER_ID'];
      $sql = 'SELECT * FROM PRODUCT WHERE OFFER_ID= :off_id AND ROWNUM <= 7';
      $stid = oci_parse($connection, $sql);
      oci_bind_by_name($stid, ':off_id', $offer_id);
      oci_execute($stid);

      while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
        $product_name = $row['PRODUCT_NAME'];
        $product_id = $row['PRODUCT_ID'];
        $product_image = $row['PRODUCT_IMAGE'];
        $product_price = $row['PRODUCT_PRICE'];
        $product_offer = $row['OFFER_ID'];
        $product_quantity = $row['QUANTITY'];

        echo "<div class='single'>";
        echo "<div class='img' onclick='viewproduct($product_id)'>";
        echo "<img src=\"../db/uploads/products/" . $product_image . "\" alt='$product_name' /> ";
        echo "<div class='offer'>Offer</div>";
        echo "</div>";
        echo "<div class='content'>";
        echo "<h5>$product_name</h5>";
        echo "<span class='piece'> $product_quantity gm</span>";

        echo "<div class='price'>";

        $sqlp = "SELECT OFFER_PERCENTAGE FROM OFFER WHERE OFFER_ID = :offer_id";
        $stmts = oci_parse($connection, $sqlp);
        oci_bind_by_name($stmts, ":offer_id", $product_offer);
        oci_execute($stmts);
        $dis = oci_fetch_array($stmts, OCI_ASSOC);

        $discount = (int)$dis['OFFER_PERCENTAGE'];
        $total_price = $product_price - $product_price * ($discount / 100);
        echo "<span class='cut'>&pound;" . $product_price . "</span>";
        echo "<span class='main'>&pound; " . $total_price . "</span>";

        echo "</div>";
        echo "<input type='hidden' data-quantity='1' >";

        // echo "<a href=''><div class='btn'>Add +</div></a>";
        if (isset($_SESSION['userID'])) {
          echo "<button class='btn' id='add' onclick='addtocart($product_id,1)'>Add +</button>";
        } else {
          echo "<button class='btn' id='addcart' onclick='addcart($product_id,1)'>Add +</button>";
        }

        echo "</div>";
        echo "</div>";
      }
    }
    ?>



  </div>

  <!-- other products -->

  <div class="header-title">
    <h3>Other Products</h3>
    <a href="products.php?cat_name=all"><span>See all >></span></a>
  </div>

  <div class="other-main">

    <div class="product-lists">

      <?php

      $sql = 'SELECT * FROM PRODUCT WHERE ROWNUM <= 25';
      $stid = oci_parse($connection, $sql);
      oci_execute($stid);

      while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
        $product_name = $row['PRODUCT_NAME'];
        $product_id = $row['PRODUCT_ID'];
        $category_id = $row['CATEGORY_ID'];
        $product_category = $row['PRODUCT_TYPE'];
        $product_quantity = $row['QUANTITY'];
        $product_image = $row['PRODUCT_IMAGE'];
        $product_price = $row['PRODUCT_PRICE'];
        $product_stock = $row['STOCK_NUMBER'];

        if (!empty($row['OFFER_ID'])) {
          $product_offer = $row['OFFER_ID'];
        } else {
          $product_offer = '';
        }


        echo "<div class='single' >";
        echo "<div class='img' onclick='viewproduct($product_id)'>";
        echo "<img src=\"../db/uploads/products/" . $product_image . "\" alt='$product_name' /> ";
        if (!empty($product_offer)) {
          echo "<div class='offer'>Offer</div>";
        } else {
          echo "";
        }
        if ((int)$product_stock <= 0) {
          echo "<div class='outofstock'>out of stock</div>";
        } else {
          echo "";
        }
        echo "</div>";
        echo "<div class='content'>";
        echo "<h5>" . $product_name . "</h5>";
        echo "<span class='piece'>" . $product_quantity . " gm</span>";
        echo "<div class='price'>";
        if ($product_offer) {
          $sql = "SELECT OFFER_PERCENTAGE FROM OFFER WHERE OFFER_ID = :offer_id";
          $stmt = oci_parse($connection, $sql);
          oci_bind_by_name($stmt, ":offer_id", $product_offer);
          oci_execute($stmt);
          $row = oci_fetch_array($stmt, OCI_ASSOC);
          $discount = (int)$row['OFFER_PERCENTAGE'];
          $total_price = $product_price - $product_price * ($discount / 100);
          echo "<span class='cut'>&pound;" . $product_price . "</span>";
          echo "<span class='main'>&pound; " . $total_price . "</span>";
        } else {
          echo "<span class='main'>&pound; " . $product_price . "</span>";
        }
        echo "</div>";
        echo "<input type='hidden' data-quantity='1' >";
        if ((int)$product_stock <= 0) {
          echo "<div class='btn' id='outstock' >Add +</div>";
        } else {
          // echo "<a href=''><div class='btn'>Add +</div></a>";
          if (isset($_SESSION['userID'])) {
            echo "<button class='btn' id='add' onclick='addtocart($product_id,1)' >Add +</button>";
          } else {
            echo "<button class='btn' id='addcart' onclick='addcart($product_id,1)'>Add +</button>";
          }
        }
        echo "</div>";
        echo "</div>";
      }

      ?>
    </div>

    <div class="center show-more">
      <a href="products.php?cat_name=all">Show More...</a>
    </div>
  </div>
</div>


<script src="addremove.js"></script>
<script>
  function viewproduct(p_id) {
    window.location.href = "productview.php?p_id=" + p_id;
  }
</script>