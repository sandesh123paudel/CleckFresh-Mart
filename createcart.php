<?php
session_start();
include('db/connection.php');

// for inserting category in category table
if (isset($_SESSION['email'])) {

    $sql1 = "SELECT * FROM USER_I WHERE EMAIL = :uemail";
    $stid1 = oci_parse($connection, $sql1);
    oci_bind_by_name($stid1, ':uemail', $_SESSION['email']);
    oci_execute($stid1);

    $row = oci_fetch_array($stid1,OCI_ASSOC);
    $user_id = $row['USER_ID'];

    $sqlq = "INSERT INTO WISHLIST (USER_ID) VALUES(:user_id)";
    $stmt = oci_parse($connection, $sqlq);
    oci_bind_by_name($stmt, ':user_id', $user_id);
    oci_execute($stmt);

    $sql = "INSERT INTO CART (USER_ID) VALUES(:user_id)";
    $stid = oci_parse($connection, $sql);
    oci_bind_by_name($stid, ':user_id', $user_id);

    if(oci_execute(($stid))) {

        header('location:login.php');
    }
}
