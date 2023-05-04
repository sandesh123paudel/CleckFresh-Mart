<?php
  include("../db/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="css/ordersli.css">
</head>
<body>

    <div class="order">
        <div class="order_header">
            <h3>Orders Listing Lists</h3>
            <div class="search-box">
                <div class="search">
                    <input type="text" placeholder="Search...">
                    <span class="material-symbols-outlined">
                        search
                    </span>
                </div>

                <select name="" id="">
                    <option value="">All</option>
                    <option value="">Asce</option>
                    <option value="">Desc</option>
                </select>
            </div>
        </div>
        <div class="line"></div>
    </div>
    <div class="user-container">

    <table>
    <!-- table heading -->
  
      <tr>
        <th>ORDER ID</th>
        <th>CUSTOMER</th>
        <th>PRODUCT</th>
        <th>QTY</th>
        <th>PRICE(&#163;)</th>
        <th>DATE</th>
        <th>STATUS</th>
        <th>ACTION</th>
      </tr>

    <tr >
      <td>3333</td>
      <td>kARAN CHADUAHRY</td>
      <td><img id='image' src="../logo/apple2.webp" alt="" /></td>
      <td>200g</td>
      <td>200.00</td>
      <td>3/16/2023</td>
      <td id="status">Pending...</td>
      <td> <div class='action'>
                <a id='approve' href=updatetrader.php?id=$id&action=verified>Delivered</a>
                
                <a id='decline' href=deletetrader.php?id=$id&action=decline>Cancelled</a>
                
                </div>    </tr>

    <tr>
        <td>3333</td>
        <td>kARAN CHADUAHRY</td>
        <td><img id='image' src="../logo/apple2.webp" alt="" /></td>
        <td>200g</td>
        <td>200.00</td>
        <td>3/16/2023</td>
        <td id="status">Pending...</td>
        <td> <div class='action'>
            <a id='approve' href=updatetrader.php?id=$id&action=verified>Delivered</a>   
            <a id='decline' href=deletetrader.php?id=$id&action=decline>Cancelled</a>        
        </div></tr>

  </table>
</div>
    
</body>
</html>