<?php
    include_once("connection.php");

    if(isset($_GET['id']) && isset($_GET['action'])){
        $delid = $_GET['id'];

        $sql = "DELETE FROM shop WHERE Id=$delid";

        $qry = mysqli_query($connection, $sql) or die(mysqli_error($connection));

        if($qry){
            header("location:traderdashboard.php");
        }
    }
?>