<style>
/* Giữ nguyên CSS cũ của bạn */
    .product-container { width: 80%; display: flex; margin: 50px auto; font-family: 'Segoe UI', sans-serif; }
    .main-product-image { width: 440px; height: 440px; margin-left: 20px; object-fit: cover; }
    .left-detail { display: flex; width: 40%; }
    .right-detail { flex-wrap: wrap; display: flex; flex-direction: column; margin-left: 90px; width: 47%; }
    .name-detail { font-size: 24px; font-weight: bold; margin: 0 0 8px 0; }
    .detail-price { font-size: 23px; display: flex; gap: 15px; align-items: center; margin-bottom: 20px; }
    .sale { display: flex; justify-content: center; font-size: 15px; color:red; margin: 0; background-color: #f0f0f0; padding: 5px 10px; border-radius: 4px; }
    .old-price { text-decoration: line-through; color: gray; margin: 0; font-size: 18px; }
    .current-price { font-weight: bold; margin: 0; color: #d0011b; font-size: 24px; }
    
    /* SIZE */
    .detail-size { margin-top: 10px; display: flex; gap: 40px; align-items: center; }
    .shoe-size { display: flex; gap: 10px; }
    .shoe-size input[type="radio"] { display: none; }
    .shoe-size label { font-size: 14px; border: 1px solid #ddd; padding: 8px 15px; border-radius: 4px; cursor: pointer; transition: 0.2s; min-width: 30px; text-align: center; }
    .shoe-size label:hover { border-color: #333; }
    .shoe-size input[type="radio"]:checked + label { background-color: #333; color: white; border-color: #333; }

    /* QUANTITY & BUTTON */
    .detail-quantity { padding-top: 20px; border-top: 1px solid #eee; margin-top: 20px; display: flex; gap: 20px; align-items: center; }
    .change-quantity-detail { display: flex; align-items: center; }
    .change-quantity-detail button { width: 40px; height: 40px; border: 1px solid #ddd; background-color: #f9f9f9; cursor: pointer; font-weight: bold; font-size: 16px; transition: 0.2s; }
    .change-quantity-detail button:hover { background-color: #eee; }
    .change-quantity-detail input { width: 50px; height: 36px; text-align: center; border: 1px solid #ddd; border-left: none; border-right: none; font-weight: bold; font-size: 16px; outline: none; }
    
    .add-to-cart { padding: 0 30px; height: 50px; font-size: 16px; border: none; color: white; background-color: #ee4d2d; font-weight: bold; flex: 1; cursor: pointer; transition: 0.3s; border-radius: 4px; text-transform: uppercase; }
    .add-to-cart:hover { background-color: #d73211; }

    /* INFO & FOOTER */
    .detail-note { display: flex; flex-direction: column; gap: 15px; margin-top: 20px; color: #555; font-size: 14px; }
    .endow, .shipping, .call { display: flex; align-items: center; gap: 15px; }
    .endow i, .shipping i, .call i { font-size: 20px; color: #888; width: 25px; text-align: center; }
    hr { border: none; height: 1px; background-color: #ddd; margin: 40px auto; width: 97%; }
    .container-image { display: flex; width: 100%; height: 200px; gap: 5px; margin-top: 20px; }
    .container-image img { width: 100%; height: 100%; object-fit: cover; }
</style>

<div class="product-container">
    <div class="left-detail">
        <img class="main-product-image" src="../public/ASM-js/images/index-product/<?= $sp_detail['image'] ?>" alt="<?= $sp_detail['name'] ?>">
    </div>

    <div class="right-detail">
        <p class="name-detail"><?= $sp_detail['name'] ?></p>
        
        <div class="detail-price">
            <p class="sale">-10%</p>
            <p class="old-price">2.500.000đ</p>
            <p class="current-price"><?= number_format($sp_detail['price'], 0, ',', '.') ?>đ</p>
        </div>

        <form action="index.php?page=addtocart&id=<?= $sp_detail['id'] ?>" method="POST" style="width: 100%;">
            
            <div class="detail-size">
                <p style="font-weight: bold;">SIZE:</p>
                <div class="shoe-size">
                    <label><input type="radio" name="shoe-size" value="38">38</label>
                    <label><input type="radio" name="shoe-size" value="39">39</label>
                    <label><input type="radio" name="shoe-size" value="40" checked>40</label>
                    <label><input type="radio" name="shoe-size" value="41">41</label>
                    <label><input type="radio" name="shoe-size" value="42">42</label>
                </div>
            </div>

            <div class="detail-quantity">
                <div class="change-quantity-detail">
                    <button type="button" onclick="decreaseQty()">-</button>
                    <input type="number" name="quantity" id="qtyInput" value="1" min="1" readonly>
                    <button type="button" onclick="increaseQty()">+</button>
                </div>
                
                <button type="submit" class="add-to-cart">
                    <i class="fa-solid fa-cart-shopping"></i> THÊM VÀO GIỎ
                </button>
            </div>
        </form>

        <div class="detail-note">
            <p class="detail-status" style="color: #dea455; font-weight: bold; font-size: 16px;">🔥 Đã bán gần hết</p>
            <div class="endow">
                <i class="fa-solid fa-gift"></i>
                <p>Tặng kèm vớ dệt kim cao cấp khi mua giày</p>
            </div>
            <div class="shipping">
                <i class="fa-solid fa-truck-fast"></i>
                <div>
                    <p>Giao hàng dự kiến:</p>
                    <strong>Thứ 2 - Thứ 6 từ 9h00 - 17h00</strong>
                </div>
            </div>
            <div class="call">
                <i class="fa-solid fa-phone-volume"></i>
                <div>
                    <p>Hỗ trợ 24/7</p>
                    <p>Hotline: 0987.654.321</p>
                </div>
            </div>
        </div>
    </div>
</div>

<hr>
<div class="container-image">
    <img src="../public/ASM-js/images/ft1.jpg" alt="">
    <img src="../public/ASM-js/images/ft2.jpg" alt="">
    <img src="../public/ASM-js/images/ft3.jpg" alt="">
    <img src="../public/ASM-js/images/ft4.jpg" alt="">
    <img src="../public/ASM-js/images/ft5.jpg" alt="">
    <img src="../public/ASM-js/images/ft6.jpg" alt="">
</div>

<script>
    function increaseQty() {
        let input = document.getElementById('qtyInput');
        let currentValue = parseInt(input.value);
        input.value = currentValue + 1;
    }

    function decreaseQty() {
        let input = document.getElementById('qtyInput');
        let currentValue = parseInt(input.value);
        if (currentValue > 1) {
            input.value = currentValue - 1;
        }
    }
</script>
<?php if(isset($_SESSION['success_msg'])): ?>
    <script>
        Swal.fire({
            title: 'Thành công!',
            text: '<?= $_SESSION['success_msg'] ?>',
            icon: 'success',           // Đây chính là dấu tích xanh (tick)
            confirmButtonText: 'OK',
            confirmButtonColor: '#ee4d2d', // Màu cam giống nút mua hàng của bạn
            timer: 3000,               // Tự tắt sau 3 giây
            timerProgressBar: true
        });
    </script>
    <?php unset($_SESSION['success_msg']); // Xóa session để không hiện lại khi f5 ?>
<?php endif; ?>