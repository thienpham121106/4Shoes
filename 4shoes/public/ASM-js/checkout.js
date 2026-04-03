window.addEventListener("DOMContentLoaded", function() {
  const cart = JSON.parse(localStorage.getItem("Cart")) || [];

  const productContainer = document.querySelector(".right-checkout .product-checkout");
  const tamTinhEl = document.querySelector(".tamtinh span");
  const shipEl = document.querySelector(".ship span");
  const totalEl = document.querySelector(".total .vnd span");
  const voucherInputs = document.querySelectorAll('input[name="voucher"]');

  const shippingFee = 30000;


  function renderCart() {
    const container = document.createElement("div");
    container.classList.add("products-list");

    if (cart.length === 0) {
      container.innerHTML = `<p>Giỏ hàng trống!</p>`;
      productContainer.replaceWith(container);
      return;
    }

    container.innerHTML = cart.map(item => `
      <div class="product-checkout">
        <img src="${item.image}" alt="">
        <div class="name-size">
          <p class="name">${item.name}</p>
          <p class="size">${item.size}</p>
        </div>
        <div class="price-quantity">
          <p>${(item.price * item.quantity).toLocaleString("vi-VN")}đ</p>
          <p>x${item.quantity}</p>
        </div>
      </div>
    `).join("");

 
    productContainer.replaceWith(container);
    updateTotal();
  }


  function updateTotal() {
    let subtotal = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
    let total = subtotal + shippingFee;

  
    const selectedVoucher = Array.from(voucherInputs).find(v => v.checked);
    if (selectedVoucher) {
      if (selectedVoucher.value === "GIAM50K" && subtotal > 300000) {
        total -= 50000;
      }
      if (selectedVoucher.value === "SALE10") {
        total -= Math.min(subtotal * 0.1, 70000);
      }
      if (selectedVoucher.value === "FREESHIP") {
        total -= shippingFee;
      }
    }

    tamTinhEl.textContent = subtotal.toLocaleString("vi-VN") + "đ";
    shipEl.textContent = shippingFee.toLocaleString("vi-VN") + "đ";
    totalEl.textContent = total.toLocaleString("vi-VN") + "đ";
  }


  voucherInputs.forEach(input => {
    input.addEventListener("change", () => {
   
      voucherInputs.forEach(v => {
        if (v !== input) v.checked = false;
      });
      updateTotal();
    });
  });


  const checkoutBtn = document.querySelector(".checkout-btn");
  checkoutBtn.addEventListener("click", () => {
    if (cart.length === 0) {
      alert("Giỏ hàng trống!");
      return;
    }
    alert("Thanh toán thành công!");
    localStorage.removeItem("Cart");
    window.location.href = "index.html"; 
  });

  
  renderCart();
});
