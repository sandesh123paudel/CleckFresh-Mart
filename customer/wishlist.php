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
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    />
    <link rel="stylesheet" href="css/car.css" />
  </head>
  <body>
    <div class="cart-container">
        <div class="title">
            <span class="material-symbols-outlined">
                arrow_back_ios_new
                </span>
            <h3>Shopping Continue</h3>
          </div>
          <div class="line"></div>
          
          <div class="cart-info">
            <h4>My Wishlist (4 items)</h4>
            <!-- <p>You have 3 items in your wishlist</p> -->
          </div>

          <div class="wishlist-container">
                <div class="wishlist-item">
                    <img src="../logo//apple2.webp" alt="">
                    <h3>CleckFreshMart</h3>
                    <h4>Apple 240g</h4>
                    <button>Add to basket</button>
                    <button id="remove">Remove</button>
                </div>

                <div class="wishlist-item">
                    <img src="../logo//apple2.webp" alt="">
                    <h3>CleckFreshMart</h3>
                    <h4>Apple 240g</h4>
                    <button>Add to basket</button>
                    <button id="remove">Remove</button>
                </div>
          </div>
    </div>
  </body>
</html>
