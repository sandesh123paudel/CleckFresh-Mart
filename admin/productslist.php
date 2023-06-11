<?php
include("../db/connection.php");

//writing the sql query
$sql = "SELECT * FROM PRODUCT ORDER BY PRODUCT_ID DESC"; // selecting the all data from the user
$stid = oci_parse($connection, $sql);
// exeucuting the query
oci_execute($stid);


echo "<div class='user-container'>";
echo "<table>";
echo "<tr>
        <th>Id</th>
        <th>Image</th>
        <th>Name</th>
        <th>Category</th>
        <th>Shop</th>
        <th>Stock</th>
        <th>Price</th>
        <th>Status</th>
        <th>Action</th>
        </tr>";
while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
    $pid = $row['PRODUCT_ID'];
    $status = $row['PRODUCT_STATUS'];

    echo "<tr>";
    echo "<td>" . $row['PRODUCT_ID'] . "</td>";
    echo "<td class='imgs'><img src=\"../db/uploads/products/" . $row['PRODUCT_IMAGE'] . "\" alt=" . $row['PRODUCT_NAME'] . " ></td>";
    echo "<td>" . ucfirst($row['PRODUCT_NAME']) . "</td>";
    echo "<td>" . $row['CATEGORY_ID'] . "</td>";
    echo "<td>" . $row['SHOP_ID'] . "</td>";
    echo "<td>" . $row['STOCK_NUMBER'] . "</td>";
    echo "<td> &pound; " . $row['PRODUCT_PRICE'] . "</td>";
    echo "<td>" . $status . "</td>";

    if ($status == 'pending') {
        echo "<td> <div class='action'>" .
            "<a id='approve' href=updateproduct.php?id=$pid&action=verified>Approve</a>
            </div>
        </td>";
    } else {
        echo "<td> <div class='action'> <a href=updateproduct.php?id=$pid&action=pending>Deactivate</a> </div>
        </td>";
    }

    echo "</tr>";
}

echo "</table>";

echo "</div>";
