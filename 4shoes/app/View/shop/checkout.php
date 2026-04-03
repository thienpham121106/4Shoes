<style>
    h2 {
    margin: 0;
    margin-top: 15px;
    margin-bottom: 10px;
}
.container-checkout {
    height: 100vh;
    margin: 0 auto;
    display: flex;
    width: 80%;
}
.link {
    display: flex;
    gap: 15px;
    align-items: center;
    font-size: 14px;
    margin: 0;
}
.link a {
    color: black;
    margin: 0;
    text-decoration: none;
}
.ttgiaohang {
    font-weight: bold;
    font-size: 20px;
    margin: 0;
    margin-bottom: 15px;
}
.email-phone {
    display: flex;
    width: 100%;
    gap: 20px;
}
.form-info {
    margin-top:15px ;
    display: flex;
    flex-direction: column;
    width: 70%;
    gap: 20px;
}
.form-info input {
    
    padding: 15px 10px;
}
.left-checkout {
    width: 50%;
}
.email {
    width: 65%;
}
.form-info select, textarea {
    padding: 15px 10px;
}

.right-checkout {
    border-left: 1px solid lightgray;
    width: 50%;
    display: flex;
    flex-direction: column;
    background-color: #fafbfa;
}

.product-checkout {
    margin: 0 auto;
    margin: 0;
    gap: 15px;
    display: flex;
    align-items: center;
    width: 90%;
    border-bottom: 1px solid lightgray;
    padding: 10px;
    margin-left: 11px;
}
.product-checkout img {
    width: 80px;
    height: 80px;
}

.voucher {
      padding: 15px;
      display: flex;
      flex-direction: column;
      gap: 10px;
    width: 90%;
    border-bottom: 1px solid lightgray;
    padding: 10px;
    margin-left: 11px;
    }
    .voucher-item {
      display: flex;
      align-items: center;
      gap: 10px;
      background: white;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 10px;
    }
    .voucher-item input {
      width: 18px;
      height: 18px;
    }
    .voucher-info {
      display: flex;
      flex-direction: column;
    }
    .voucher-code {
      font-weight: bold;
      font-size: 14px;
    }
    .voucher-desc {
      font-size: 13px;
      color: #555;
    }
    .container-tamtinh {
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        width: 90%;
        border-bottom: 1px solid lightgray;
        padding: 10px;
        margin-left: 11px;
    }
    .tamtinh {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .tamtinh p {
        color: gray;
        margin: 0;
         margin-top: 10px;
    }

    .ship {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .ship p {
        color: gray;
    }
    .total {
        align-items: center;
        width: 90%;
        margin: 0 auto;
        display: flex;
        margin-left: 20px;
        justify-content: space-between;
    }
    .sub-total {
        font-size: 20px;
    }
    .vnd {
        font-size: 14px;
        color: gray;
    }
    .vnd span {
        color: black;
        font-size: 20px;
        margin-left: 10px;
    }
    .checkout-btn {
    width: 100%; /* Chiếm hết chiều ngang của cột phải */
    padding: 15px; /* Tăng độ dày nút cho dễ bấm */
    margin-top: 25px; /* Cách phần trên ra một chút */
    margin-left: 0; /* XÓA BỎ MARGIN-LEFT CŨ GÂY LỆCH */
    
    background-color: #ee4d2d; /* Màu cam Shopee */
    color: white;
    font-weight: 800; /* Chữ đậm hơn */
    font-size: 18px; /* Chữ to hơn */
    border: none;
    border-radius: 4px; /* Bo góc nhẹ */
    cursor: pointer;
    transition: 0.3s;
    text-transform: uppercase; /* Chữ in hoa */
    box-shadow: 0 4px 6px rgba(238, 77, 45, 0.2); /* Đổ bóng nhẹ */
}

.checkout-btn:hover {
    background-color: #d73211; /* Màu đậm hơn khi di chuột */
    transform: translateY(-2px); /* Hiệu ứng nổi lên */
}




    </style>
<form action="index.php?page=confirm_order" method="POST">
    <div class="container-checkout">
        
        <div class="left-checkout">
            <h2 style="color: #ee4d2d;">NEO SPORT</h2>
            
            <div class="link">
                <a href="index.php?page=cart">Giỏ hàng</a> <span>></span> <a href="#" style="font-weight: bold;">Thông tin giao hàng</a>
            </div>
            <p class="ttgiaohang">THÔNG TIN GIAO HÀNG</p>

            <div class="form-info">
                <input type="text" name="user_name" placeholder="Họ và tên" required value="<?= isset($_SESSION['user']) ? $_SESSION['user']['name'] : '' ?>">
                <div class="email-phone">
                    <input class="email" type="email" name="email" placeholder="Email" value="<?= isset($_SESSION['user']) ? $_SESSION['user']['email'] : '' ?>">
                    <input type="text" name="phone" placeholder="Số điện thoại" required style="width: 100%;" value="<?= isset($_SESSION['user']) ? $_SESSION['user']['phone'] : '' ?>">
                </div>
                <input type="text" name="address" placeholder="Địa chỉ" required>
                <select name="city">
                    <option value="">Chọn tỉnh / thành phố</option>
                    <option value="Hà Nội">Hà Nội</option>
                    <option value="Hồ Chí Minh">Hồ Chí Minh</option>
                    <option value="Đà Nẵng">Đà Nẵng</option>
                    <option value="Khác">Khác</option>
                </select>
                <textarea name="note" rows="3" placeholder="Ghi chú (tùy chọn)"></textarea>
            </div>
        </div>

        <div class="right-checkout">
            
            <div class="products-list" style="max-height: 250px; overflow-y: auto; margin-bottom: 20px; padding-right: 5px;">
                <?php 
                    $total_cart = 0;
                    if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])):
                        foreach($_SESSION['cart'] as $item):
                            $thanhtien = $item['price'] * $item['quantity'];
                            $total_cart += $thanhtien;
                ?>
                <div class="product-checkout" style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                    <div style="position: relative;">
                        <img src="../public/ASM-js/images/index-product/<?= $item['image'] ?>" alt="" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px; border: 1px solid #ddd;">
                        <span style="position: absolute; top: -5px; right: -5px; background: #888; color: white; border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; font-size: 11px;">
                            <?= $item['quantity'] ?>
                        </span>
                    </div>
                    <div style="flex: 1;">
                        <p style="font-weight: 600; font-size: 14px; margin: 0;"><?= $item['name'] ?></p>
                        <p style="font-size: 12px; color: #888; margin: 5px 0 0 0;">Size: 40</p>
                    </div>
                    <p style="font-weight: 600; font-size: 14px;"><?= number_format($thanhtien, 0, ',', '.') ?>₫</p>
                </div>
                <?php endforeach; endif; ?>
            </div>

            <div class="checkout-box" style="background: white; padding: 15px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 20px;">
                <div style="font-weight: bold; margin-bottom: 10px; display: flex; align-items: center; gap: 5px;">
                    <i class="fa-solid fa-ticket" style="color: #ee4d2d;"></i> Kho Voucher
                </div>
                
                <div id="voucher-area">
                    </div>
                </div>
            
            <div style="margin-bottom: 20px;">
                <label style="display: flex; align-items: center; background: white; padding: 10px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 10px; cursor: pointer;">
                    <input type="radio" name="payment_method" value="COD" checked style="margin-right: 10px;">
                    <span style="flex: 1;">Thanh toán khi nhận hàng (COD)</span>
                    <i class="fa-solid fa-money-bill" style="color: #28a745;"></i>
                </label>
                <label style="display: flex; align-items: center; background: white; padding: 10px; border: 1px solid #ddd; border-radius: 5px; cursor: pointer;">
                    <input type="radio" name="payment_method" value="momo" style="margin-right: 10px;">
                    <span style="flex: 1;">Thanh toán qua Ví MoMo</span>
                    <img src="https://upload.wikimedia.org/wikipedia/vi/f/fe/MoMo_Logo.png" width="20">
                </label>
            </div>

            <div class="billing-info" style="border-top: 1px solid #eee; padding-top: 15px;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 14px;">
                    <span>Tạm tính</span>
                    <span><?= number_format($total_cart, 0, ',', '.') ?>₫</span>
                </div>

                <?php 
                    $tien_giam = 0;
                    if(isset($_SESSION['voucher'])) {
                        $tien_giam = $_SESSION['voucher']['discount'];
                        if($tien_giam > $total_cart) $tien_giam = $total_cart;
                    }
                    $total_final = $total_cart - $tien_giam;
                ?>

                <?php if($tien_giam > 0): ?>
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 14px; color: #28a745;">
                    <span>Voucher giảm giá</span>
                    <span>-<?= number_format($tien_giam, 0, ',', '.') ?>₫</span>
                </div>
                <?php endif; ?>

                <div style="display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 14px;">
                    <span>Phí vận chuyển</span>
                    <span>Miễn phí</span>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px dashed #ddd; padding-top: 15px; margin-top: 10px;">
                    <span style="font-size: 16px; font-weight: bold;">Tổng cộng</span>
                    <span style="font-size: 24px; font-weight: bold; color: #ee4d2d;"><?= number_format($total_final, 0, ',', '.') ?>₫</span>
                </div>
            </div>

            <button type="submit" name="btn_confirm" class="checkout-btn" 
                    style="width: 100%; padding: 15px; margin-top: 20px; background-color: #ee4d2d; color: white; border: none; border-radius: 5px; font-weight: bold; font-size: 16px; cursor: pointer; text-transform: uppercase;">
                ĐẶT HÀNG
            </button>

        </div>
    </div>
</form>

<form id="voucherFormHidden" action="index.php?page=apply_voucher" method="POST" style="display: none;">
    <input type="hidden" name="selected_voucher_id" id="hidden_voucher_id">
</form>

<script>
    // Danh sách voucher render từ PHP
    var voucherHTML = `
        <?php if(isset($list_vouchers) && count($list_vouchers) > 0): ?>
            <?php foreach($list_vouchers as $vc): 
                $isChecked = (isset($_SESSION['voucher']) && $_SESSION['voucher']['id'] == $vc['id']) ? 'checked' : ''; 
            ?>
            <label style="display: flex; align-items: center; padding: 10px; border-bottom: 1px solid #eee; cursor: pointer;">
                <input type="radio" name="temp_voucher" value="<?= $vc['id'] ?>" <?= $isChecked ?> 
                       onclick="submitVoucher(this.value)" style="margin-right: 10px;">
                <div>
                    <span style="font-weight: bold; color: #ee4d2d;">Giảm <?= number_format($vc['discount'], 0, ',', '.') ?>đ</span>
                    <span style="font-size: 12px; color: #888; margin-left: 5px;">(<?= $vc['code'] ?>)</span>
                </div>
            </label>
            <?php endforeach; ?>
            
            <label style="display: flex; align-items: center; padding: 10px; cursor: pointer;">
                <input type="radio" name="temp_voucher" value="0" onclick="submitVoucher(0)" 
                       <?= !isset($_SESSION['voucher']) ? 'checked' : '' ?> style="margin-right: 10px;">
                <span>Không dùng voucher</span>
            </label>
        <?php else: ?>
            <p style="font-size: 13px; color: #888; padding: 10px;">Bạn chưa có voucher nào.</p>
        <?php endif; ?>
    `;
    
    // Chèn vào div voucher-area
    document.getElementById('voucher-area').innerHTML = voucherHTML;

    // Hàm submit voucher
    function submitVoucher(id) {
        document.getElementById('hidden_voucher_id').value = id;
        document.getElementById('voucherFormHidden').submit();
    }
</script>