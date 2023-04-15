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

      <div class="cart-items">
        <div class="cart-info">
          <h4>Shopping Cart</h4>
          <p>You have 3 items in your cart</p>
        </div>

        <div class="item-container">
          <div class="image">
            <img src="../logo/apple2.webp" alt="image" />
          </div>
          <div class="item-info">
            <h3>Chicken sausage</h3>
            <label>CleckFreshMart Chicken</label>
            <label>Sausage 600g</label>
          </div>
          <div class="qty">
            <h3>1</h3>
            <!-- icon -->
            <div class="qty-icon">
    
                <a href="#">
                  <span class="material-symbols-outlined"> arrow_drop_up </span>
                </a>
           
                <a href="#">
                  <span class="material-symbols-outlined"> arrow_drop_down </span>
             
                </a>
             
                
            </div>
          </div>
          <div class="price">&#163; 50</div>

          <div class="remove">
            <span class="material-symbols-outlined"> delete </span>
          </div>
        </div>
        <div class="item-container">
          <div class="image">
            <img src="../logo/apple2.webp" alt="image" />
          </div>
          <div class="item-info">
            <h3>Chicken sausage</h3>
            <label>CleckFreshMart Chicken</label>
            <label>Sausage 600g</label>
          </div>
          <div class="qty">
            <h3>1</h3>
            <!-- icon -->
            <div class="qty-icon">
    
                <span class="material-symbols-outlined"> arrow_drop_up </span>
           
             
                <span class="material-symbols-outlined"> arrow_drop_down </span>
             
            </div>
          </div>
          <div class="price">&#163; 50</div>

          <div class="remove">
            <span class="material-symbols-outlined"> delete </span>
          </div>
        </div>

        <div class="line"></div>

          <div class="total">
            <h3>Total Item (3 Items)</h3>
            <h3>&#163; 200</h3>
          </div>

          <div class="process">
            <h4>Process Payment</h4>
            <button>Process to Checkout</button>
          </div>
    </div>
  </body>
</html>
