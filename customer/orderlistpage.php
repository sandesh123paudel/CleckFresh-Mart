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
          <th>Total Items</th>
          <th>Total Amount</th>
          <th>Payment</th>
          <th>Action</th>
        </tr>

        <?php
        // sql query to extract all the order details
        unset($_SESSION['order_id']);
        unset($_SESSION['order_date']);

        $sql = "SELECT cs.*, ot.*
        FROM COLLECTION_SLOT cs
        JOIN ORDER_I ot ON cs.COLLECTION_SLOT_ID = ot.COLLECTION_SLOT_ID
        JOIN CART ct ON ot.CART_ID = ct.CART_ID
        WHERE ct.USER_ID = :user_id";

        $stid = oci_parse($connection, $sql);
        oci_bind_by_name($stid, ":user_id", $_SESSION['userID']);
        oci_execute($stid);
        while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
          $order_id = $row['ORDER_ID'];
          $order_date = $row['ORDER_DATE'];

          echo "
            <tr>
              <td>" . $row['ORDER_ID'] . "</td>
              <td>" . $row['ORDER_DATE'] . "</td>
              <td>" . $row['SLOT_TIMING'] . " (" . $row['COLLECTION_DAY'] . ") </td>
              <td>" . $row['NO_OF_ITEM'] . "</td>
              <td>&#163; " . $row['TOTAL_PRICE'] . "</td>

              <td>" . $row['STATUS'] . "</td>
              <td class='links-btn'><a href='invoice.php?cat=history&order_id=$order_id&order_date=$order_date' class='btn btn-warning'>Payment</a></td>
            </tr>
          ";
        }
        ?>



      </table>
    </div>

  </div>



</body>

</html>