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
    <link rel="stylesheet" href="css/na.css" />
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
          <a href="../login.php">Login</a>
          <label
            onmouseover="onMouse('show')"
            onmouseout="outMouse('show')"
            id="signup-link"
            >Signup</label
          >
        </div>

        <div class="content">
          <!-- Cart -->
          <a href="cartpage.php">
            <div>
              <b class="number">
                <?php
                              $number =0;
                              echo $number;
                          ?>
              </b>
              <span class="material-symbols-outlined"> shopping_cart </span>
              <p class="icon">Cart</p>
            </div>
          </a>

          <!-- Wishlist -->
          <a href="wishlist.php">
            <div>
              <b class="number">
                <?php
                              $number =12;
                              echo $number;
                          ?>
              </b>
              <span class="material-symbols-outlined"> favorite </span>

              <p class="icon">Wishlist</p>
            </div>
          </a>

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
      <a href="../customerRegistration.php">Customer</a>
      <a href="../traderRegistration.php">Trader</a>
    </div>

  
    

    <!-- Category -->
    <div class="category">
        <!-- 1st category -->
        <?php
            $sql = "SELECT * FROM CATEGORY";
            $stid = oci_parse($connection,$sql);
            oci_execute($stid);
            
            while($row = oci_fetch_array($stid,OCI_ASSOC)){
                $c_id = $row['CATEGORY_ID'];
                $c_name = $row['CATEGORY_NAME'];
  
               echo "<a href='products.php?cat_id=$c_id'>
                        <label class='category-link'><p>".$c_name."</p><p>▼</p> </label> 
                    </a>";
            }
        ?>
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
    <!-- Off canvas part -->
        <div class='create'>
            <a href="../login.php">Login</a>
            <label
              class="dropdown-toggle"
              type="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
              >Signup</label
            >
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="../customerRegistration.php">Customer</a></li>
              <li><a class="dropdown-item" href="../traderRegistration.php">Trader</a></li>
            </ul>
          </div>

        <div class='profile-links' id='link-show'>
             <a class="dropdown-item" href="../profile.php">Profile</a>
              <a class="dropdown-item" href="#">Setting</a>
              <a class="dropdown-item" href="#">Logout</a>
            
          </div>
      </div>
    </div>

    <!-- javascript -->
    <script>
      function onMouse(prop) {
        if (prop == "show") {
          document.getElementById("show").style.display = "block";
        }
        if (prop == "profile") {
          document.getElementById("profile").style.display = "block";
        }
      }

      function outMouse(prop) {
        if (prop == "show") {
          document.getElementById("show").style.display = "none";
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
