<?php
//  session_start();
//  include("../db/connection.php");
 
//  if($_SESSION['userID']){
//   $sql = 'SELECT * FROM USER_I WHERE USER_ID= :id ';
//   $stid = oci_parse($connection,$sql);

//   oci_bind_by_name($stid,':id',$_SESSION['userID']);

//   oci_execute($stid);
  
//   $username='';
//   while($row = oci_fetch_array($stid,OCI_ASSOC)){
//     $username = $row['FIRST_NAME'];
//     $_SESSION['username'] = $username;
//   }
// }

  // if(empty($_SESSION['userID'])){
  //   echo "<script>
  //     alert('SESSION is EXPIRED Please Login!!!');
  //     document.location.href='../login.php';
  //     </script>";
  // }

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
    <link rel="stylesheet" href="css/overview.css" />
    
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
      crossorigin="anonymous"
    />

  </head>
  <body>

    <div class="admin-container">
        <div class="part1">
            <!-- logo -->
            <div class="logo">
                <a href="dashboard.php"><img src="../logo/logo.png" alt="logo" /></a>
            </div>
            <!-- side-links -->
            <div class="side-links">

                <div class="home-link">
                    <span class="material-symbols-outlined">home</span>
                    <a href="dashboard.php">Dashboard</a>
                </div>

                <div class="home-link">
                    <span class="material-symbols-outlined">person</span>
                    <a href="dashboard.php?cat=Traders">Traders</a>
                </div>

                <div class="category-link">
                    <div
                    class="dropdown"
                    onmouseover="onMouse('user')"
                    onmouseout="outMouse('user')"
                    >
                        <div class="dropdown-link">
                            <span class="material-symbols-outlined">group</span>
                            <h4>Users</h4>
                        </div>
                        <p>▼</p>
                        </div>
                        <!-- list shops -->
                        <div
                        class="dropdown-content"
                        id="user"
                        onmouseover="onMouse('user')"
                        onmouseout="outMouse('user')"
                        >
                        <div>
                            <a href="dashboard.php?name=Users&cat=Customers List">Customers Lists</a>
                            <a href="dashboard.php?name=Users&cat=Traders Lists">Traders Lists</a>
                        </div>
                    </div>
                </div>

                <div class="home-link">
                    <span class="material-symbols-outlined">shopping_bag</span>
                    <a href="dashboard.php?cat=Product Lists">Product Lists</a>
                </div>

                <div class="home-link">
                <span class="material-symbols-outlined">shopping_basket</span>
                    <a href="dashboard.php?cat=Cart Lists">Cart List</a>
                </div>

                <div class="home-link">
                    <span class="material-symbols-outlined">favorite</span>
                    <a href="dashboard.php?cat=Wish Lists">Wish List</a>
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
                if(isset($_GET['cat'])){
                  $links = $_GET['cat'];
                  echo  $links;                  
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

                //   echo $_SESSION['username']; 
                echo "ADMIN";
                ?> </h3>              
            <div>
              <ul class="dropdown-menu setting">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li>
                <label class="dropdown-item dropdown-toggle" 
                  onmouseover="onMouse('Profile')"
                  onmouseout="outMouse('Profile')" 
                  data-bs-toggle="dropdown"
                  aria-expanded="false">Setting</label>
                <div>
                  <ul class="dropdown-menu" id='setting'>
                    <li><a class="dropdown-item" href="#">Update Profile</a></li>
                    <li><a class="dropdown-item" href="#">Deactivate</a></li>
                    <li><a class="dropdown-item" href="#">Activate</a></li>
                  </ul>
                </div>
              </li>
              </ul>
            </div>

          </div>
        </div>
        <!-- content import pages -->
        <div class="content">
          <!-- content for other pages -->
          <?php
            if(isset($_GET['cat'])){
              $links = $_GET['cat'];
              
              if($links == "Traders"){
                require('traders.php');
              }
              if($links == "Customers List"){
                require('customerlist.php');
              }
              if($links == "Traders Lists"){
                require('traderlist.php');
              }
              if($links == "Product Lists"){
                require('productslist.php');
              }
              if($links == "Cart List"){
                require('cartlists.php');
              }
              if($links == "Wish List"){
                require('wishlist.php');
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
              <a href="dashboard.php">Dashboard</a>
          </div>

          <div class="home-link">
              <span class="material-symbols-outlined">person</span>
              <a href="dashboard.php?cat=Traders">Traders</a>
          </div>

            <div class="category-link">
              <div
                class="dropdown"
                onmouseover="onMouse('users')"
                onmouseout="outMouse('users')"
              >
                  <div class="dropdown-link">
                      <span class="material-symbols-outlined">group</span>
                      <h4>Users</h4>
                  </div>
                    <p>▼</p>
              </div>
                  <!-- list shops -->
                  <div
                    class="dropdown-content"
                    id="users"
                    onmouseover="onMouse('users')"
                    onmouseout="outMouse('users')"
                    >
                    <div>
                        <a href="dashboard.php?name=Users&cat=Customers List">Customers Lists</a>
                        <a href="dashboard.php?name=Users&cat=Traders Lists">Traders Lists</a>
                    </div>
              </div>
            </div>

          <div class="home-link">
              <span class="material-symbols-outlined">shopping_bag</span>
              <a href="dashboard.php?cat=Product Lists">Product Lists</a>
          </div>

          <div class="home-link">
          <span class="material-symbols-outlined">shopping_basket</span>
              <a href="dashboard.php?cat=Cart Lists">Cart List</a>
          </div>

          <div class="home-link">
              <span class="material-symbols-outlined">favorite</span>
              <a href="dashboard.php?cat=Wish Lists">Wish List</a>
          </div>

          <div class="logout">
              <a href="../db/logout.php">LOGOUT</a>
          </div>
        </div>
      </div>
    </div>

    <script>
      function onMouse(prop) {
        if (prop == "user") {
          document.getElementById("user").style.display = "block";
        }
        if (prop == "users") {
          document.getElementById("users").style.display = "block";
        }
        if (prop == "Profile") {
          document.getElementById("setting").style.display = "block";
        }
      }

      function outMouse(prop) {
        if (prop == "user") {
          document.getElementById("user").style.display = "none";
        }
        if (prop == "users") {
          document.getElementById("users").style.display = "none";
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
