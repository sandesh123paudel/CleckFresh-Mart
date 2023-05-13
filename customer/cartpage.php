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

  <style>
    .qty #quantity {
      border: none;
      outline: none;
      width: 30px;
      font-weight: 600;
      background: transparent;

    }
  </style>
  <script src="addremove.js"></script>

  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
      $('.cart-item-quantity').on("keyup", function() {
        const itemId = $(this).data('item-id');
        const newQuantity = $(this).val();

      });
    });
  </script> -->
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
          } else if (isset($_SESSION['userID'])) {
            $stmt = "SELECT * FROM CART WHERE USER_ID = :id";
            $stid = oci_parse($connection, $stmt);
            oci_bind_by_name($stid, ":id", $_SESSION['userID']);
            oci_execute($stid);
            $row = oci_fetch_array($stid, OCI_ASSOC);
            $_SESSION['cart_id'] = $row['CART_ID'];
            // echo $_SESSION['cart_id'];

            $sql = "SELECT COUNT(*) AS NUM_OF_ROWS FROM CART_PRODUCT WHERE CART_ID = :cart_id";
            $stmts = oci_parse($connection, $sql);
            oci_bind_by_name($stmts, ":cart_id", $_SESSION['cart_id']);

            oci_define_by_name($stmts, "NUM_OF_ROWS", $cart_num);
            oci_execute($stmts);
            oci_fetch($stmts);
            echo $cart_num;
            $_SESSION['cart_num'] = $cart_num;
          } else {
            echo "0";
          }
          ?>
          items in your cart</p>
      </div>

      <?php

      $productprice = 0;
      $totalprice = 0;
      // If user is not login 
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
            <label>CleckFreshMart </label>
          </div>
          <div class='price'>&#163; " . $row['PRODUCT_PRICE'] . "</div>

          <div class='qty'>
          <h3> 
            <input type='text' min='1' max='20' value='" . $quantity . "' id='quantity' data-item-id='" . $row['PRODUCT_ID'] . "' class='cart-item-quantity' disabled>
          </h3>
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


      if (isset($_SESSION['userID'])) {
        $sql = "SELECT * FROM CART_PRODUCT WHERE CART_ID = :cart_id";
        $stmts = oci_parse($connection, $sql);
        oci_bind_by_name($stmts, ":cart_id", $_SESSION['cart_id']);
        oci_execute($stmts);
        while ($row = oci_fetch_array($stmts, OCI_ASSOC)) {
          $pid = $row['PRODUCT_ID'];
          $quantity = $row['QUANTITY'];
          // query for product table 
          $sqlpr = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = :pid";
          $stmt = oci_parse($connection, $sqlpr);
          oci_bind_by_name($stmt, ":pid", $pid);
          oci_execute($stmt);
          while ($data = oci_fetch_array($stmt, OCI_ASSOC)) {
            $productprice =  $quantity * $data['PRODUCT_PRICE'];
            $totalprice += $quantity * $data['PRODUCT_PRICE'];
            $productname = $data['PRODUCT_NAME'];

            echo "
        <div class='item-container'>
          <div class='image'>";
            echo "<img src=\"../db/uploads/products/" . $data['PRODUCT_IMAGE'] . "\" alt='$productname' /> ";

            echo " </div>
          <div class='item-info'>
            <h3>" . $productname . "</h3>
            <label>CleckFreshMart</label>
          </div>
          <div class='price'>&#163; " . $data['PRODUCT_PRICE'] . "</div>

          <div class='qty'>
          <h3>
            <input type='hidden' value='" . $data['PRODUCT_PRICE'] . "' id='product_id'>
            <input type='text' min='1' max='20' value='" . $quantity . "' id='quantity' disabled>
          </h3>
            
          </div>
          <div class='price'>&#163; $productprice</div>


          <div class='remove'>
            <span class='material-symbols-outlined' onclick='removecartdb(" . $data['PRODUCT_ID'] . ")'> delete </span>
          </div>
        </div>

        ";
          }
        }
      }

      ?>
      <!-- <div class='qty-icon'>
              <span class='material-symbols-outlined' onclick='addedquantity()'> arrow_drop_up </span>
                
              <span class='material-symbols-outlined' onclick='removequantity()'> arrow_drop_down </span>        
            </div> -->
      <div class="line"></div>

      <div class="total">
        <h3 id='totalitems'>Total Item (
          <?php
          if (isset($_SESSION['cart'])) {
            echo count($_SESSION['cart']);
          } else if (isset($_SESSION['userID'])) {
            echo $cart_num;
          } else {
            echo "0";
          }
          ?> Items)</h3>
        <h3 id='totalprice'>&#163; <?php echo $totalprice; ?></h3>
      </div>

      <div class="process">
        <h4>Process Payment</h4>
        <?php
        if (isset($_SESSION['userID'])) {
          echo "<button onclick='checkout()'>Process to Checkout</button>";
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
    function checkout() {
      document.location.href = 'checkoutpage.php';
    }

    function cartlogin() {
      document.location.href = '../login.php';
    }

    function removequantity() {
      const quantity = document.getElementById('quantity').value;
      if (quantity > 1) {
        const subtract = parseInt(quantity) - 1;
        document.getElementById('quantity').value = subtract;
      }
    }

    function addedquantity() {
      const quantity = document.getElementById('quantity').value;
      if (quantity < 20) {
        const addition = parseInt(quantity) + 1;
        document.getElementById('quantity').value = addition;
      }

    }
  </script>
</body>

</html>