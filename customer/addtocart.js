var cart = [];
var wishlist = [];

function addtocart(id) {
  if(localStorage.getItem('cartItem')){
    cart.push(localStorage.getItem('cartItem'));
  }
  else{
    cart.push(id);
  }
 
  displaycart();
}

function delElementcart(id) {
  cart.splice(id, 1);
  displaycart();
}

function addtowhishlist(id) {
  if(localStorage.getItem('wishlistItem')){
    wishlist.push(localStorage.getItem('wishlistItem'));
  }
  else{
    wishlist.push(id);
  }
  
  displaywishlist();
}

function delElementwhishlist(id) {
    wishlist.splice(id, 1);
  displaywishlist();
}

function displaycart() {
  var total = 0;
  localStorage.setItem("cartItem", cart);
  localStorage.setItem("cartcount", cart.length);
  document.getElementById("countcart").innerHTML = localStorage.getItem("cartcount");
  if (cart.length == 0) {
    document.getElementById("titlecart").innerHTML = "Your cart is empty";
    document.getElementById("totalprice").innerHTML = "$" + 0 + ".00";
  }
}

function displaywishlist() {
  localStorage.setItem("wishlistItem", wishlist);
  localStorage.setItem("wishlistcount", wishlist.length);
  document.getElementById("countwishlist").innerHTML =localStorage.getItem("wishlistcount");
  if (wishlist.length == 0) {
    document.getElementById("titlecart").innerHTML = "Your cart is empty";
  }
}
