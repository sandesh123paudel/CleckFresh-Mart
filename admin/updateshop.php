<?php
session_start();
include("../db/connection.php");

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];
    $email = $_GET['email'];

    $sql = "UPDATE SHOP SET STATUS = :verify WHERE SHOP_ID = :id";
    $stid = oci_parse($connection, $sql);
    oci_bind_by_name($stid, ':verify', $action);
    oci_bind_by_name($stid, ':id', $id);

    $femail = $email;

    if ($_GET['action'] == 'verified') {
        $sub = "Approval from Cleckfreshmart";
        $message = "Dear " . $username . ",
        \n\nYour Shop is successfully approved in our Ecommerce Patform.
        \nNow You are able Do your business.
        \n\nThank you.
        \nHave a great day!
        \nCleckFreshMart";
    
    
    } else if ($_GET['action'] == 'pending') {
        $sub = "Deactivation form Cleckfreshmart";
        $message = "Dear " . $username . ",
        \nYour Shop is deactivate because of non activation. 
        \nTo activate your shop you can reply this mail with your proper information.
        \n\nThank you.
        \nHave a great day!
        \nCleckFreshMart";
    
    }

    include_once('../sendmail.php');

    if (oci_execute($stid)) {
        header('location:dashboard.php?cat=Shop Lists');
    }
}
