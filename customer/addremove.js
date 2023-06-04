// this function for storing data in session for temporart
function addcart(p_id, quantity) {
  var product_id = p_id;
  var quantity = quantity;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      window.location.reload();
      // alert(this.responseText); // replace 'this.responseText' with the actual response text from the server
    }
  };
  xmlhttp.open(
    "GET",
    "insertremove.php?action=addcart&quantity=" +
      quantity +
      "&id=" +
      product_id,
    true
  );
  xmlhttp.send();
}

// remove from cart
function removecart(p_id) {
  var product_id = p_id;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      window.location.reload();
      // alert(this.responseText); // replace 'this.responseText' with the actual response text from the server
    }
  };
  xmlhttp.open(
    "GET",
    "insertremove.php?action=removecart&id=" + product_id,
    true
  );
  xmlhttp.send();
}

// update cart
function addupdatecart(product_id, quantity) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      window.location.reload();
      // alert(this.responseText); // replace 'this.responseText' with the actual response text from the server
    }
  };
  xmlhttp.open(
    "GET",
    "insertremove.php?action=addupdatecart&id=" +
      product_id +
      "&quantity=" +
      quantity,
    true
  );
  xmlhttp.send();
}

function removeupdatecart(product_id, quantity) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      window.location.reload();
      // alert(this.responseText); // replace 'this.responseText' with the actual response text from the server
    }
  };
  xmlhttp.open(
    "GET",
    "insertremove.php?action=removeupdatecart&id=" +
      product_id +
      "&quantity=" +
      quantity,
    true
  );
  xmlhttp.send();
}

// working with wishlist
function addwishlist(p_id) {
  var product_id = p_id;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      window.location.reload();
      // alert(this.responseText); // replace 'this.responseText' with the actual response text from the server
    }
  };
  xmlhttp.open(
    "GET",
    "insertremove.php?action=addwishlist&id=" + product_id,
    true
  );
  xmlhttp.send();
}

// remove from session
function removewishlist(p_id) {
  var product_id = p_id;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      window.location.reload();
      // alert(this.responseText); // replace 'this.responseText' with the actual response text from the server
    }
  };
  xmlhttp.open(
    "GET",
    "insertremove.php?action=removewishlist&id=" + product_id,
    true
  );
  xmlhttp.send();
}

// working with database
// this function is used for storing in database
// worked successfully
function addtocart(p_id, quantity) {
  var product_id = p_id;
  var quantity = quantity;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      window.location.reload();
      // alert(this.responseText); // replace 'this.responseText' with the actual response text from the server
    }
  };
  xmlhttp.open(
    "GET",
    "dbaddremove.php?action=addcart&quantity=" + quantity + "&id=" + product_id,
    true
  );
  xmlhttp.send();
}

// worked successfully
function addtowishlist(p_id) {
  var product_id = p_id;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // window.location.reload();
      alert(this.responseText); // replace 'this.responseText' with the actual response text from the server
    }
  };
  xmlhttp.open(
    "GET",
    "dbaddremove.php?action=addwishlist&id=" + product_id,
    true
  );
  xmlhttp.send();
}

// remove from database worked successfully
function removewishlistdb(p_id) {
  var product_id = p_id;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      window.location.reload();
      // alert(this.responseText); // replace 'this.responseText' with the actual response text from the server
    }
  };
  xmlhttp.open(
    "GET",
    "dbaddremove.php?action=removewishlist&id=" + product_id,
    true
  );
  xmlhttp.send();
}

function removecartdb(p_id) {
  var product_id = p_id;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      window.location.reload();
      // alert(this.responseText); // replace 'this.responseText' with the actual response text from the server
    }
  };
  xmlhttp.open(
    "GET",
    "dbaddremove.php?action=removecart&id=" + product_id,
    true
  );
  xmlhttp.send();
}

// update cart
function addupdatetocart(product_id, quantity) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      window.location.reload();
      // alert(this.responseText); // replace 'this.responseText' with the actual response text from the server
    }
  };
  xmlhttp.open(
    "GET",
    "dbaddremove.php?action=addupdatecart&id=" +
      product_id +
      "&quantity=" +
      quantity,
    true
  );
  xmlhttp.send();
}

function removeupdatetocart(product_id, quantity) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      window.location.reload();
      // alert(this.responseText); // replace 'this.responseText' with the actual response text from the server
    }
  };
  xmlhttp.open(
    "GET",
    "dbaddremove.php?action=removeupdatecart&id=" +
      product_id +
      "&quantity=" +
      quantity,
    true
  );
  xmlhttp.send();
}
