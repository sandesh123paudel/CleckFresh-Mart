<?php
    include("../db/connection.php");

    if(isset($_GET['id']) && isset($_GET['action'])){
        $id = $_GET['id'];
        $action = $_GET['action'];

        $sql = "UPDATE USER_I SET VERIFY = :verify WHERE USER_ID = :id";
        $stid = oci_parse($connection,$sql);
        oci_bind_by_name($stid, ':verify' ,$action);
        oci_bind_by_name($stid, ':id' ,$id);
        
        $femail = $_SESSION['email'];
        if($_GET['action'] == 'verified'){
            $sub ="Notification from Cleckfreshmart";
            $message="Dear ".$_SESSION['username'].",You are successfully registered as Trader in our Ecommerce Patform. Now You can login And Do your business.";
        }
        else{
            $sub ="Notification form Cleckfreshmart";
            $message="Dear ".$_SESSION['username'].",Your Trader account is deactivate because of non activation. To activate you account you can reply this mail with your proper information.";
        }
                            
        include_once('../sendmail.php');

        if(oci_execute($stid)){
            header('location:dashboard.php?name=Users&cat=Traders Lists');
        }
    }

?>