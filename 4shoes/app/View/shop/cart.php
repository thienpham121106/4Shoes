<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    /* CSS giữ nguyên của bạn */
    .login-request { text-align: center; padding: 100px 20px; background-color: #f9f9f9; }
    .login-request i { font-size: 60px; color: #ee4d2d; margin-bottom: 20px; }
    .login-request h3 { margin-bottom: 20px; color: #333; }
    .btn-login-cart { padding: 12px 30px; background-color: #ee4d2d; color: white; text-decoration: none; font-weight: bold; border-radius: 5px; transition: 0.3s; }
    .btn-login-cart:hover { background-color: #c0392b; color: white; }
    
    .my-cart { text-align: center; }
    .cart-product img { width: 100px; height: 100px; }
    .cart-product { display: flex; gap: 20px }
    .infor-cart { display: flex; flex-direction: column; }
    .container-cart { display: flex; gap: 50px; width: 80%; margin: 0 auto; margin-top: 30px; margin-bottom: 50px; }
    .wrap { display: flex; gap: 20px; width: 70%; flex-direction: column; }
    .left-cart { width: 100%; }
    .right-cart { width: 30%; margin-top: 17px; }
    .right-cart button { width: 100%; color: white; background-color: red; padding: 13px; font-weight: bold; border: none; }
    .sub-total { display: flex; justify-content: center; justify-content: space-between; border-top: 1px solid lightgray; border-bottom: 1px solid lightgray; padding: 15px 0; }
    .right-cart { border: 1px solid lightgray; height: fit-content; padding: 20px; }
    .right-cart h3 { margin: 0; font-size: 22px; }
    .sub-total span { color: red; font-weight: bold; font-size: 25px; }
    .sub-total strong { margin-top: 5px; }
    .note { color: gray; font-size: 14px; }
    .left-note { background-color: #fafbfa; padding: 13px; font-size: 17px; }
    .quantity { display: flex; padding: 0; margin: 0; }
    .quantity button { border: 1px solid lightgray; height: 25px; width: 25px; padding: 0; margin: 0; }
    .quantity input { padding: 0; margin: 0; width: 30px; text-align: center; border: 1px solid lightgray; }
    .product-name { font-weight: bold; font-size: 14px; margin: 0; padding: 0; }
    .cart-price { font-weight: bold; }
    .size { font-size: 12px; color: gray; }
    .total { display: flex; justify-content: space-between; font-weight: bold; font-size: 18px; }
    .total span { color: red; }
    .border-bottom { border-bottom: 1px solid lightgray;; }
    .space { display: flex; justify-content: space-between; }
    .buy-more { border: 1.5px solid black; width: 600px; border-radius: 5px; font-size: 18px; background-color: white; padding: 13px; display: block; margin: 0 auto; text-align: center; }
    hr { border: none; height: 10px; background-color: lightgray; border-radius: 2px; }

    /* --- CSS MỚI CHO SWEETALERT --- */
    /* Nút Hủy: Nền trắng, chữ đen, viền xám */
    div:where(.swal2-container) button:where(.swal2-styled).swal2-cancel {
        background-color: #fff !important;
        color: #333 !important;
        border: 1px solid #ccc !important;
    }
    div:where(.swal2-container) button:where(.swal2-styled).swal2-cancel:hover {
        background-color: #f5f5f5 !important;
    }
    
    /* Nút Đồng ý: Màu đỏ */
    div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm {
        background-color: #d33 !important;
        box-shadow: none !important;
    }
</style>

<?php if(!isset($_SESSION['user'])): ?>
    
    <div class="login-request">
        <i class="fa-solid fa-lock"></i>
        <h3>Vui lòng đăng nhập để xem giỏ hàng của bạn</h3>
        <p style="margin-bottom: 30px; color: gray;">Đăng nhập để theo dõi đơn hàng và nhận nhiều ưu đãi hấp dẫn.</p>
        <a href="index.php?page=login" class="btn-login-cart">ĐĂNG NHẬP NGAY</a>
    </div>

<?php else: ?>

    <h2 class="my-cart">Giỏ hàng của bạn</h2>
    <div class="container-cart">
        <div class="wrap">
            <?php 
                $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
                $count = count($cart);
                $total = 0;
            ?>
            <p class="left-note">Bạn đang có <strong><?= $count ?> sản phẩm</strong> trong giỏ hàng</p>

            <?php if($count > 0): ?>
                <?php foreach($cart as $id => $item): 
                    $thanh_tien = $item['price'] * $item['quantity'];
                    $total += $thanh_tien;
                ?>
                <div class="left-cart">
                    <div class="border-bottom">
                        <div class="space">
                            <div class="cart-product">
                                <img src="../public/ASM-js/images/index-product/<?= $item['image'] ?>" alt="">
                                <div class="infor-cart">
                                    <p class="product-name"><?= $item['name'] ?></p>
                                    <div class="quantity">
                                        <a href="index.php?page=update_cart&id=<?= $id ?>&type=decrease" style="text-decoration: none;">
                                            <button type="button" style="cursor: pointer;">-</button>
                                        </a>
                                        <input type="text" value="<?= $item['quantity'] ?>" readonly style="text-align: center; width: 40px;">
                                        <a href="index.php?page=update_cart&id=<?= $id ?>&type=increase" style="text-decoration: none;">
                                            <button type="button" style="cursor: pointer;">+</button>
                                        </a>
                                    </div>
                                    <p class="cart-price"><?= number_format($item['price'], 0, ',', '.') ?>đ</p>
                                </div>
                            </div>
                            
                            <a href="javascript:void(0)" onclick="confirmDelete(<?= $id ?>)" title="Xóa sản phẩm">
                                <i class="fa-solid fa-trash"></i>
                            </a>

                        </div>
                        <p class="total">Thành tiền: <span><?= number_format($thanh_tien, 0, ',', '.') ?>đ</span></p>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="margin-top: 20px;">Giỏ hàng trống.</p>
            <?php endif; ?>
        </div>
        
        <div class="right-cart">
            <h3>Thông tin đơn hàng</h3>
            <p class="sub-total"><strong>Tổng tiền: </strong><span><?= number_format($total, 0, ',', '.') ?>đ</span></p>
            <p class="note">Bạn có thể nhập mã giảm giá ở trang thanh toán</p>
            
            <form action="index.php?page=checkout" method="POST">
                <button type="submit" name="btn_checkout">THANH TOÁN</button>
            </form>
        </div>
    </div>
    <a href="index.php?page=index"><button class="buy-more">TIẾP TỤC MUA HÀNG</button></a>

<?php endif; ?>

<script>
    function confirmDelete(productId) {
        Swal.fire({
            title: 'Xóa sản phẩm?',
            text: "Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng không?",
            icon: 'warning',
            showCancelButton: true,
            // Chúng ta không dùng confirmButtonColor trong JS nữa để CSS tự xử lý
            confirmButtonText: 'Đồng ý, xóa ngay!',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                // Nếu bấm Đồng ý -> Chuyển hướng đến trang xóa
                window.location.href = 'index.php?page=deletecart&id=' + productId;
            }
        });
    }
</script>