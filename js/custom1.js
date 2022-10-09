function cb_check(){

  var cb_class = document.getElementsByClassName("cb_class");
  var subtotal = document.getElementsByClassName("subtotal");
  var quantity = document.getElementsByClassName("input-qty");
  var price = document.getElementsByClassName("price");
   for(i =0; i<cb_class;i++){
      subtotal[i].innerText = (price[i].innerText)*(quantity[i].innerText);

   }
}