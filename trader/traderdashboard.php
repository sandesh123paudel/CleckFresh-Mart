<?php
 session_start();
 include("../db/connection.php");
 
 if($_SESSION['userID']){
  $sql = 'SELECT * FROM USER_I WHERE USER_ID= :id ';
  $stid = oci_parse($connection,$sql);

  oci_bind_by_name($stid,':id',$_SESSION['userID']);

  oci_execute($stid);
  
  $username='';
  while($row = oci_fetch_array($stid,OCI_ASSOC)){
    $username = $row['FIRST_NAME'];
    $_SESSION['username'] = $username;
  }
}

  if(empty($_SESSION['userID'])){
    echo "<script>
      alert('SESSION is EXPIRED Please Login!!!');
      document.location.href='../login.php';
      </script>";
  }

 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    />
    <link rel="stylesheet" href="css/dashb.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
      crossorigin="anonymous"
    />

  </head>
  <body>
    <div class="trader-container">
      <div class="part1">
        <!-- logo -->
        <div class="logo">
          <a href="traderdashboard.php"><img src="../logo/logo.png" alt="logo" /></a>
        </div>
        <!-- side-links -->
        <div class="side-links">
          <div class="home-link">
            <span class="material-symbols-outlined">home</span>
            <a href="traderdashboard.php">HOME</a>
          </div>

          <!-- Product dropdown -->
          <div class="category-link">
            <div
              class="dropdown"
              onmouseover="onMouse('product')"
              onmouseout="outMouse('product')"
            >
              <div class="dropdown-link">
                <span class="material-symbols-outlined">shopping_bag</span>
                <h4>PRODUCTS</h4>
              </div>
              <p>▼</p>
            </div>
            <!-- list shops -->
            <div
              class="dropdown-content"
              id="product"
              onmouseover="onMouse('product')"
              onmouseout="outMouse('product')"
            >
              <div>
                <a href="traderdashboard.php?cat=Productlist&name=Products">Products Lists</a>
                <a href="traderdashboard.php?cat=Addproduct&name=Products">Add Products</a>
              </div>
            </div>
          </div>
          <!-- dropdown for Shops -->
          <div class="category-link">
            <div
              class="dropdown"
              onmouseover="onMouse('shop')"
              onmouseout="outMouse('shop')"
            >
              <div class="dropdown-link">
                <span class="material-symbols-outlined">store</span>
                <h4>SHOPS</h4>
              </div>
              <p>▼</p>
            </div>
            <!-- list shops -->
            <div
              class="dropdown-content"
              id="shop"
              onmouseover="onMouse('shop')"
              onmouseout="outMouse('shop')"
            >
              <div>
                <a href="traderdashboard.php?cat=Shoplist&name=Shops">Shops Lists</a>
                <a href="traderdashboard.php?cat=Addshop&name=Shops">Add Shops</a>
              </div>
            </div>
          </div>
          <!-- dropdown for orders -->
          <div class="category-link">
            <div
              class="dropdown"
              onmouseover="onMouse('order')"
              onmouseout="outMouse('order')"
            >
              <div class="dropdown-link">
                <span class="material-symbols-outlined">redeem</span>
                <h4>ORDERS</h4>
              </div>
              <p>▼</p>
            </div>
            <!-- list shops -->
            <div
              class="dropdown-content"
              id="order"
              onmouseover="onMouse('order')"
              onmouseout="outMouse('order')"
            >
              <div>
                <a href="traderdashboard.php?cat=Orderlist&name=Orders">Order Lists</a>
                <a href="traderdashboard.php?cat=Orderhistory&name=Orders">Order History</a>
              </div>
            </div>
          </div>

          <div class="logout">
            <a href="../db/logout.php">LOGOUT</a>
          </div>
        </div>
      </div>
      <div class="part2">
        <!-- headers -->
        <div class="header">
          <div class="header1">
            <span
              class="material-symbols-outlined menu"
              type="button"
              data-bs-toggle="offcanvas"
              data-bs-target="#offcanvasScrolling"
              aria-controls="offcanvasScrolling"
            >
              menu
            </span>
            <h5 id="link">
              <?php
                if(isset($_GET['cat']) && isset($_GET['name'])){
                  $links = $_GET['cat'];
                  $name = strtoupper($_GET['name']);
                  echo "<p>".$name." > </p>".$links;
                }
                else{
                  echo "<p>Home ></p>
                  Overview";
                }
              ?>
              
            </h5>
          </div>
          <div class="header2">

            <h3 class="profile dropdown-toggle" 
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false">
                <?php  

                  echo $_SESSION['username']; 
                
                ?> </h3>              
            <div>
              <ul class="dropdown-menu setting">
                <li><a class="dropdown-item" href="traderdashboard.php?cat=Profile&name=Home">Profile</a></li>
                <li>
                <label class="dropdown-item dropdown-toggle" 
                  onmouseover="onMouse('Profile')"
                  onmouseout="outMouse('Profile')" 
                  data-bs-toggle="dropdown"
                  aria-expanded="false">Setting</label>
                <div>
                  <ul class="dropdown-menu" id='setting'>
                    <li><a class="dropdown-item" href="traderdashboard.php?cat=UpdateProfile&name=Home">Update Profile</a></li>
                    <li><a class="dropdown-item" href="../profile/deactivate/php">Deactivate</a></li>
                    <li><a class="dropdown-item" href="../profile/activate.php">Activate</a></li>
                  </ul>
                </div>
              </li>
              </ul>
            </div>

          </div>
        </div>
        <!-- content import pages -->
        <div class="content">
          <?php
            if(isset($_GET['cat'])){
              $links = $_GET['cat'];
              
              if($links == "Addproduct"){
                require('addproduct.php');
              }
              if($links == "Productlist"){
                require('productlist.php');
              }
              if($links == "Addshop"){
                require('addshop.php');
              }
              if($links == "Shoplist"){
                require('shoplist.php');
              }
              if($links == "Orderlist"){
                require('orderlisting.php');
              }
              if($links == "Orderhistory"){
                require('orderhistory.php');
              }
              if($links == "EditProduct"){
                $id = $_GET['id'];
                $action = $_GET['action'];
                require_once('editProduct.php');
              }
              if($links == "EditShop"){
                $id = $_GET['id'];
                $action = $_GET['action'];
                require_once('editshop.php');
              }
              if($links == "Profile"){
                require_once('../profile/profilepage.php');
              }
              if($links == "UpdateProfile"){
                require_once('../profile/editprofile.php');
              } 
            }
            else{
              require('overview.php'); 
            }         
          ?>
        </div>
      </div>
    </div>

    <!-- Offcanvas -->
    <div
      class="offcanvas offcanvas-start"
      data-bs-scroll="true"
      data-bs-backdrop="false"
      tabindex="-1"
      id="offcanvasScrolling"
      aria-labelledby="offcanvasScrollingLabel"
    >
      <div class="offcanvas-header">
        <div class="logo">
          <a href="traderdashboard.php"><img src="../logo/logo.png" alt="logo" /></a>
        </div>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="offcanvas"
          aria-label="Close"
        ></button>
      </div>
      <div class="offcanvas-body">
        <div class="side-links">
          <div class="home-link">
            <span class="material-symbols-outlined">home</span>
            <a href="traderdashboard.php">HOME</a>
          </div>

          <!-- Product dropdown -->
          <div class="category-link">
            <div
              class="dropdown"
              onmouseover="onMouse('products')"
              onmouseout="outMouse('products')"
            >
              <div class="dropdown-link">
                <span class="material-symbols-outlined">shopping_bag</span>
                <h4>PRODUCTS</h4>
              </div>
              <p>▼</p>
            </div>
            <!-- list shops -->
            <div
              class="dropdown-content"
              id="products"
              onmouseover="onMouse('products')"
              onmouseout="outMouse('products')"
            >
              <div>
                <a href="traderdashboard.php?cat=Productlist&name=Products">Products Lists</a>
                <a href="traderdashboard.php?cat=Addproduct&name=Products">Add Products</a>
              </div>
            </div>
          </div>
          <!-- dropdown for Shops -->
          <div class="category-link">
            <div
              class="dropdown"
              onmouseover="onMouse('shops')"
              onmouseout="outMouse('shops')"
            >
              <div class="dropdown-link">
                <span class="material-symbols-outlined">store</span>
                <h4>SHOPS</h4>
              </div>
              <p>▼</p>
            </div>
            <!-- list shops -->
            <div
              class="dropdown-content"
              id="shops"
              onmouseover="onMouse('shops')"
              onmouseout="outMouse('shops')"
            >
              <div>
                <a href="traderdashboard.php?cat=Shoplist&name=Shops">Shops Lists</a>
                <a href="traderdashboard.php?cat=Addshop&name=Shops">Add Shops</a>
              </div>
            </div>
          </div>
          <!-- dropdown for orders -->
          <div class="category-link">
            <div
              class="dropdown"
              onmouseover="onMouse('orders')"
              onmouseout="outMouse('orders')"
            >
              <div class="dropdown-link">
                <span class="material-symbols-outlined">redeem</span>
                <h4>ORDERS</h4>
              </div>
              <p>▼</p>
            </div>
            <!-- list shops -->
            <div
              class="dropdown-content"
              id="orders"
              onmouseover="onMouse('orders')"
              onmouseout="outMouse('orders')"
            >
              <div>
                <a href="traderdashboard.php?cat=Orderlist&name=Orders">Order Lists</a>
                <a href="traderdashboard.php?cat=Orderhistory&name=Orders">Order History</a>
              </div>
            </div>
          </div>

          <div class="logout">
            <a href="#">LOGOUT</a>
          </div>
          <div id='result'></div>
        </div>
      </div>
    </div>

    <script>
      function onMouse(prop) {
        if (prop == "product") {
          document.getElementById("product").style.display = "block";
        }

        if (prop == "shop") {
          document.getElementById("shop").style.display = "block";
        }

        if (prop == "order") {
          document.getElementById("order").style.display = "block";
        }

        if (prop == "products") {
          document.getElementById("products").style.display = "block";
        }

        if (prop == "shops") {
          document.getElementById("shops").style.display = "block";
        }

        if (prop == "orders") {
          document.getElementById("orders").style.display = "block";
        }
        if (prop == "Profile") {
          document.getElementById("setting").style.display = "block";
        }
      }

      function outMouse(prop) {
        if (prop == "product") {
          document.getElementById("product").style.display = "none";
        }

        if (prop == "shop") {
          document.getElementById("shop").style.display = "none";
        }

        if (prop == "order") {
          document.getElementById("order").style.display = "none";
        }

        if (prop == "products") {
          document.getElementById("products").style.display = "none";
        }

        if (prop == "shops") {
          document.getElementById("shops").style.display = "none";
        }

        if (prop == "orders") {
          document.getElementById("orders").style.display = "none";
        }
        if (prop == "Profile") {
          document.getElementById("setting").style.display = "block";
        }
      }

    </script>

    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
      integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
      integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
