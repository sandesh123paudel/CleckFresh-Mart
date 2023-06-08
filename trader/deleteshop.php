<?php
  include('../db/connection.php');

    if(isset($_GET['id']) && isset($_GET['action'])){
        $delid = $_GET['id'];

        $sql = "DELETE FROM PRODUCT WHERE SHOP_ID = :pid";
        $stid = oci_parse($connection,$sql);
        oci_bind_by_name($stid,':pid', $delid);
        oci_execute($stid);

        $sql = "DELETE FROM SHOP WHERE SHOP_ID = :did";
        $stid = oci_parse($connection,$sql);
        oci_bind_by_name($stid,':did', $delid);
        if(oci_execute($stid)){
            header("location:traderdashboard.php?cat=Shoplist");
        }
    }
