<?php
  session_start();
  include("../db/connection.php");

  $sql = "SELECT * FROM INVOICE WHERE ORDER_ID = :order_id";
  $stmt = oci_parse($connection , $sql);
  oci_bind_by_name($stmt , ":order_id" , $_SESSION['order_id']);
  oci_execute($stmt);
  while($row = oci_fetch_array($stmt, OCI_ASSOC)){
    $invoice_id = $row['INVOICE_ID'];
    $order_id = $row['ORDER_ID'];
    $issued_date = $row['INVOICE_DATE'];
    $payment_from = $row['PAYMENT_FROM'];
    $payment_to = $row['PAYMENT_TO'];
    $totalprice = $row['TOTAL_AMOUNT'];
  }

  $usersql = "SELECT * FROM USER_I WHERE USER_ID = :user_id";
  $userstmt = oci_parse($connection , $usersql);
  oci_bind_by_name($userstmt , ":user_id", $_SESSION["userID"]);
  oci_execute($userstmt);
  while($row = oci_fetch_array($userstmt, OCI_ASSOC)){
    $username = $row['FIRST_NAME'] . " " . $row['LAST_NAME'];
    $email = $row['EMAIL'];
    $contact = $row['CONTACT'];
  }

  include('../payment/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/invoic.css">
</head>
<body>
    
    <div class="invoice-container">
        <div class="logo">
            <h3>INVOICE</h3>
            <img src="../assets/logo.png" alt="">
        </div>
        
        
        <div class="invoice-details">
            <div class="part1">
                <h4>Bill To</h4>
                <p><?php echo $username; ?></p>
                <p><span>Email : </span><?php echo $email; ?></p>
                <p><span>Phone : </span><?php echo $contact; ?></p>
            </div>
    
            <div class="part2">
                <h4>Details</h4>
                <p>Invoice ID: <span>#INV-<?php echo $invoice_id; ?></span></p>
                <p>Order ID: <span><?php echo $order_id; ?></span></p>
                <p>Issued on <?php echo $issued_date; ?></p>
            </div>    
        </div>

        <h4>Payment Method</h4>
        <p><?php echo $payment_from; ?></p>

        <table>
                <th>
                    <tr id="heading">
                        <td>NO.</td>
                        <td>PRODUCT</td>
                        <td>QUANTITY</td>
                        <td>UNIT COST</td>
                        <td>TOTAL</td>
                    </tr>
                </th>
            
            <?php 
                $count = 0;
                $productprice = 0;
                $totalprice = 0;
                $sql = "SELECT * FROM ORDER_PRODUCT WHERE ORDER_ID = :order_id";
                $stmts = oci_parse($connection,$sql);
                oci_bind_by_name($stmts, ":order_id" , $_SESSION['order_id']);
                oci_execute($stmts);
                while($row = oci_fetch_array($stmts,OCI_ASSOC)){
                    $pid = $row['PRODUCT_ID'];
                    $quantity = $row['QUANTITY'];
                    // query for product table 
                    $sqlpr = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = :pid";
                    $stmt = oci_parse($connection,$sqlpr);
                    oci_bind_by_name($stmt, ":pid" , $pid);
                    oci_execute($stmt);
                    while($data = oci_fetch_array($stmt,OCI_ASSOC)){
                        $count += 1;
                        $productprice =  $quantity * $data['PRODUCT_PRICE'];
                        $totalprice += $quantity * $data['PRODUCT_PRICE'];
                        $productname = $data['PRODUCT_NAME'];
                        
                        echo "
                        <tr>
                            <td>".$count."</td>
                            <td>".$productname."</td>
                            <td>".$quantity."</td>
                            <td>&#163;".$data['PRODUCT_PRICE']."</td>
                            <td>&#163; ".$productprice."</td>
                        </tr>";
                    }
                }    

            ?>  

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><b>Item Subtotal</b></td>
                <td><b>&#163; <?php echo $totalprice; ?></b></td>
            </tr>
   
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><b>Total Amount</b></td>
                <td><b>&#163; <?php echo $totalprice ?> </b></td>
            </tr>            
        </table>
        
        <form action="<?php echo PAYPAL_URL; ?>" method='post'>
        <div class="place-btn">
            
            <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">

            <input type="hidden" name="amount" value="<?php echo $totalprice; ?>">
            
            <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">
           <!-- Specify a Buy Now button. -->
            <input type="hidden" name="cmd" value="_xclick">
            <!-- Specify URLs -->
            <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
            <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">

            <input type="submit" name="submit" value="Payment By Paypal" />
        </div>
        </form>
    </div>
</body>
</html>