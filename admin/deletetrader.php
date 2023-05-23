<?php
include('../db/connection.php');

if (isset($_GET['id']) && isset($_GET['action'])) {
    $delid = $_GET['id'];

    $sqlq = "SELECT * FROM USER_I WHERE USER_ID= :id"; // selecting the all data from the user
    $stmt = oci_parse($conn, $sqlq);
    oci_bind_by_name($stmt, ":id", $delid);
    // exeucuting the query
    oci_execute($stmt);
    while ($row = oci_fetch_array($stmt, OCI_ASSOC)) {
        $fname = $row['FIRST_NAME'];
        $lname = $row['LAST_NAME'];
        $email = $row['EMAIL'];
    }

    $username = $fname . " " . $lname;

    $femail = $email;

    $sub = "Notification from chfxmart";
    $message = "Dear " . $username . ",\nSorry!! For this time You are not verified as trader. Try again Later..\nThank You for your interest. ";

    include_once('../sendmail.php');

    $sql = "DELETE FROM USER_I WHERE USER_ID = :did";
    $stid = oci_parse($connection, $sql);
    oci_bind_by_name($stid, ':did', $delid);

    if (oci_execute($stid)) {
        header('location:dashboard.php?name=Users&cat=Traders Lists');
    }
}
?>

