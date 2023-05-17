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
  <link rel="stylesheet" href="css/checkouts.css" />
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
            $productprice =  $row['ORDER_QUANTITY'] * $row['PRODUCT_PRICE'];
            $totalprice += $row['ORDER_QUANTITY'] * $row['PRODUCT_PRICE'];

            echo "
              <tr>";
            echo "<td class='img'>";
            echo "<img src=\"../db/uploads/products/" . $row['PRODUCT_IMAGE'] . "\" alt='' /> </td>";
            echo "<td>" . $row['PRODUCT_NAME'] . "</td>
                <td>" . $row['ORDER_QUANTITY'] . "</td>
                <td>&#163; " . $row['PRODUCT_PRICE'] . "</td>
                <td>&#163; " . $productprice . "</td>
              </tr>
              ";
          }

          ?>


        </table>

        <div class="order-summary">
          <h3>Order Summary</h3>

          <div class="total-items">
            <h6>Total Payment</h6>
            <h6><b>&#163; <?php echo $totalprice; ?></b></h6>
          </div>
        </div>

      </div>
    </div>
  </div>
</body>

</html>