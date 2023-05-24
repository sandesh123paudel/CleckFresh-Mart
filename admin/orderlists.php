<?php
include("../db/connection.php");

echo "<div class='user-container'>";
echo "<table>";
echo "<tr>
        <th>Id</th>
        <th>Name</th>
        <th>No of Item</th>
        <th>Order Date</th>
        <th>&pound; Price</th>
        <th>Payment</th>
        <th>Action</th>
        </tr>";

$sql = "SELECT o.*, u.* 
        FROM ORDER_I o 
        JOIN CART c ON c.CART_ID = o.CART_ID
        JOIN USER_I u ON c.USER_ID = u.USER_ID ORDER BY o.ORDER_ID DESC";
$stid = oci_parse($connection, $sql);
// exeucuting the query
oci_execute($stid);
while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
    $order_id = $row['ORDER_ID'];
    $order_date = $row['ORDER_DATE'];
    $items = $row['NO_OF_ITEM'];
    $totalprice = $row['TOTAL_PRICE'];
    $order_status = $row['ORDER_STATUS'];
    $user_name = $row['FIRST_NAME'] . " " . $row['LAST_NAME'];

    echo "<tr>";
    echo "<td>" . $order_id . "</td>";
    echo "<td>" . ucfirst($user_name) . "</td>";
    echo "<td>" . $items . "</td>";
    echo "<td>" . $order_date . "</td>";
    echo "<td><b>&pound; " . $totalprice . "</b></td>";
    if ($order_status == 'pending') {
        echo "<td id='red'>" . $order_status . "</td>";
    } else if ($order_status == 'completed') {
        echo "<td id='green'>" . $order_status . "</td>";
    }
    echo "<td>";
    
    if ($order_status == 'pending') {
        echo "<div class='action'>
        <a id='decline' href=moneytransfer.php?order_id=$order_id&action=delete>Remove</a>
        </div>";
    } else if ($order_status == 'completed') {
        echo "<div class='action'>
            <a id='approve' href=moneytransfer.php?order_id=$order_id&action=transfer>Transfer</a>
        </div>";
    }
    else if($order_status == 'transfered'){
        echo "<td id='green'>" . $order_status . "</td>";    }
    else if($order_status == 'removed'){
        echo "<td id='red'>" . $order_status . "</td>";    }

    echo "</td>";
    echo "</tr>";
}
echo "</table>";

echo "</div>";
