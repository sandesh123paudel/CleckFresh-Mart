<?php
    session_start();
    include("../db/connection.php");

    if(isset($_GET['id']) && isset($_GET['action'])){
        $id = $_GET['id'];
        $action = $_GET['action'];

        $sqlq = "SELECT * FROM USER_I WHERE USER_ID = :id"; // selecting the all data from the user
        $stmt = oci_parse($connection,$sqlq);
        oci_bind_by_name($stmt, ":id" ,$id);
        // exeucuting the query
        oci_execute($stmt);
        while($row=oci_fetch_array($stmt,OCI_ASSOC)){
            $fname = $row['FIRST_NAME'];
            $lname=$row['LAST_NAME'];
            $email = $row['EMAIL'];
        }
        $username = $fname." ".$lname;

        $sql = "UPDATE USER_I SET VERIFY = :verify WHERE USER_ID = :id";
        $stid = oci_parse($connection,$sql);
        oci_bind_by_name($stid, ':verify' ,$action);
        oci_bind_by_name($stid, ':id' ,$id);
        
        $femail =$email;

        if($_GET['action'] == 'verified'){
            $sub ="Notification from Cleckfreshmart";
            $message="Dear ".$username.",\nYou are successfully registered as Trader in our Ecommerce Patform.\n Now You can login And Do your business.";
        }
        else if ($_GET['action'] == 'pending'){   
            $sub ="Notification form Cleckfreshmart";
            $message="Dear ".$username.",\nYour Trader account is deactivate because of non activation. \nTo activate you account you can reply this mail with your proper information.";
            
        }
                  
        include_once('../sendmail.php');

        if(oci_execute($stid)){
            header('location:dashboard.php?name=Users&cat=Traders Lists');
        }
    }

?>