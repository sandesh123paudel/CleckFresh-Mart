<?php
session_start();
include("db/connection.php");

if(isset($_SESSION['token'])){
    $user = $_SESSION['ID'];
    $_SESSION['userID'] = $user['USER_ID'];
    $_SESSION['pname']=$user['FIRST_NAME'];
    $_SESSION['role'] = $user['ROLE'];
    $_SESSION['type'] = $user['CATEGORY'];

    $status = 'on';    
    $sql = "UPDATE USER_I SET STATUS = :active WHERE USER_ID= :id";
    $stid = oci_parse($connection,$sql);
    oci_bind_by_name($stid,':active' ,$status);
    oci_bind_by_name($stid,':id' ,$_SESSION['userID']);
    oci_execute($stid);

    if($_SESSION['role'] === 'customer'){
        header('location:customer/homepage.php');
    }
    if($_SESSION['role'] === 'trader'){
        header('location:trader/traderdashboard.php');
    }
    if($_SESSION['role'] === 'admin'){
        echo "successfully connected to admin";
    }
}

?>