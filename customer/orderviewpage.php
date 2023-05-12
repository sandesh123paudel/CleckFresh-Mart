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
            <h6>Order Id : 3333</h6>
            <h6>Order Date : March 14, 2023</h6>
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
            

            <tr>
              <td class='img'><img src="../assets/apple2.webp" alt="image" /></td>
              <td>Apple</td>
              <td>1kg</td>
              <td>&#163; 100</td>
            </tr>
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
