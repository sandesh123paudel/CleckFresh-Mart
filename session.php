<?php
session_start();
include("db/connection.php");


if (isset($_SESSION['ID'])) {
    $user = $_SESSION['ID'];
    $role = $user['ROLE'];
    $user_id = $user['USER_ID'];

    $status = 'on';
    $sql = "UPDATE USER_I SET STATUS = :active WHERE USER_ID= :id";
    $stid = oci_parse($connection, $sql);
    oci_bind_by_name($stid, ':active', $status);
    oci_bind_by_name($stid, ':id', $user_id);
    oci_execute($stid);

    $token_length = 32;
    $token = base64_encode(random_bytes($token_length));

    if ($role === 'customer') {
        unset($_SESSION['userID']);
        $_SESSION['userID'] = $user['USER_ID'];
        $_SESSION['token'] = $token;
        include('customer/addremove.php');
        header('location:customer/homepage.php');
    }
    if ($role === 'trader') {
        unset($_SESSION['traderID']);
        $_SESSION['traderID'] = $user['USER_ID'];
        $_SESSION['type'] = $user['CATEGORY'];
        header('location:trader/traderdashboard.php');
    }
    if ($role === 'admin') {
        $_SESSION['adminID'] = $user['USER_ID'];
        header('location:admin/dashboard.php');
    }
}
