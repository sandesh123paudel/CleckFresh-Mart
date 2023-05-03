<!-- method one to add product in php -->
<form id="add-to-cart-form">
  <input type="hidden" name="product_id" value="1">
  <input type="number" name="quantity" value="1">
  <button type="submit" id="add-to-cart-btn">Add to Cart</button>
</form>

<script>
    $(document).ready(function() {
  $('#add-to-cart-form').submit(function(event) {
    event.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: 'add-to-cart.php',
      data: formData,
      success: function(response) {
        alert('Product added to cart successfully!');
      },
      error: function(xhr, status, error) {
        alert('An error occurred while adding the product to cart.');
      }
    });
  });
});
</script>

<?php
session_start();
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

// Add the product to the cart (e.g. using a session variable or a database)
$_SESSION['cart'][$product_id] = $quantity;

// Return a success message to the AJAX request
echo 'success';
?>