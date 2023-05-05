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
    <link rel="stylesheet" href="css/orderslis.css">
</head>
<body>

    <div class="order">
        <div class="order_header">
            <h3>Orders History Lists</h3>
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
                  </tr>
                
                <tr >
                  <td>3333</td>
                  <td>kARAN CHADUAHRY</td>
                  <td><img id='image' src="../logo/apple2.webp" alt="" /></td>
                  <td>200g</td>
                  <td>200.00</td>
                  <td>3/16/2023</td>
                 
                  <td> <div class='action'>
                        <p id='green' >Delivered</p>
                        
                        <p id='red'>Cancelled</p>
                        
                        </div>
                    </td>  
            
                </tr>

                <tr >
                    <td>3333</td>
                    <td>kARAN CHADUAHRY</td>
                    <td><img id='image' src="../logo/apple2.webp" alt="" /></td>
                    <td>200g</td>
                    <td>200.00</td>
                    <td>3/16/2023</td>
                    <td> <div class='action'>
                        <p id='green' >Delivered</p>
                        
                        <p id='red'>Cancelled</p>
                        
                        </div>
                    </td>    
                  </tr>

              </table>
        </div>
    
</body>
</html>