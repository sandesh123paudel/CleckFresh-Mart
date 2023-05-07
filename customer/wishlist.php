<?php
include('../db/connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="css/carts.css" />
</head>

<body>

    <div class='nav-bar'>
        <?php
        require('navbar.php');
        ?>
    </div>

    <div class="cart-container">
        <div class="title">
            <span class="material-symbols-outlined">
                arrow_back_ios_new
            </span>
            <h3>Shopping Continue</h3>
        </div>
        <div class="line"></div>

        <div class="cart-info">
            <h4>My Wishlist (<?php
          if (isset($_SESSION['wishlist'])) {
            echo count($_SESSION['wishlist']);
          }
          else{
            echo '0';
          }
          ?> items)</h4>
            <p>You have <?php
          if (isset($_SESSION['wishlist'])) {
            echo count($_SESSION['wishlist']);
          }
          else{
            echo '0';
          }
          ?> items in your wishlist</p>
        </div>

        <div class="wishlist-container">

            <?php
            if (isset($_SESSION['wishlist'])) {

                foreach ($_SESSION['wishlist'] as $key => $value) {
                    $sql = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = :id";
                    $stid = oci_parse($connection, $sql);
                    oci_bind_by_name($stid, ":id", $value['product_id']);
                    oci_execute($stid);

                    while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
                        $product_id = $row['PRODUCT_ID'];

                        echo "
                    <div class='wishlist-item'>
                        <div class='img' >
                            <img src='../logo//apple2.webp' alt=''>
                            <div onclick='removewishlist($product_id)'> 
                                <span class='closebtn' >&times;</span>
                            </div>
                        </div>
                    
                        <h3>" . $row['PRODUCT_NAME'] . "</h3>
                        <h4> &pound; " . $row['PRODUCT_PRICE']  . "</h4>";
                        if (isset($_SESSION['userID'])) {
                            echo "<button  id='add' data-id='$product_id'>Add +</button>";
                        } else {
                            echo "<button  id='addcart' onclick='addcart($product_id,1)'>Add +</button>";
                        }
                        echo "</div>";
                    }
                }
            }
            ?>
                     
        </div>
    </div>

    <?php
    require('footer.php');
    ?>

    <script>
        function addcart(p_id, quantity) {
            var product_id = p_id;
            var quantity = quantity;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    alert(this.responseText); // replace 'this.responseText' with the actual response text from the server
                }
            };
            xmlhttp.open("GET", "insertremove.php?action=addcart&quantity=" + quantity + "&id=" + product_id, true);
            xmlhttp.send();
        }

        function removewishlist(p_id) {
            var product_id = p_id;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    alert(this.responseText); // replace 'this.responseText' with the actual response text from the server
                }
            };
            xmlhttp.open("GET", "insertremove.php?action=removewishlist&&id=" + product_id, true);
            xmlhttp.send();
        }
    </script>

</body>

</html>