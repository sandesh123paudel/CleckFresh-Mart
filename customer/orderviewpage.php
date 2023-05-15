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
          <h6>Order Id : <?php echo $_SESSION['order_id']; ?></h6>
          <h6>Order Date : <?php echo  $_SESSION['order_data']; ?></h6>
        </div>
        <button>Invoice</button>
      </div>

      <div class="order-container">
        <table>
          <!-- table heading -->
          <tr>
            <th>Product Image</th>
            <th>Product Name</th>
            <th>Quantity</th>
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

          oci_bind_by_name($stid, ":order_id", $_SESSION['order_id']);
          oci_execute($stid);

          while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
            $product_image = $row['PRODUCT_IMAGE'];

            echo "
              <tr>";
              echo "<td class='img'>";
              echo "<img src=\"../db/uploads/products/" . $row['PRODUCT_IMAGE'] . "\" alt='' /> </td>";
              echo "<td>Apple</td>
                <td>1kg</td>
                <td>&#163; 100</td>
              </tr>
              ";
          }

          ?>


        </table>

        <div class="order-summary">
          <h3>Order Summary</h3>
          <div class="total-items">
            <h6>Total Items</h6>
            <h6>3(Items)</h6>
          </div>

          <div class="total-items">
            <h6>Total Payment</h6>
            <h6>&#163; 100</h6>
          </div>
        </div>

      </div>
    </div>
  </div>
</body>

</html>