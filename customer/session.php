<?php
session_start();

if(isset($_SESSION['ID'])){
    $user = $_SESSION['ID'];
    
    $_SESSION['userID'] = $user['USER_ID'];
    $_SESSION['role'] = $user['ROLE'];
    $_SESSION['username'] = $user['FIRST_NAME'];
    $_SESSION['type'] = $user['CATEGORY'];

    if($_SESSION['role'] === 'customer'){
        header('location:productview.php');
    }
    if($_SESSION['role'] === 'trader'){
        header('location:../trader/traderdashboard.php');
    }
    if($_SESSION['role'] === 'admin'){
        echo "successfully connected to admin";
    }
}

?>