function addcart(p_id, quantity) {
  var product_id = p_id;
  var quantity = quantity;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          alert(this.responseText); // replace 'this.responseText' with the actual response text from the server
      }
  };
  xmlhttp.open("GET", "insertremove.php?action=addcart&quantity="+quantity+"&id=" + product_id, true);
  xmlhttp.send();
}

