window.addEventListener("DOMContentLoaded", function () {
  renderCart();

  function renderCart() {
    const cart = JSON.parse(localStorage.getItem("Cart")) || [];
    const leftCart = document.querySelector(".wrap");
    const totalPriceEl = document.querySelector(".right-cart .sub-total span");

    if (cart.length === 0) {
      leftCart.innerHTML = `<p style="text-align:center; color:red;">Giỏ hàng trống</p>`;
      totalPriceEl.textContent = "0đ";
      return;
    }

  
    let html = "";
    let totalPrice = 0;
    cart.forEach((item, index) => {
      const itemTotal = item.price * item.quantity;
      totalPrice += itemTotal;

      html += `
        <div class="left-cart">
          <div class="border-bottom">
            <div class="space">
              <div class="cart-product">
                <img src="${item.image}" alt="">
                <div class="infor-cart">
                  <p class="product-name">${item.name}</p>
                  <p class="size">Size: ${item.size}</p>
                  <div class="quantity">
                    <button class="minus" data-index="${index}">-</button>
                    <input type="text" value="${item.quantity}" readonly>
                    <button class="plus" data-index="${index}">+</button>
                  </div>
                  <p class="cart-price">${item.price.toLocaleString("vi-VN")}đ</p>
                </div>
              </div>
              <i class="fa-solid fa-trash" data-index="${index}"></i>
            </div>
            <p class="total">Thành tiền: <span>${itemTotal.toLocaleString("vi-VN")}đ</span></p>
          </div>
        </div>
      `;
    });

    leftCart.innerHTML = html;
    totalPriceEl.textContent = totalPrice.toLocaleString("vi-VN") + "đ";

  
    addCartEvents();
  }

  function addCartEvents() {
    const cart = JSON.parse(localStorage.getItem("Cart")) || [];

    document.querySelectorAll(".plus").forEach(btn => {
      btn.addEventListener("click", () => {
        const index = btn.dataset.index;
        cart[index].quantity++;
        localStorage.setItem("Cart", JSON.stringify(cart));
        renderCart();
        updateCartCount();
      });
    });

    document.querySelectorAll(".minus").forEach(btn => {
      btn.addEventListener("click", () => {
        const index = btn.dataset.index;
        if (cart[index].quantity > 1) {
          cart[index].quantity--;
        } else {
          if (confirm("Xóa sản phẩm này khỏi giỏ?")) {
            cart.splice(index, 1);
          }
        }
        localStorage.setItem("Cart", JSON.stringify(cart));
        renderCart();
        updateCartCount();
      });
    });

    document.querySelectorAll(".fa-trash").forEach(icon => {
      icon.addEventListener("click", () => {
        const index = icon.dataset.index;
        if (confirm("Bạn có chắc muốn xóa sản phẩm này?")) {
          cart.splice(index, 1);
          localStorage.setItem("Cart", JSON.stringify(cart));
          renderCart();
          updateCartCount();
        }
      });
    });
  }

function updateCartCount() {
  const cart = JSON.parse(localStorage.getItem("Cart")) || [];
  const cartCountEl = document.getElementById("cart-count");
  if (cartCountEl) {
    cartCountEl.textContent = cart.length; 
  }
}
  updateCartCount();
});

let viewCheckOut = () => {
  window.location.href = "checkout.html";
}
 
