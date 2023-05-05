<?php
    session_start();
    include('connection.php');

    $status = 'off';    
    $sql = "UPDATE USER_I SET STATUS = :active WHERE USER_ID= :id";
    $stid = oci_parse($connection,$sql);

    oci_bind_by_name($stid,':active' ,$status);

    if(isset($_SESSION['userID'])){
        oci_bind_by_name($stid, ':id' , $_SESSION['userID']);
      }
    if(isset($_SESSION['traderID'])){
        oci_bind_by_name($stid, ':id' , $_SESSION['traderID'] );
      }
    if(isset($_SESSION['adminID'] )){
        oci_bind_by_name($stid, ':id' , $_SESSION['adminID'] );
      }
      
    oci_execute($stid);

    if($_GET['role']== 'customer'){
      unset($_SESSION['userID']);
      unset($_SESSION['token']);
    }
    if($_GET['role']== 'trader'){
      unset($_SESSION['traderID']);
    }
    if($_GET['role']== 'admin'){
      unset($_SESSION['adminID']);
    }

    header('location:../login.php');
?>