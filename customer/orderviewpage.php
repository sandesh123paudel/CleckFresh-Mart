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
            <h4>Order Id : 3333</h4>
            <h4>Order Date : March 14, 2023</h4>
          </div>
          <button>Invoice</button>
        </div>

        <div class="checkout-part2">
          <table>
            <!-- table heading -->
            <th>
              <tr class="head">
                <td>Product Image</td>
                <td>Product Name</td>
                <td>Quantity</td>
                <td>&#163; Price</td>
              </tr>
            </th>

            <tr class="item">
              <td><img src="../logo/apple2.webp" alt="image" /></td>
              <td>Apple</td>
              <td>1kg</td>
              <td>&#163; 100</td>
            </tr>
          </table>
          <div class="order-summary">
            <h3>Order Summary</h3>
            <div class="total-items">
              <h4>Total Items</h4>
              <h4>3(Items)</h4>
            </div>
            <div class="total-items">
              <h4>Total Payment</h4>
              <h4>&#163; 100</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
