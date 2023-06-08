<?php
include('../db/connection.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CartList</title>
  <link rel="icon" href="../assets/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="css/cartpage.css" />

  <style>
    .prod-quantity {
      display: flex;
      column-gap: 10px;
      margin-top: 3rem;
    }

    .prod-quantity #quantity {
      width: 40px;
      background-color: transparent;
      outline: none;
      border: none;
      padding-left: 5px;
    }

    .prod-quantity button {
      width: 30px;
      height: 30px;
      border: 1px solid lightgray;
      border-radius: 50%;
    }
  </style>
  <script src="addremove.js"></script>
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
            unset($_SESSION['cart_num']);
            unset($_SESSION['cart_id']);

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
      if (isset($_GET['error'])) {
        echo "<p class='error'>" . $_GET['error'] . "</p>";
      }
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
            $product_id = $row['PRODUCT_ID'];
            $product_price = $row['PRODUCT_PRICE'];
            $productname = $row['PRODUCT_NAME'];
            $product_image = $row['PRODUCT_IMAGE'];
            $product_stock = $row['STOCK_NUMBER'];

            if (!empty($row['OFFER_ID'])) {
              $offer_id = $row['OFFER_ID'];

              $sql = "SELECT OFFER_PERCENTAGE FROM OFFER WHERE OFFER_ID = :offer_id";
              $stmt = oci_parse($connection, $sql);
              oci_bind_by_name($stmt, ":offer_id", $offer_id);
              oci_execute($stmt);
              while ($row = oci_fetch_array($stmt, OCI_ASSOC)) {
                $discount = (int)$row['OFFER_PERCENTAGE'];
                $discount_price = $product_price - $product_price * ($discount / 100);
                $productprice =  $quantity * $discount_price;
                $totalprice += $quantity * $discount_price;
              }
            } else {
              $discount_price = $product_price;
              $productprice =  $quantity * $discount_price;
              $totalprice += $quantity * $discount_price;
            }

            echo "
          <div class='item-container'>
            <div class='image'>";
            echo "<img src=\"../db/uploads/products/" . $product_image . "\" alt='$productname' /> ";

            echo " </div>
            <div class='item-info'>
              <h3>" . ucfirst($productname) . "</h3>
              <label>CleckFreshMart </label>
            </div>
            <div class='price'>&#163; " . $product_price . "</div>";

            echo "<div class='prod-quantity'>

                    <button onclick='remove_session($product_id,1)'>-</button>
                    <h3>
                        <input type='text' min='1' value='" . $quantity . "' max='" . $product_stock . "' id='quantity' disabled>
                    </h3>
                    <button onclick='add_session($product_id,1)'>+</button>
                
                  </div>";

            echo "<div class='price'>&#163; " . $productprice . "</div>

            <div class='remove'>
              <span class='material-symbols-outlined' onclick='removecart(" . $product_id . ")'> delete </span>
            </div>
          </div>

        ";
          }
        }
      }


      // with login
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
            $product_price = $data['PRODUCT_PRICE'];
            $productname = $data['PRODUCT_NAME'];
            $product_stock = $data['STOCK_NUMBER'];

            if (!empty($data['OFFER_ID'])) {
              $offer_id = $data['OFFER_ID'];

              $sql = "SELECT OFFER_PERCENTAGE FROM OFFER WHERE OFFER_ID = :offer_id";
              $stmt = oci_parse($connection, $sql);
              oci_bind_by_name($stmt, ":offer_id", $offer_id);
              oci_execute($stmt);
              while ($row = oci_fetch_array($stmt, OCI_ASSOC)) {
                $discount = (int)$row['OFFER_PERCENTAGE'];
                $discount_price = $product_price - $product_price * ($discount / 100);
                $productprice =  $quantity * $discount_price;
                $totalprice += $quantity * $discount_price;
              }
            } else {
              $discount_price = $product_price;
              $productprice =  $quantity * $discount_price;
              $totalprice += $quantity * $discount_price;
            }

            echo "
        <div class='item-container'>
          <div class='image'>";
            echo "<img src=\"../db/uploads/products/" . $data['PRODUCT_IMAGE'] . "\" alt='$productname' /> ";

            echo " </div>
          <div class='item-info'>
            <h3>" . ucfirst($productname) . "</h3>
            <label>CleckFreshMart</label>
          </div>
          <div class='price'>&#163; " . $discount_price . "</div>";
            echo "<div class='prod-quantity'>
                  <button onclick='removequantity($pid,1)'>-</button>
                  <h3>
                      <input type='text' min='1' value='" . $quantity . "' max='" . $product_stock . "' id='quantity' disabled>
                  </h3>
                  <button onclick='addedquantity($pid,1)'>+</button>
              </div>";

            echo " <div class='price'>&#163; $productprice</div>


          <div class='remove'>
            <span class='material-symbols-outlined' onclick='removecartdb(" . $data['PRODUCT_ID'] . ")'> delete </span>
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
          if ($cart_num == 0) {
            echo "<button onclick='checkouterror()'>Process to Checkout</button>";
          } else {
            echo "<button onclick='checkout()'>Process to Checkout</button>";
          }
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
    function checkouterror() {
      document.location.href = 'cartpage.php?error=Your cart is empty!';
    }

    function checkout() {
      document.location.href = 'checkoutpage.php';
    }

    function cartlogin() {
      document.location.href = '../login.php';
    }

    // with login
    function addedquantity(product_id, quantity) {
      addupdatetocart(product_id, quantity);
    }

    function removequantity(product_id, quantity) {
      removeupdatetocart(product_id, quantity);
    }

    // update quantity in cart
    function add_session(product_id, quantity) {
      addupdatecart(product_id, quantity);
    }

    function remove_session(product_id, quantity) {

      removeupdatecart(product_id, quantity);
    }
  </script>
</body>

</html>