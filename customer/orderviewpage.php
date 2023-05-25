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
  <link rel="stylesheet" href="css/checkout.css" />
</head>

<body>
  <div class="checkout-container">
    <div class="checkout-part1">
      <h3>Order Lists</h3>
      <div class="order-slot">
        <div class="order-data">
          <h6>Order Id : <?php echo $_GET['order_id']; ?></h6>
          <h6>Order Date : <?php echo  $_GET['order_date']; ?></h6>
        </div>
      </div>

      <div class="order-container">
        <table>
          <!-- table heading -->
          <tr>
            <th>Product Image</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>&#163; Per Price</th>
            <th>&#163; Price</th>
          </tr>

          <?php

          $productprice = 0;
          $totalprice = 0;

          $sql = "SELECT pt.*, opt.*
            FROM PRODUCT pt
            JOIN ORDER_PRODUCT opt ON pt.PRODUCT_ID = opt.PRODUCT_ID
            WHERE opt.ORDER_ID = :order_id";
          $stid = oci_parse($connection, $sql);

          oci_bind_by_name($stid, ":order_id", $_GET['order_id']);
          oci_execute($stid);

          while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
            $product_image = $row['PRODUCT_IMAGE'];
            $product_price = $row['PRODUCT_PRICE'];
            $quantity =  $row['ORDER_QUANTITY'];
            $product_name = $row['PRODUCT_NAME'];

            if (!empty($row['OFFER_ID'])) {
              $offer_id = $row['OFFER_ID'];

              $sql = "SELECT OFFER_PERCENTAGE FROM OFFER WHERE OFFER_ID = :offer_id";
              $stmt = oci_parse($connection, $sql);
              oci_bind_by_name($stmt, ":offer_id", $offer_id);
              oci_execute($stmt);
              while ($data = oci_fetch_array($stmt, OCI_ASSOC)) {
                $discount = (int)$data['OFFER_PERCENTAGE'];
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
              <tr>";
            echo "<td class='img'>";
            echo "<img src=\"../db/uploads/products/" . $product_image . "\" alt='' /> </td>";
            echo "<td>" . ucfirst($product_name) . "</td>
                <td>" . $quantity . "</td>
                <td>&#163; " . $discount_price . "</td>
                <td>&#163; " . $productprice . "</td>
              </tr>
              ";
          }

          ?>


        </table>

        <div class="order-summary">
          <h3>Order Summary</h3>

          <div class="total-items">
            <h6>Sub Total</h6>
            <h6><b>&#163; <?php echo $totalprice; ?></b></h6>
          </div>

          <div class="total-items">
            <h6>Tax (15%)</h6>
            <h6><b>&#163; <?php $taxamount = $totalprice * 0.15;
                          echo $taxamount;
                          ?></b></h6>
          </div>

          <div class="total-items">
            <h6>Total Payment</h6>
            <h6><b>&#163; <?php
                          $finalamount = $taxamount + $totalprice;
                          echo $finalamount;
                          ?></b></h6>
          </div>
        </div>

      </div>
    </div>
  </div>
</body>

</html>