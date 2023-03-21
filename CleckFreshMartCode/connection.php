<?php
    $username="root";
    $host="localhost:3306";
    $password="";
    $database="projectmanagement";

    $connection = mysqli_connect($host,$username,$password,$database) or die("Unable to connect to database");
?>