<?php

  session_start();
  include('../db/connection.php');
  

if(isset($_POST['updateprofile'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uemail = $_POST['email'];
    $birth = $_POST['dob'];
    $gender = $_POST['gender'];
    $contact = $_POST['phone'];

    $sql = "UPDATE USER_I SET FIRST_NAME= :fname,LAST_NAME= :lname,GENDER= :gender,CONTACT= :contact,EMAIL = :email,DATE_OF_BIRTH= :dob WHERE USER_ID= :id ";
    $stid= oci_parse($connection,$sql);

    oci_bind_by_name($stid, ':id' , $_SESSION['userID']);
    oci_bind_by_name($stid, ':fname', $fname);
    oci_bind_by_name($stid, ':lname', $lname);
    oci_bind_by_name($stid, ':gender', $gender);
    oci_bind_by_name($stid, ':contact', $contact);
    oci_bind_by_name($stid, ':email', $uemail);
    oci_bind_by_name($stid, ':dob', $birth);

    if(oci_execute($stid)){
      
      if($_SESSION['role'] == 'customer'){
        header("location:../customer/profile.php?cat=profile");      
      }

      if($_SESSION['role'] == 'trader'){
        header("location:../trader/traderdashboard.php?cat=Profile&name=Home");      
      }

  }
}

?>