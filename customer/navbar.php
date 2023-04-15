<?php
  include('../db/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Navbar</title>

    <!-- bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp"
      crossorigin="anonymous"
    />
    <!-- fonts icons -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    />
    <link rel="stylesheet" href="css/nav.css" />
  </head>

  <body>
    <nav class="nav">
      <!-- logo -->
      <div class="logo">
        <a href="homepage.php"
          ><img src="../logo/logo.png" alt="logo" class="logo-img"
        /></a>
      </div>

      <!-- Menu -->
      <div class="menu" id="menu">
        <span
          class="material-symbols-outlined"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasWithBothOptions"
          aria-controls="offcanvasWithBothOptions"
        >
          menu
        </span>
      </div>

      <!-- search box -->
      <form class="search">
        <input
          type="text"
          id="lgsearch"
          placeholder="Search by Products and more..."
        />
        <input id="smsearch" type="text" placeholder="Search......." />
        <span class="material-symbols-outlined search-icon"> search </span>
      </form>

      <div class="links-container">
        <div class="links-btn">
          <a href="login.php">Login</a>
          <label
            onmouseover="onMouse('show')"
            onmouseout="outMouse('show')"
            id="signup-link"
            >Signup</label
          >
        </div>

        <div class="content">
          <!-- Cart -->
          <div>
            <b class="number">
              <!-- <?php
                            $number =0;
                            echo $number;
                        ?> -->0
            </b>
            <span class="material-symbols-outlined"> shopping_cart </span>
            <p class="icon">Cart</p>
          </div>

          <!-- Wishlist -->
          <div>
            <b class="number">
              <!-- <?php
                            $number =12;
                            echo $number;
                        ?> -->12
            </b>
            <span class="material-symbols-outlined"> favorite </span>

            <p class="icon">Wishlist</p>
          </div>

          <div>
            <img
              src="../logo/avtar.png"
              class="profile dropdown-toggle"
              type="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
              alt=""
            />
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Profile</a></li>
              <li><a class="dropdown-item" href="#">Setting</a></li>
              <li><a class="dropdown-item" href="#">Logout</a></li>
            </ul>
          </div>
        </div>
      </div>
    <div
      class="signup"
      id="show"
      onmouseover="onMouse('show')"
      onmouseout="outMouse('show')"
    >
      <a href="customerRegistration.php">Customer</a>
      <a href="traderRegistration.php">Trader</a>
    </div>

  
    

    <!-- Category -->
    <div class="category">
      <!-- 1st category -->
      <div class="category-link">
        <div
          class="dropdown"
          onmouseover="onMouse('butcher')"
          onmouseout="outMouse('butcher')"
        >
          <a href="#">Butcher</a>
          <p>▼</p>
        </div>
        <!-- list shops -->
        <div
          class="dropdown-content"
          id="butcher"
          onmouseover="onMouse('butcher')"
          onmouseout="outMouse('butcher')"
        >
          <div>
            <a href="#">Shop 1</a>
            <a href="#">Shop 2</a>
          </div>
        </div>
      </div>

      <!-- 2nd category -->
      <div class="category-link">
        <!-- trader -->
        <div
          class="dropdown"
          onmouseover="onMouse('green')"
          onmouseout="outMouse('green')"
        >
          <a href="#">GreenGrocer</a>
          <p>▼</p>
        </div>
        <!-- list shops -->
        <div
          class="dropdown-content"
          id="green"
          onmouseover="onMouse('green')"
          onmouseout="outMouse('green')"
        >
          <div>
            <a href="#">Shop 1</a>
            <a href="#">Shop 2</a>
          </div>
        </div>
      </div>

      <!-- 3rd category -->
      <div class="category-link">
        <!-- trader -->
        <div
          class="dropdown"
          onmouseover="onMouse('fish')"
          onmouseout="outMouse('fish')"
        >
          <a href="#">FishMonger</a>
          <p>▼</p>
        </div>
        <!-- list shops -->
        <div
          class="dropdown-content"
          id="fish"
          onmouseover="onMouse('fish')"
          onmouseout="outMouse('fish')"
        >
          <div>
            <a href="#">Shop 1</a>
            <a href="#">Shop 2</a>
          </div>
        </div>
      </div>

      <!-- 4th category -->
      <div class="category-link">
        <!-- trader -->
        <div
          class="dropdown"
          onmouseover="onMouse('backery')"
          onmouseout="outMouse('backery')"
        >
          <a href="#">Bakery</a>
          <p>▼</p>
        </div>
        <!-- list shops -->
        <div
          class="dropdown-content"
          id="backery"
          onmouseover="onMouse('backery')"
          onmouseout="outMouse('backery')"
        >
          <div>
            <a href="#">Shop 1</a>
            <a href="#">Shop 2</a>
          </div>
        </div>
      </div>

      <!-- 5th category -->
      <div class="category-link">
        <!-- trader -->
        <div
          class="dropdown"
          onmouseover="onMouse('delicates')"
          onmouseout="outMouse('delicates')"
        >
          <a href="#">Delicatessen</a>
          <p>▼</p>
        </div>
        <!-- list shops -->
        <div
          class="dropdown-content"
          id="delicates"
          onmouseover="onMouse('delicates')"
          onmouseout="outMouse('delicates')"
        >
          <div>
            <a href="#">Shop 1</a>
            <a href="#">Shop 2</a>
          </div>
        </div>
      </div>
    </div>

    <!-- off canvas -->
    <div
      class="offcanvas offcanvas-start"
      data-bs-scroll="true"
      tabindex="-1"
      id="offcanvasWithBothOptions"
      aria-labelledby="offcanvasWithBothOptionsLabel"
    >
      <div class="offcanvas-header">
        <a href="homepage.php"
          ><img src="../logo/logo.png" alt="logo" class="logo-img"
        /></a>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="offcanvas"
          aria-label="Close"
        ></button>
      </div>
      <div class="line"></div>
      <div class="offcanvas-body">
        <p>Try scrolling the rest of the page to see this option in action.</p>
      </div>
    </div>

    <!-- javascript -->
    <script>
      function onMouse(prop) {
        if (prop == "show") {
          document.getElementById("show").style.display = "block";
        }

        if (prop == "butcher") {
          document.getElementById("butcher").style.display = "block";
        }

        if (prop == "green") {
          document.getElementById("green").style.display = "block";
        }

        if (prop == "fish") {
          document.getElementById("fish").style.display = "block";
        }

        if (prop == "backery") {
          document.getElementById("backery").style.display = "block";
        }

        if (prop == "delicates") {
          document.getElementById("delicates").style.display = "block";
        }
        if (prop == "profile") {
          document.getElementById("profile").style.display = "block";
        }
      }

      function outMouse(prop) {
        if (prop == "show") {
          document.getElementById("show").style.display = "none";
        }

        if (prop == "butcher") {
          document.getElementById("butcher").style.display = "none";
        }

        if (prop == "green") {
          document.getElementById("green").style.display = "none";
        }

        if (prop == "fish") {
          document.getElementById("fish").style.display = "none";
        }

        if (prop == "backery") {
          document.getElementById("backery").style.display = "none";
        }

        if (prop == "delicates") {
          document.getElementById("delicates").style.display = "none";
        }
        if (prop == "profile") {
          document.getElementById("profile").style.display = "none";
        }
      }
      
    </script>
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
      integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js"
      integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
