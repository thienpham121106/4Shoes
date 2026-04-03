window.addEventListener("DOMContentLoaded", function () {
  const params = new URLSearchParams(window.location.search);
  const id = params.get("id");

  const allProducts = JSON.parse(localStorage.getItem("allProducts")) || [];

  const product = allProducts.find(p => p.id == id);

  if (product) {
    const mainImg = document.querySelector(".main-product-image");
    mainImg.src = product.image;

    const miniContainer = document.querySelector(".mini-product");
    miniContainer.innerHTML = product.mini
      .map(img => `<img src="${img}" alt="">`)
      .join("");

    const miniImages = miniContainer.querySelectorAll("img");
    miniImages.forEach(img => {
      img.addEventListener("click", () => {
        mainImg.src = img.src;
      });
    });

    document.querySelector(".name-detail").textContent = product.name;

    const oldPrice = document.querySelector(".old-price");
    const currentPrice = document.querySelector(".current-price");
    oldPrice.textContent = product.oldPrice.toLocaleString("vi-VN") + "đ";
    currentPrice.textContent = product.price.toLocaleString("vi-VN") + "đ";

    const salePercent = Math.round(
      ((product.oldPrice - product.price) / product.oldPrice) * 100
    );
    document.querySelector(".sale").textContent = `-${salePercent}%`;
  } else {
    document.querySelector(".product-container").innerHTML = `
      <h2 style="text-align:center; color:red;">Sản phẩm không tồn tại!</h2>
    `;
  }

  function updateCartCount() {
    const cart = JSON.parse(localStorage.getItem("Cart")) || [];
    const cartCountEl = document.getElementById("cart-count");
    if (cartCountEl) {
      cartCountEl.textContent = cart.length; 
    }
  }

  updateCartCount();

  const quantityContainer = document.querySelector(".change-quantity-detail");
  if (quantityContainer) {
    const minusBtn = quantityContainer.querySelector("button:first-child");
    const plusBtn = quantityContainer.querySelector("button:last-child");
    const quantityInput = quantityContainer.querySelector("input");

    minusBtn.addEventListener("click", () => {
      let current = parseInt(quantityInput.value);
      if (current > 1) {
        quantityInput.value = current - 1;
      }
    });

    plusBtn.addEventListener("click", () => {
      let current = parseInt(quantityInput.value);
      quantityInput.value = current + 1;
    });
  }

  const addToCartBtn = document.querySelector(".add-to-cart");
  addToCartBtn.addEventListener("click", () => {
    const size = document.querySelector('input[name="shoe-size"]:checked');
    if (!size) {
      alert("Vui lòng chọn size giày!");
      return;
    }

    const quantity = parseInt(
      document.querySelector(".change-quantity-detail input").value
    );

    const cart = JSON.parse(localStorage.getItem("Cart")) || [];

    const existing = cart.find(
      item => item.id === product.id && item.size === size.value
    );

    if (existing) {
      existing.quantity += quantity;
    } else {
      cart.push({
        id: product.id,
        name: product.name,
        price: product.price,
        image: product.image,
        size: size.value,
        quantity: quantity,
      });
    }

    localStorage.setItem("Cart", JSON.stringify(cart));
    updateCartCount();
    alert("Đã thêm sản phẩm vào giỏ hàng!");
  });

  document.getElementById("cart-icon").addEventListener("click", () => {
    window.location.href = "cart.html";
  });
});
