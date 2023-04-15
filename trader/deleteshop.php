<?php
  include('../db/connection.php');

    if(isset($_GET['id']) && isset($_GET['action'])){
        $delid = $_GET['id'];

        $sql = "DELETE FROM SHOP WHERE Id = :id";

        
        $stid = oci_parse($connection,$sql);

        oci_bind_by_name($stid,':id', $delid);

        if(oci_execute($stid)){
            header("location:traderdashboard.php");
        }
    }
?>