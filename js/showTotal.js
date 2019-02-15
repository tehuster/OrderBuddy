window.onload = () => {
   //console.log('showTotal init..');

   const htmlElements = document.getElementsByClassName('amount');
   const prices = document.getElementsByClassName('order_price');
   const totalPrices = document.getElementsByClassName('order_totalprice');
   const totalPrice = document.getElementById('totalprice');

   const orderAmounts = [...htmlElements];

   for (const [index, value] of orderAmounts.entries()) {
      value.addEventListener('change', () => {
         calculateSubTotal(index, value.value);
         calculateTotal();
      });
   }
   function calculateSubTotal(index, amount) {
      totalPrices[index].innerHTML = amount * prices[index].innerHTML;
   }

   function calculateTotal() {
      let total = 0;
      for (price of totalPrices) {
         total += price.innerHTML * 1;
      }
      totalPrice.innerHTML = total;
   }
};
