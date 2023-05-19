<?php
session_start();
include('../db/connection.php');
if (isset($_SESSION['userID'])) {
  unset($_SESSION['cart']);
  unset($_SESSION['wishlist']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Navbar</title>

  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous" />
  <!-- fonts icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <!-- <link rel="stylesheet" href="css/nav.css" /> -->
  <link rel="stylesheet" href="css/index.css" />
  <!--jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="addremove.js"></script>

  <script>
    $(document).ready(function() {
      $("#searchproduct").click(function() {
        var product_name = $("#lgsearch").val();
        document.location.href = "products.php?p_name=" + product_name.toLowerCase() + "&search="+product_name;
      })
    })
  </script>
</head>

<body>
  <nav class="nav">
    <!-- logo -->
    <div class="logo">
      <a href="homepage.php"><img src="../assets/logo.png" alt="logo" class="logo-img" /></a>
    </div>

    <!-- Menu -->
    <div class="menu" id="menu">
      <span class="material-symbols-outlined" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
        menu
      </span>
    </div>

    <!-- search box -->
    <form class="search">
      <input type="text" id="lgsearch" placeholder="Search by Products and more..." />
      <input id="smsearch" type="text" placeholder="Search......." />
      <span class="material-symbols-outlined search-icon" id='searchproduct'> search </span>
    </form>

    <div class="links-container">
      <?php
      if (empty($_SESSION['token'])) {
        $par = 'show';
      ?>
        <div class='links-btn'>
          <a href='../login.php'>Login</a>
          <!-- Use htmlentities() to escape the label text and prevent XSS attacks -->
          <label onmouseover='onMouse("<?php echo htmlentities($par); ?>")' onmouseout='outMouse("<?php echo htmlentities($par); ?>")' id='signup-link'>Signup</label>
        </div>
      <?php
      } else {
        // Use a log-out button instead of an empty string to improve UX
        echo "";
      ?>

      <?php
      }
      ?>


      <div class="content">
        <!-- Cart -->
        <!-- <a href="cartpage.php"> -->
        <div onclick='cartfunction()'>
          <!-- <b class="number">
            <?php
            if (isset($_SESSION['cart'])) {
              echo count($_SESSION['cart']);
            }
            ?>
          </b> -->
          <span class="material-symbols-outlined"> shopping_cart </span>
          <p class="icon">Cart</p>
        </div>
        <!-- </a> -->

        <!-- Wishlist -->
        <!-- <a href="wishlist.php"> -->
        <div onclick='wishlistfunction()'>
          <!-- <b class="number">
            <?php
            if (isset($_SESSION['wishlist'])) {
              echo count($_SESSION['wishlist']);
            }
            ?>
          </b> -->
          <span class="material-symbols-outlined"> favorite </span>

          <p class="icon">Wishlist</p>
        </div>
        <!-- </a> -->

        <?php
        if (isset($_SESSION['token'])) {
          echo "
              <div>
                  <img
                    src='../assets/avtar.png'
                    class='avtar dropdown-toggle'
                    type='button'
                    data-bs-toggle='dropdown'
                    aria-expanded='false'
                    alt=''
                  />
                  <ul class='dropdown-menu'>
                    <li><a class='dropdown-item' href='profile.php?role=customer'>Profile</a></li>
                    <li><a class='dropdown-item' href='../db/logout.php?role=customer'>Logout</a></li>
                    </ul>
          </div> ";
        } else {
          echo "";
        }
        ?>

      </div>
    </div>
    <div class="signup" id="show" onmouseover="onMouse('show')" onmouseout="outMouse('show')">
      <a href="../customerRegistration.php">Customer</a>
      <a href="../traderRegistration.php">Trader</a>
    </div>




    <!-- Category -->
    <div class="category">
      <!-- 1st category -->
      <?php
      $sql = "SELECT * FROM CATEGORY";
      $stid = oci_parse($connection, $sql);
      oci_execute($stid);

      while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
        $c_id = $row['CATEGORY_ID'];
        $c_name = $row['CATEGORY_NAME'];

        echo "<a href='products.php?cat_id=$c_id'>
                        <label class='category-link'><p>" . $c_name . "</p><p>▼</p> </label> 
                    </a>";
      }
      ?>
    </div>


    <!-- off canvas -->
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
      <div class="offcanvas-header">
        <a href="homepage.php"><img src="../assets/logo.png" alt="logo" class="logo-img" /></a>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="line"></div>
      <div class="offcanvas-body">
        <!-- Off canvas part -->
        <?php
        if (empty($_SESSION['token'])) {
          echo "
            <div class='create'>
              <a href='../login.php'>Login</a>
              <label
                class='dropdown-toggle'
                type='button'
                data-bs-toggle='dropdown'
                aria-expanded='false'
                >Signup</label
              >
              <ul class='dropdown-menu'>
                <li><a class='dropdown-item' href='../customerRegistration.php'>Customer</a></li>
                <li><a class='dropdown-item' href='../traderRegistration.php'>Trader</a></li>
              </ul>
            </div>";
        } else {
          echo "";
        }
        ?>


        <?php
        if (isset($_SESSION['token'])) {
          echo "
            <div class='create'>
              <a href='profile.php?role=customer'>Profile</a>
              <a href='#'>Setting</a>
              <a href='../db/logout.php?role=customer'>Logout</a> 
            </div> ";
        } else {
          echo "";
        }
        ?>
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


      function cartfunction() {
        document.location.href = 'cartpage.php';
      }

      function wishlistfunction() {
        document.location.href = 'wishlist.php';
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>


</body>

</html>