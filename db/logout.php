<?php
session_start();
include('connection.php');

$status = 'off';
$sql = "UPDATE USER_I SET STATUS = :active WHERE USER_ID= :id";
$stid = oci_parse($connection, $sql);

oci_bind_by_name($stid, ':active', $status);

if (isset($_GET['role'])) {


  if ($_GET['role'] == 'customer') {
    oci_bind_by_name($stid, ':id', $_SESSION['userID']);

    unset($_SESSION['userID']);
    unset($_SESSION['token']);
    unset($_SESSION['cart_id']);
  }
  if ($_GET['role'] == 'trader') {
    oci_bind_by_name($stid, ':id', $_SESSION['traderID']);

    unset($_SESSION['traderID']);
  }
  if ($_GET['role'] == 'admin') {
    oci_bind_by_name($stid, ':id', $_SESSION['adminID']);
    unset($_SESSION['adminID']);
  }

  if (oci_execute($stid)) {
    echo "success";
  }

  header('location:../login.php');
}
