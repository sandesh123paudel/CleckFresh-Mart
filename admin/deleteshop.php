<?php
include('../db/connection.php');

if (isset($_GET['id']) && isset($_GET['action'])) {
    $delid = $_GET['id'];
    $delemail = $_GET['email'];

    $femail = $delemail ;

    $sub = "Notification from chfxmart";
    $message = "Dear " . $username . ",\nSorry!! For this time You shop is not verified. Try again Later..\nThank You for your interest. ";

    include_once('../sendmail.php');

    $sql = "DELETE FROM SHOP WHERE SHOP_ID = :did";
    $stid = oci_parse($connection, $sql);
    oci_bind_by_name($stid, ':did', $delid);

    if (oci_execute($stid)) {
        header('location:dashboard.php?name=Users&cat=Shop Lists');
    }
}
?>

