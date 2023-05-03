<?php
session_start();
include("db/connection.php");

if(isset($_SESSION['token'])){
    $user = $_SESSION['ID'];
    $role = $user['ROLE'];

    $status = 'on';    
    $sql = "UPDATE USER_I SET STATUS = :active WHERE USER_ID= :id";
    $stid = oci_parse($connection,$sql);
    oci_bind_by_name($stid,':active' ,$status);
    oci_bind_by_name($stid,':id' ,$_SESSION['userID']);
    oci_execute($stid);

    if($role === 'customer'){
        $_SESSION['userID'] = $user['USER_ID'];
        $_SESSION['pname']=$user['FIRST_NAME'];
        header('location:customer/homepage.php');
    }
    if($role === 'trader'){
        $_SESSION['userID'] = $user['USER_ID'];
        $_SESSION['pname']=$user['FIRST_NAME'];
        $_SESSION['type'] = $user['CATEGORY'];
        header('location:trader/traderdashboard.php');
    }
    if($role === 'admin'){
        $_SESSION['userID'] = $user['USER_ID'];
        $_SESSION['pname']=$user['FIRST_NAME'];
        echo "successfully connected to admin";
    }
}

?>