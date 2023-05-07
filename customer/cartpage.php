<?php
include('../db/connection.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="css/carts.css" />
</head>

<body>

  <div class='nav-bar'>
    <?php
    require('navbar.php');
    ?>
  </div>

  <div class="cart-container">
    <div class="title">

      <span class="material-symbols-outlined">
        arrow_back_ios_new
      </span>

      <h3>Shopping Continue</h3>
    </div>
    <div class="line"></div>

    <div class="cart-items">
      <div class="cart-info">
        <h4>Shopping Cart</h4>
        <p>You have
          <?php
          if (isset($_SESSION['cart'])) {
            echo count($_SESSION['cart']);
          }
          else{
            echo "0";
          }
          ?>
          items in your cart</p>
      </div>

      <?php

      $productprice = 0;
      $totalprice = 0;
      if (isset($_SESSION['cart'])) {

        foreach ($_SESSION['cart'] as $key => $value) {
          $sql = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = :id";
          $stid = oci_parse($connection, $sql);
          oci_bind_by_name($stid, ":id", $value['product_id']);
          oci_execute($stid);
          $quantity = $value['product_quantity'];

          while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
            $productprice =  $quantity * $row['PRODUCT_PRICE'];
            $totalprice += $quantity * $row['PRODUCT_PRICE'];
            $productname = $row['PRODUCT_NAME'];
            echo "
        <div class='item-container'>
          <div class='image'>";
            echo "<img src=\"../db/uploads/products/" . $row['PRODUCT_IMAGE'] . "\" alt='$productname' /> ";

            echo " </div>
          <div class='item-info'>
            <h3>" . $productname . "</h3>
            <label>CleckFreshMart Chicken</label>
            <label>" . $productname . " " . (int)$row['QUANTITY'] * $quantity . "</label>
          </div>
          <div class='qty'>
            <h3 >1</h3>
            <!-- icon -->
            <div class='qty-icon'>
    
                <a href='#'>
                  <span class='material-symbols-outlined'> arrow_drop_up </span>
                </a>
           
                <a href='#'>
                  <span class='material-symbols-outlined'> arrow_drop_down </span>
             
                </a>
             
                
            </div>
          </div>
          <div class='price'>&#163; $productprice</div>

          <div class='remove'>
            <span class='material-symbols-outlined' onclick='removecart(" . $row['PRODUCT_ID'] . ")'> delete </span>
          </div>
        </div>

        ";
          }
        }
      }
      ?>
      <div class="line"></div>

      <div class="total">
        <h3 id='totalitems'>Total Item (
          <?php
          if (isset($_SESSION['cart'])) {
            echo count($_SESSION['cart']);
          }
          else{
            echo "0";
          }
          ?> Items)</h3>
        <h3 id='totalprice'>&#163; <?php echo $totalprice; ?></h3>
      </div>

      <div class="process">
        <h4>Process Payment</h4>
        <?php
        if (isset($_SESSION['userID'])) {
          echo "<button>Process to Checkout</button>";
        } else {
          echo "<button onclick='cartlogin()'>Process to Checkout</button>";
        }
        ?>

      </div>
    </div>
  </div>
  <?php
  require('footer.php');
  ?>

  <script>
    function cartlogin() {
      document.location.href = '../login.php';
    }

    function removecart(p_id) {
            var product_id = p_id;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    alert(this.responseText); // replace 'this.responseText' with the actual response text from the server
                }
            };
            xmlhttp.open("GET", "insertremove.php?action=removecart&&id=" + product_id, true);
            xmlhttp.send();
        }
  </script>
</body>

</html>