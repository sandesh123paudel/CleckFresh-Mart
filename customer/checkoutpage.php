<?php
session_start();
include('../db/connection.php');
$err = $errdate = '';

if (isset($_POST['placeorder'])) {
  if (empty($_POST['selectslot'])) {
    $err = "Choose the collection Slot";
  }
  if (empty($_POST['date'])) {
    $errdate = "Choose the date";
  } else {
    $selectedDate = strtotime($_POST['date']);

    date_default_timezone_set("Asia/Kathmandu");
    $currentDate = strtotime(date('m/d/y'));
    $twentyFourHoursLater = strtotime('+24 hours', $currentDate);

    if ($selectedDate >= $twentyFourHoursLater) {
      unset($_SESSION['collectionslot_id']);
      unset($_SESSION['order_date']);
      unset($_SESSION['collection_date']);
      unset($_SESSION['order_id']);
      unset($_SESSION['collect_date']);


      $_SESSION['collect_date'] = date('m/d/Y', $selectedDate);

      $collectionslot_id = $_POST['selectslot'];
      $_SESSION['collectionslot_id'] = $collectionslot_id;

      $colsql = "SELECT * FROM COLLECTION_SLOT WHERE COLLECTION_SLOT_ID = :collectionslot_id";
      $colstmt = oci_parse($connection, $colsql);
      oci_bind_by_name($colstmt, ":collectionslot_id", $collectionslot_id);
      oci_execute($colstmt);
      $data = oci_fetch_assoc($colstmt);
      $weekday = $data['COLLECTION_DAY'];

      $dateFormatted = date('mm/dd/YYYY', $currentDate);

      $_SESSION['collection_date'] = "\nDate:" . $_SESSION['collect_date'] . " \nDay: " .  $weekday . " \nTime: " . $data['SLOT_TIMING'];

      $date = $_POST['date'];
      $dayOfWeek = date('l', strtotime($date));

      if ($dayOfWeek === $weekday || $dayOfWeek === $weekday || $dayOfWeek === $weekday) {

        $status = 'pending';

        $sql = "INSERT INTO ORDER_I (CART_ID,COLLECTION_SLOT_ID,ORDER_STATUS,NO_OF_ITEM,TOTAL_PRICE,COLLECTION_DATE) VALUES(:cart_id,:slot_id,:statu,:item,:price,:collect_date)";
        $stids = oci_parse($connection, $sql);
        oci_bind_by_name($stids, ":cart_id", $_SESSION['cart_id']);
        oci_bind_by_name($stids, ":slot_id", $_SESSION['collectionslot_id']);
        // oci_bind_by_name($stids, ":order_date", $dateFormatted);
        oci_bind_by_name($stids, ":statu", $status);
        oci_bind_by_name($stids, ":item", $_SESSION['cart_num']);
        oci_bind_by_name($stids, ":price", $_SESSION['totalprice']);
        oci_bind_by_name($stids, ":collect_date", $_SESSION['collect_date']);

        if (oci_execute($stids)) {

          // extracting the number of slot for order
          $sqls = "SELECT * FROM COLLECTION_SLOT WHERE COLLECTION_SLOT_ID = :slot_id";
          $stid = oci_parse($connection, $sqls);
          oci_bind_by_name($stid, ":slot_id", $_SESSION['collectionslot_id']);
          oci_execute($stid);
          $data = oci_fetch_array($stid);
          $orderscount = $data['NUMBER_OF_ORDER'];
          $ordercount = (int)$orderscount - 1;

          // update the number of order in collectionslot 
          $stql = "UPDATE COLLECTION_SLOT SET NUMBER_OF_ORDER = :num_order WHERE COLLECTION_SLOT_ID = :slot_id";
          $stmt = oci_parse($connection, $stql);
          oci_bind_by_name($stmt, ":slot_id", $_SESSION['collectionslot_id']);
          oci_bind_by_name($stmt, ":num_order", $ordercount);
          oci_execute($stmt);

          header('location:insertorder.php');
        }
      } else {

        $errdate = "Please select a date on Wednesday, Thursday, or Friday.";
      }
    } else {
      $errdate = "Please select a date at least 24 hours in the future.";
    }
  }
}

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
      <h3>Collection Slot</h3>

      <form method='post' action=''>

        <div class="collection-slot">

          <label>Choose slot: </label>
          <select name="selectslot" id="selectbox">
            <option value="">Select Collection Slot</option>
            <?php
            // $status = 'active';
            $sql = "SELECT * FROM COLLECTION_SLOT WHERE NUMBER_OF_ORDER > 0";
            $stid = oci_parse($connection, $sql);
            // oci_bind_by_name($stid, ":status", $status);
            oci_execute($stid);
            while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
              echo "<option value=" . $row['COLLECTION_SLOT_ID'] . ">" . $row['SLOT_TIMING'] . " (" . $row['COLLECTION_DAY'] . ")</option>";
            }

            ?>

          </select>
        </div>
        <?php echo "<span class='error'>" . $err . "</span>"; ?>
        <div class="collection-slot">
          <label>Choose Date: </label>
          <input type="date" id="date" name="date" />
        </div>
        <?php echo "<span class='error'>" . $errdate . "</span>"; ?>
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
                   <tr>
                   <td class='img'>";
                echo "<img src=\"../db/uploads/products/" . $data['PRODUCT_IMAGE'] . "\" alt='$productname' /> ";
                echo "</td>
                   <td>" . ucfirst($data['PRODUCT_NAME']) . "</td>
                   <td>" . $quantity . "</td>
                   <td>&#163; " . $productprice . "</td>
                 </tr>
                   ";
              }
            }
            ?>

          </table>
        </div>
        <div class="order-summary">
          <h3>Order Summary</h3>

          <div class="total-items">
            <h6>Total Items</h6>
            <h6><b><?php echo $_SESSION['cart_num']; ?> </b>(Items)</h6>
          </div>

          <div class="total-items">
            <h6>Sub Total</h6>
            <h6><b>&#163; <?php echo $totalprice; ?> </b></h6>
          </div>

          <div class="total-items">
            <h6>Tax Amount(15%)</h6>
            <h6>
              <b>&#163;
                <?php
                $taxamount = $totalprice * 0.15;
                echo $taxamount;
                ?>
              </b>
            </h6>
          </div>

          <div class="total-items">
            <h6>Total Payment</h6>
            <h6>
              <b>&#163;
                <?php
                unset($_SESSION['totalprice']);
                $finalamount = $taxamount + $totalprice;
                $_SESSION['totalprice'] = $finalamount;
                echo $finalamount;
                ?>
              </b>
            </h6>
          </div>

        </div>
        <div class="place-btn">
          <input type="submit" name="placeorder" value="Place Order" />
        </div>

      </form>
    </div>
  </div>


</body>

</html>