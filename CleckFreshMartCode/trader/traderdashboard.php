<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="dashboards.css" />
</head>
<body>
    <div class="trader-container">
        
        <div class="part1">
            <!-- logo -->
            <div class="logo">
                <a href="#"><img src="../logo/logo.png" alt="logo" /></a>
            </div>
            <!-- side-links -->
            <div class="side-links">
                
                <div class="home-link">
                    <span class="material-symbols-outlined">home</span>
                    <a href="#">HOME</a>
                </div>
                
                <!-- Product dropdown -->
                <div class="category-link">
                    <div class="dropdown" onmouseover="onMouse('product')" onmouseout="outMouse('product')">
                        <div class="dropdown-link">
                            <span class="material-symbols-outlined">shopping_bag</span>
                            <h4>PRODUCTS</h4>
                        </div>
                        <p>▼</p>
                    </div>
                    <!-- list shops -->
                    <div class="dropdown-content" id="product" onmouseover="onMouse('product')" onmouseout="outMouse('product')">
                        <div>
                            <a href="#" >Products Lists</a>
                            <a href="#" >Add Products</a>
                        </div>
                    </div>
                </div>
                <!-- dropdown for Shops -->
                <div class="category-link">
                    <div class="dropdown" onmouseover="onMouse('shop')" onmouseout="outMouse('shop')">
                        <div class="dropdown-link">
                            <span class="material-symbols-outlined">store</span>
                            <h4>SHOPS</h4>
                        </div>
                        <p>▼</p>
                    </div>
                    <!-- list shops -->
                    <div class="dropdown-content" id="shop" onmouseover="onMouse('shop')" onmouseout="outMouse('shop')">
                        <div>
                            <a href="#" >Shops Lists</a>
                            <a href="#" >Add Shops</a>
                        </div>
                    </div>
                </div>
                <!-- dropdown for orders -->
                <div class="category-link">
                    <div class="dropdown" onmouseover="onMouse('order')" onmouseout="outMouse('order')">
                        <div class="dropdown-link">
                            <span class="material-symbols-outlined">redeem</span>
                            <h4>ORDERS</h4>
                        </div>
                        <p>▼</p>
                    </div>
                    <!-- list shops -->
                    <div class="dropdown-content" id="order" onmouseover="onMouse('order')" onmouseout="outMouse('order')">
                        <div>
                            <a href="#" >Order Lists</a>
                            <a href="#" >Order History</a>
                        </div>
                    </div>
                </div>
                
                <div class="logout">
                    <a href="#">LOGOUT</a>
                </div>
        </div>        
            </div>
            <div class="part2">
                <!-- headers -->
                <div class="header">
                    <div class="header1">
                        <span class="material-symbols-outlined">
                            menu
                        </span>
                        <h5><p>Home > </p> Overview</h5>
                    </div>
                    <div class="header2">
                        <h3>Zaapp</h3>
                        <span>v</span>
                    </div>
                </div>
                <!-- content import pages -->
                <div class="content">
                   <?php
                    require('overview.php');
                   ?>
                </div>
            </div>
    </div>
<script>

    function onMouse(prop){

        if(prop == 'product'){
            document.getElementById('product').style.display="block";
        }
        
        if(prop == 'shop'){
            document.getElementById('shop').style.display="block";
        }
        
        if(prop == 'order'){
            document.getElementById('order').style.display="block";
        }
         
    }

    function outMouse(prop){
        if(prop == 'product'){
            document.getElementById('product').style.display="none";
        }

        if(prop == 'shop'){
            document.getElementById('shop').style.display="none";
        }
        
        if(prop == 'order'){
            document.getElementById('order').style.display="none";
        }
    }

</script>

</body>
</html>