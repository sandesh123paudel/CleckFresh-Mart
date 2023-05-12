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
    <link rel="stylesheet" href="css/checkouts.css" />
  </head>
  <body>
    <form method="post" class="payment">
      <h3>Payment</h3>
      <h4>Payment Type</h4>
      <img src="../assets/paypal.png" alt="" />

      <div class="input-box">
        <label>Email</label>
        <input type="email" placeholder="Email" />
      </div>

      <div class="input-box">
        <label>Password</label>
        <input type="password" placeholder="Password" required />
      </div>
      <div class="line"></div>

      <h4>Subtotal</h4>
      <div class="total">
        <h4>Total (Tax incl.)</h4>
        <h4>&#163; 230</h4>
      </div>
      <input type="submit" name="pay" value="Pay Now" class="pay-btn" required />
    </form>
  </body>
</html>
