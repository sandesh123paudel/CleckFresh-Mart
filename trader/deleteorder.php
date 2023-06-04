<?php
include("../db/connection.php");
if(isset($_GET['order_id'])){

$order_id = $_GET['order_id'];

$sqlplue = "SELECT * 
FROM ORDER_PRODUCT op 
JOIN PRODUCT p ON op.PRODUCT_ID = p.PRODUCT_ID
WHERE op.ORDER_ID = :order_id";
$sqlstid = oci_parse($connection, $sqlplue);
oci_bind_by_name($sqlstid, ":order_id", $order_id);
oci_execute($sqlstid);
while ($row = oci_fetch_array($sqlstid)) {
    $product_id = $row['PRODUCT_ID'];
    $quantity = (int)$row['ORDER_QUANTITY'];
    $stock = (int)$row['STOCK_NUMBER'];
    $total = $quantity + $stock;

    $updatesql = "UPDATE PRODUCT SET STOCK_NUMBER = :stock WHERE PRODUCT_ID = :product_id";
    $stids = oci_parse($connection, $updatesql);
    oci_bind_by_name($stids, ":stock", $total);
    oci_bind_by_name($stids, ":product_id", $product_id);
    oci_execute($stids);
}


$sql = "DELETE FROM ORDER_PRODUCT WHERE ORDER_ID = :order_id";
$stid = oci_parse($connection, $sql);
oci_bind_by_name($stid, ":order_id", $order_id);
oci_execute($stid);

$delete = "removed";
$update = 'UPDATE ORDER_I SET ORDER_STATUS = :remove WHERE ORDER_ID = :order_id';
$updatestmt = oci_parse($connection, $update);
oci_bind_by_name($updatestmt, ":remove", $delete);
oci_bind_by_name($updatestmt, ":order_id", $order_id);
if (oci_execute($updatestmt)) {
    header("location:traderdashboard.php?cat=Orderlist&name=Orders");
}

}

?>