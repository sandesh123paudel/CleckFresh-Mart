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
    <link rel="stylesheet" href="css/orders.css" />
  </head>
  <body>

    <div class="main-container">
      <h3>Order Information</h3>
      <div class="order-container">
     
      <table>
        <!-- table heading -->
          <tr>
            <th>Order Id</th>
            <th>Date</th>
            <th>Collection Slot</th>
            <th>Order Total</th>
            <th>Status</th>
            <th>Action</th>
          </tr>

        <tr>
          <td>3333</td>
          <td>20/10/2023</td>
          <td>Wed,1pm</td>
          <td>&#163; 120.00</td>
          <td>complete</td>
          <td class="links-btn"><a href="#">View</a> <a href="#">Reorder</a></td>
        </tr>
      </table>
    </div>
  
    </div>
    
  </body>
</html>
