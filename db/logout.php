<?php
    session_start();
    include('connection.php');

    $status = 'off';    
    $sql = "UPDATE USER_I SET STATUS = :active WHERE USER_ID= :id";
    $stid = oci_parse($connection,$sql);
    oci_bind_by_name($stid,':active' ,$status);
    oci_bind_by_name($stid,':id' ,$_SESSION['userID']);
    oci_execute($stid);

    session_unset();
    session_destroy();
    header('location:../login.php')
?>