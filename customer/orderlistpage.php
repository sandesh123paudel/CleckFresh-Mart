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
    <link rel="stylesheet" href="css/order.css" />
  </head>
  <body>
    <div class="order-container">
      <h3>Order Information</h3>

      <table>
        <!-- table heading -->
        <th>
          <tr class="head">
            <td>Order Id</td>
            <td>Date</td>
            <td>Collection Slot</td>
            <td>Order Total</td>
            <td>Status</td>
            <td>Action</td>
          </tr>
        </th>

        <tr class="item">
          <td>3333</td>
          <td>20/10/2023</td>
          <td>Wed,1pm</td>
          <td>&#163; 120.00</td>
          <td>complete</td>
          <td class="links-btn"><a href="#">View</a> <a href="#">Reorder</a></td>
        </tr>
      </table>
    </div>
  </body>
</html>
