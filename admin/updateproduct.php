<?php
include("../db/connection.php");
if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    $sql = "UPDATE PRODUCT SET PRODUCT_STATUS = :verify WHERE PRODUCT_ID = :id";
    $stid = oci_parse($connection, $sql);
    oci_bind_by_name($stid, ':verify', $action);
    oci_bind_by_name($stid, ':id', $id);

    if (oci_execute($stid)) {
        header('location:dashboard.php?cat=Product Lists');
    }
}

?>