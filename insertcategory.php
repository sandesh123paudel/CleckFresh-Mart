<?php
    session_start();
    include('db/connection.php');

    // for inserting category in category table
    if(isset($_SESSION['category'])){
        $cat_name = $_SESSION['category'];
        
        $sql = "INSERT INTO CATEGORY(CATEGORY_ID,CATEGORY_NAME) VALUES(:cat_id,:cat_name)";
        
        $stid = oci_parse($connection,$sql);
        oci_bind_by_name($stid,':cat_id',$category_id);
        oci_bind_by_name($stid,':cat_name',$cat_name);
        
        if(oci_execute($stid)){
            header('location:login.php');
        }
    }

?>