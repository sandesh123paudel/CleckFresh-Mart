<?php
session_start();
include("../db/connection.php");

$sqls = "SELECT * FROM ORDER_I WHERE CART_ID = :cart_id AND COLLECTION_SLOT_ID = :slot_id";
$stmt = oci_parse($connection, $sqls);
oci_bind_by_name($stmt , ":cart_id" , $_SESSION['cart_id']);
oci_bind_by_name($stmt, ":slot_id" ,$_SESSION['collectionslot_id']);
oci_execute($stmt);
$data = oci_fetch_array($stmt);
 $order_id = $data['ORDER_ID'];
 
 $_SESSION['order_id'] = $order_id;

$sqlt = "SELECT * FROM CART_PRODUCT WHERE CART_ID = :cart_id";
$stms = oci_parse($connection,$sqlt);
oci_bind_by_name($stms , ":cart_id" , $_SESSION['cart_id']);
oci_execute($stms);

while($data = oci_fetch_array($stms, OCI_ASSOC)){
    $product_id = $data['PRODUCT_ID'];
    $quantity = $data['QUANTITY'];

    // echo "PRODUCT_ID". $product_id ."  \n";
    // echo "ORDER _ID ".$order_id . "\n";

    $sql = "INSERT INTO ORDER_PRODUCT(ORDER_ID,PRODUCT_ID,QUANTITY) VALUES (:order_id,:pid,:qty)";
    $stid = oci_parse($connection, $sql);
    oci_bind_by_name($stid, ":order_id", $order_id);
    oci_bind_by_name($stid, ":pid", $product_id);
    oci_bind_by_name($stid, ":qty", $quantity);
    oci_execute($stid);

    // update product stock

    $selsql = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = :pid";
    $stmt = oci_parse($connection , $selsql);
    oci_bind_by_name($stmt , ":pid" , $product_id);
    oci_execute($stmt);
    $data = oci_fetch_array($stmt);
    $stock = $data['STOCK_NUMBER'];
    $updatestock = (int)$stock - (int) $quantity;

    $updatesql = "UPDATE PRODUCT SET STOCK_NUMBER = :stock WHERE PRODUCT_ID = :pid";
    $updatestmt = oci_parse($connection,$updatesql);
    oci_bind_by_name($updatestmt , ":stock" , $updatestock);
    oci_bind_by_name($updatestmt , ":pid", $product_id);
    oci_execute($updatestmt);
}

// inserting in invoice table
$payment = "PAYPAL";
$invoicesql = "INSERT INTO INVOICE (ORDER_ID,PAYMENT_FROM,PAYMENT_TO,TOTAL_AMOUNT) VALUES (:order_id,:payment_from,:payment_to,:totalprice)";
$invoicestmt = oci_parse($connection, $invoicesql);
oci_bind_by_name($invoicestmt, ":order_id", $order_id);
oci_bind_by_name($invoicestmt , ":payment_from" ,$payment);
oci_bind_by_name($invoicestmt , ":payment_to" , $_SESSION['userID']);
oci_bind_by_name($invoicestmt , ":totalprice" , $_SESSION['totalprice']);
oci_execute($invoicestmt);


// delet all the cart product items from cart_product table
$delsql = "DELETE FROM CART_PRODUCT WHERE CART_ID = :cart_id";
$delstmt = oci_parse($connection, $delsql);
oci_bind_by_name($delstmt , ":cart_id" , $_SESSION['cart_id']);
oci_execute($delstmt);

// update collection slot
    $sqls = "SELECT * FROM COLLECTION_SLOT WHERE COLLECTION_SLOT_ID = :slot_id";
    $stid = oci_parse($connection, $sqls);
    oci_bind_by_name($stid, ":slot_id" ,$_SESSION['collectionslot_id']);
    oci_execute($stid);
    $data = oci_fetch_array($stid);
    $orderscount = $data['NUMBER_OF_ORDER'];
    if($orderscount == 0){ 
        // update the number of order in collectionslot 
        $status = 'deactive';
        $stql = "UPDATE COLLECTION_SLOT SET COLLECTION_STATUS= :ustatus WHERE COLLECTION_SLOT_ID = :slot_id";
        $stmt = oci_parse($connection,$stql);
        oci_bind_by_name($stmt , ":slot_id", $_SESSION['collectionslot_id']);
        oci_bind_by_name($stmt , ":ustatus", $status);
        oci_execute($stmt);
       }

    // echo "success";
    header("location:invoice.php");
