<?php
session_start();
include("../db/connection.php");

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];
    $email = $_GET['email'];

    // $sqlq = "SELECT * FROM SHOP WHERE USER_ID = :id"; // selecting the all data from the user
    // $stmt = oci_parse($connection,$sqlq);
    // oci_bind_by_name($stmt, ":id" ,$id);
    // // exeucuting the query
    // oci_execute($stmt);
    // while($row=oci_fetch_array($stmt,OCI_ASSOC)){
    //     $fname = $row['FIRST_NAME'];
    //     $lname=$row['LAST_NAME'];
    //     $email = $row['EMAIL'];
    // }
    // $username = $fname." ".$lname;

    $sql = "UPDATE SHOP SET STATUS = :verify WHERE SHOP_ID = :id";
    $stid = oci_parse($connection, $sql);
    oci_bind_by_name($stid, ':verify', $action);
    oci_bind_by_name($stid, ':id', $id);

    $femail = $email;

    if ($_GET['action'] == 'verified') {
        $sub = "Notification from Cleckfreshmart";
        $message = "Dear " . $username . ",\n\tYour Shop is successfully approved in our Ecommerce Patform.\n\t Now You are able Do your business.";
    } else if ($_GET['action'] == 'pending') {
        $sub = "Notification form Cleckfreshmart";
        $message = "Dear " . $username . ",\n\tYour Shop is deactivate because of non activation. \n\tTo activate your shop you can reply this mail with your proper information.";
    }

    include_once('../sendmail.php');

    if (oci_execute($stid)) {
        header('location:dashboard.php?cat=Shop Lists');
    }
}
