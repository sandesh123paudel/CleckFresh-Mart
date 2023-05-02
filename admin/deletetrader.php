<?php

  include('../db/connection.php');

    if(isset($_GET['id']) && isset($_GET['action'])){
        $delid = $_GET['id'];

        $sql = "DELETE FROM USER_I WHERE USER_ID = :did";
        
        $stid = oci_parse($connection,$sql);

        oci_bind_by_name($stid,':did', $delid);

        if(oci_execute($stid)){
            header('location:dashboard.php?name=Users&cat=Traders Lists');
        }
    }
?>