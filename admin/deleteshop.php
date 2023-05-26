<?php
include('../db/connection.php');

if (isset($_GET['id']) && isset($_GET['action'])) {
    $delid = $_GET['id'];
    $delemail = $_GET['email'];

    $femail = $delemail ;

    $sub = "Rejection from CleckFreshMart";
    $message = "Dear " . $username . ",
    \n\nSorry!! For this time You shop is not verified. 
    \nTry again Later..
    \n\nThank You for your interest. 
    \nHave a great day!
    \nCleckFreshMart";

    include_once('../sendmail.php');

    $sql = "DELETE FROM SHOP WHERE SHOP_ID = :did";
    $stid = oci_parse($connection, $sql);
    oci_bind_by_name($stid, ':did', $delid);

    if (oci_execute($stid)) {
        header('location:dashboard.php?name=Users&cat=Shop Lists');
    }
}
?>

