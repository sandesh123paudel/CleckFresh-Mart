<?php
session_start();
include("../db/connection.php");

if (empty($_SESSION['token'])) {
    echo "<script>
    alert('SESSION is EXPIRED Please Login!!!');
    document.location.href='../login.php';
    </script>";
  }

unset($_SESSION['order_id']);

$sql = "SELECT * FROM INVOICE WHERE ORDER_ID = :order_id AND INVOICE_DATE = :odate AND TOTAL_AMOUNT = :invoice_price";
$stmt = oci_parse($connection, $sql);
oci_bind_by_name($stmt, ":order_id", $_GET['order_id']);
oci_bind_by_name($stmt, ":odate", $_GET['order_date']);
oci_bind_by_name($stmt,":invoice_price",$_GET['price']);
oci_execute($stmt);

while ($row = oci_fetch_array($stmt, OCI_ASSOC)) {
    $invoice_id = $row['INVOICE_ID'];
    $order_id = $row['ORDER_ID'];
    $issued_date = $row['INVOICE_DATE'];
    $payment_from = $row['PAYMENT_FROM'];
    $payment_to = $row['PAYMENT_TO'];
    $totalprice = $row['TOTAL_AMOUNT'];
}

$_SESSION['order_id'] = $order_id;

$usersql = "SELECT * FROM USER_I WHERE USER_ID = :user_id";
$userstmt = oci_parse($connection, $usersql);
oci_bind_by_name($userstmt, ":user_id", $_SESSION["userID"]);
oci_execute($userstmt);
while ($data = oci_fetch_array($userstmt, OCI_ASSOC)) {
    $username = $data['FIRST_NAME'] . " " . $data['LAST_NAME'];
    $email = $data['EMAIL'];
    $contact = $data['CONTACT'];
}

include('../payment/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="icon" href="../assets/logo.png" type="image/x-icon">
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
            $stmts = oci_parse($connection, $sql);
            oci_bind_by_name($stmts, ":order_id", $_GET['order_id']);
            oci_execute($stmts);
            while ($row = oci_fetch_array($stmts, OCI_ASSOC)) {
                $pid = $row['PRODUCT_ID'];
                $quantity = $row['ORDER_QUANTITY'];
                // query for product table 
                $sqlpr = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = :pid";
                $stmt = oci_parse($connection, $sqlpr);
                oci_bind_by_name($stmt, ":pid", $pid);
                oci_execute($stmt);
                while ($data = oci_fetch_array($stmt, OCI_ASSOC)) {
                    $count += 1;
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
                            <td>" . $count . "</td>
                            <td>" . ucfirst($productname) . "</td>
                            <td>" . $quantity . "</td>
                            <td>&#163;" . $discount_price . "</td>
                            <td>&#163; " . $productprice . "</td>
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
                <td><b>Tax (15%)</b></td>
                <td><b>&#163;
                        <?php $taxamount = $totalprice * 0.15;
                        echo $taxamount;
                        ?>
                    </b></td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><b>Total Amount</b></td>
                <td><b>&#163;
                        <?php
                        $finalamount = $taxamount + $totalprice;
                        echo $finalamount;
                        ?>
                    </b></td>
            </tr>
        </table>

        <form action="<?php echo PAYPAL_URL; ?>" method='post'>
            <div class="place-btn">

                <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">

                <input type="hidden" name="amount" value="<?php echo $finalamount; ?>">

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