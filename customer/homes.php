<div class="home-container">

  <div class="header-title">
    <h3>Trending Products</h3>
    <a href="products.php?cat_name=trending"><span>See all >></span></a>
  </div>

  <div class="trending-container">
    <!-- single container -->
      <?php
        $sql="SELECT * FROM PRODUCT WHERE ROWNUM <= 8";
        $stmt = oci_parse($connection,$sql);
        oci_execute($stmt);

        while($row = oci_fetch_array($stmt,OCI_ASSOC)){
          $product_name=$row['PRODUCT_NAME'];
                $product_id = $row['PRODUCT_ID'];
                $product_category = $row['PRODUCT_TYPE'];
                $product_quantity = $row['QUANTITY'];
                $product_image = $row['PRODUCT_IMAGE'];
                $product_price = $row['PRODUCT_PRICE'];              
       
        echo "<div class='single-container'>";
          echo "<div class='image' onclick='viewproduct($product_id)'>";
          echo "<img src=\"../db/uploads/products/".$product_image."\" alt='$product_name' /> ";
          echo "</div>";
          echo "<h5 class='title'>$product_name</h5>";
          echo "<span class='size'>$product_quantity gm</span>";
          echo "<p class='price'>&pound; $product_price</p>";
          echo "<a href=''><div class='btn'>Add +</div></a>";
          echo "</div>";
            }
        ?>

  </div>

  <!-- shops -->
  <div class="shop-title">
    <h3>Our Shops</h3>
  </div>

  <div class="shop-container">
    <?php
      $sql = "SELECT * FROM SHOP ";
      $stmt = oci_parse($connection,$sql);
      oci_execute($stmt);
      
      while($row = oci_fetch_array($stmt,OCI_ASSOC)){
        $shop_id = $row['SHOP_ID'];
        $shop_image = $row['SHOP_IMAGE'];
        $shop_logo = $row['SHOP_LOGO'];
        $shop_name = $row['SHOP_NAME'];
        $shop_desc = $row['SHOP_DESC'];

        echo "<a href='products.php?s_name=$shop_name&s_id=$shop_id' class='single'>";
        echo "<div>";
            echo "<div class='img'>";
              echo "<img src=\"../db/uploads/shops/".$shop_image."\" alt='$shop_name' /> ";
            echo "</div>";
            echo "<div class='logo'>";
              echo "<img src=\"../db/uploads/shops/".$shop_logo."\" class='logo-img' alt='$shop_name' /> ";
            echo "</div>";
            echo "<div class='summary'>";
                echo "<h2>".$shop_name."</h2>";
                echo "<p>$shop_desc</p>";
            echo "</div>";
        echo "</div>";
        echo "</a>";
      }
    ?>
  </div>

  <!-- Offer products -->
  <div class="header-title">
    <h3>Offer Products</h3>
    <a href="products.php?cat_name=offer"><span>See all >></span></a>
  </div>

  <div class="offer-container">
    
    <div class="single">
      <div class="img">
        <img src="../assets/blac.png" alt="" />
        <div class="offer">Offer</div>
      </div>
      <div class="content">
        <h5>Fresh Blackberries</h5>
        <span class="piece">24 PieceS</span>

        <div class="price">
          <span class="cut">$50.00</span>
          <span class="main">$20.00</span>
        </div>
        <a href=""><div class="btn">Add +</div></a>
      </div>
    </div>

    <div class="single">
      <div class="img">
        <img src="../assets/blac.png" alt="" />
        <div class="offer">Offer</div>
      </div>
      <div class="content">
        <h5>Fresh Blackberries</h5>
        <span class="piece">24 PieceS</span>

        <div class="price">
          <span class="cut">$50.00</span>
          <span class="main">$20.00</span>
        </div>
        <a href=""><div class="btn">Add +</div></a>
      </div>
    </div>

    <div class="single">
      <div class="img">
        <img src="../assets/blac.png" alt="" />
        <div class="offer">Offer</div>
      </div>
      <div class="content">
        <h5>Fresh Blackberries</h5>
        <span class="piece">24 PieceS</span>

        <div class="price">
          <span class="cut">&pound; 50.00</span>
          <span class="main">&pound; 20.00</span>
        </div>
        <a href=""><div class="btn">Add +</div></a>
      </div>
    </div>

  </div>

  <!-- other products -->

  <div class="header-title">
    <h3>Other Products</h3>
    <a href="products.php?cat_name=ALL"><span>See all >></span></a>
  </div>

  <div class="other-main">

      <div class="product-lists">

        <?php
            $sql='SELECT * FROM PRODUCT';
            $stid = oci_parse($connection,$sql);
            oci_execute($stid);

            while($row = oci_fetch_array($stid,OCI_ASSOC)){
                $product_name=$row['PRODUCT_NAME'];
                $product_id = $row['PRODUCT_ID'];
                $category_id = $row['CATEGORY_ID'];
                $product_category = $row['PRODUCT_TYPE'];
                $product_quantity = $row['QUANTITY'];
                $product_image = $row['PRODUCT_IMAGE'];
                $product_price = $row['PRODUCT_PRICE'];
                $product_stock = $row['STOCK_NUMBER'];

                if(!empty($row['OFFER_ID'])){
                    $product_offer = $row['OFFER_ID'];
                }
                else{
                    $product_offer='';
                }

                
                echo "<div class='single' >";
                    echo "<div class='img' onclick='viewproduct($product_id)'>";
                        echo "<img src=\"../db/uploads/products/".$product_image."\" alt='$product_name' /> ";
                            if(!empty($product_offer)){
                                echo "<div class='offer'>Offer</div>";
                            }
                            else{
                                echo "";
                            }
                            if((int)$product_stock <= 0 ){
                                echo "<div class='outofstock'>out of stock</div>";
                            }
                            else{
                                echo "";
                            }
                    echo "</div>";
                    echo "<div class='content'>";
                        echo "<h5>".$product_name."</h5>";
                        echo "<span class='piece'>".$product_quantity." gm</span>";
                        echo "<div class='price'>";
                            if($product_offer){
                                echo "<span class='cut'>$50.00</span>";
                            }
                            else{
                                echo "<span class='main'>&pound; ".$product_price."</span>";
                            }
                        echo "</div>";

                        if((int)$product_stock <= 0 ){
                          echo "<div class='btn' id='outstock' >Add +</div>";
                        }
                        else{
                          echo "<div class='btn'>Add +</div>";
                          // echo "<a href='products.php?cat_id=$category_id'><div class='btn' onclick='addtocart($product_id)'>Add +</div></a>";
                        }
                        echo "</div>";
                echo "</div>";
            }

        ?>
      </div>

    <div class="center show-more">
      <a href="">Show More...</a> 
    </div>
  </div>
</div>


<script>
        function viewproduct(p_id){
            window.location.href="productview.php?p_id="+p_id;
        }
  </script>