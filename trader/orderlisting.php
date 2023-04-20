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
    <link rel="stylesheet" href="css/ordersl.css">
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
        <div class="order-container">

            <table>
                <!-- table heading -->
                <th>
                  <tr class="head">
                    <td>ORDER ID</td>
                    <td>CUSTOMER</td>
                    <td>PRODUCT</td>
                    <td>QTY</td>
                    <td>PRICE(&#163;)</td>
                    <td>DATE</td>
                    <td>STATUS</td>
                    <td>ACTION</td>
                  </tr>
                </th>
        
                <tr class="item">
                  <td>3333</td>
                  <td>kARAN CHADUAHRY</td>
                  <td><img id='image' src="../logo/apple2.webp" alt="" /></td>
                  <td>200g</td>
                  <td>200.00</td>
                  <td>3/16/2023</td>
                  <td id="status">Pending...</td>
                  <td class="links-btn"><button>Delivered</button><button>Not Delivered</button></td>
                </tr>

                <tr class="item">
                    <td>3333</td>
                    <td>kARAN CHADUAHRY</td>
                    <td><img id='image' src="../logo/apple2.webp" alt="" /></td>
                    <td>200g</td>
                    <td>200.00</td>
                    <td>3/16/2023</td>
                    <td id="status">Pending...</td>
                    <td class="links-btn"><button>Delivered</button><button>Not Delivered</button></td>
                  </tr>

              </table>
        </div>

    </div>
    
</body>
</html>