<style>
/* --- COPY LẠI CSS ĐÃ TỐI ƯU Ở BƯỚC TRƯỚC VÀO ĐÂY --- */
body { padding: 0; margin: 0; font-family: 'Segoe UI', sans-serif; background-color: #f8f9fa; }
a { text-decoration: none; color: inherit; }
.new-shoes { margin: 40px auto 20px auto; width: 97%; max-width: 1400px; border-left: 5px solid #ee4d2d; padding-left: 15px; }
.new-shoes h2 { text-transform: uppercase; font-weight: 800; margin: 0; color: #333; font-size: 24px; }
.container-product { margin: 0 auto; width: 97%; max-width: 1400px; display: grid; grid-template-columns: repeat(5, 1fr); gap: 15px; padding-bottom: 20px; }
.product { background: #fff; border: 1px solid #e1e1e1; border-radius: 8px; overflow: hidden; display: flex; flex-direction: column; height: 100%; transition: all 0.3s ease; box-shadow: 0 2px 5px rgba(0,0,0,0.02); }
.product:hover { transform: translateY(-5px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); border-color: #ee4d2d; }
.product img { width: 100%; height: 220px; object-fit: cover; border-bottom: 1px solid #f0f0f0; }
.product-info-wrapper { padding: 12px; display: flex; flex-direction: column; flex: 1; }
.product-name { font-weight: 600; color: #333; font-size: 14px; line-height: 1.4; margin-bottom: 8px; text-align: center; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 40px; }
.product:hover .product-name { color: #ee4d2d; }
.product-price { font-size: 16px; font-weight: bold; color: #d0011b; margin: 5px 0 15px 0; text-align: center; }
.btn-add-cart { background-color: #ee4d2d; color: white; border: none; padding: 10px 0; border-radius: 4px; font-weight: bold; font-size: 13px; cursor: pointer; transition: all 0.3s ease; width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; margin-top: auto; text-transform: uppercase; }
.btn-add-cart:hover { background-color: #c53e24; }
.small-banner { width: 97%; max-width: 1400px; height: 250px; margin: 40px auto; }
.small-banner img { width: 100%; height: 100%; object-fit: cover; border-radius: 8px; }
hr { border: none; height: 1px; background-color: #ddd; margin: 40px auto; width: 97%; max-width: 1400px; }
.container-image { display: flex; width: 100%; height: 200px; gap: 5px; margin-top: 20px;}
.container-image img { width: 100%; height: 100%; object-fit: cover; }
</style>

<div class="banner">
    <img src="../public/ASM-js/images/banner1.jpg" alt="" style="width: 100%;">
</div>

<div class="new-shoes">
    <h2>GIÀY MỚI VỀ</h2>
</div>

<div class="container-product">
    <?php foreach($dssp_new as $sp): ?>
        <div class="product">
            <a href="index.php?page=productdetail&id=<?= $sp['id'] ?>">
                <img src="../public/ASM-js/images/index-product/<?= $sp['image'] ?>" alt="">
                <div class="product-info-wrapper">
                    <p class="product-name"><?= $sp['name'] ?></p>
                    <p class="product-price"><?= number_format($sp['price'], 0, ',', '.') ?>đ</p>
                    <a href="index.php?page=addtocart&id=<?= $sp['id'] ?>" style="margin-top: auto; width: 100%;">
                        <button class="btn-add-cart">
                            <i class="fa-solid fa-cart-plus"></i> Thêm vào giỏ
                        </button>
                    </a>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>

<div class="small-banner">
    <img src="../public/ASM-js/images/small-banner.jpg" alt="">
</div>

<div class="new-shoes">
    <h2>SẢN PHẨM TIÊU BIỂU</h2>
</div>

<div class="container-product">
    <?php foreach($dssp_featured as $sp): ?>
        <div class="product">
            <a href="index.php?page=productdetail&id=<?= $sp['id'] ?>">
                <img src="../public/ASM-js/images/index-product/<?= $sp['image'] ?>" alt="">
                <div class="product-info-wrapper">
                    <p class="product-name"><?= $sp['name'] ?></p>
                    <p class="product-price"><?= number_format($sp['price'], 0, ',', '.') ?>đ</p>
                    <a href="index.php?page=addtocart&id=<?= $sp['id'] ?>" style="margin-top: auto; width: 100%;">
                        <button class="btn-add-cart">
                            <i class="fa-solid fa-cart-plus"></i> Thêm vào giỏ
                        </button>
                    </a>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>

<div class="small-banner">
    <img src="../public/ASM-js/images/small-banner2.jpg" alt="">
</div>

<div class="new-shoes">
    <h2>SẢN PHẨM BÁN CHẠY</h2>
</div>

<div class="container-product">
    <?php foreach($dssp_bestseller as $sp): ?>
        <div class="product">
            <a href="index.php?page=productdetail&id=<?= $sp['id'] ?>">
                <img src="../public/ASM-js/images/index-product/<?= $sp['image'] ?>" alt="">
                <div class="product-info-wrapper">
                    <p class="product-name"><?= $sp['name'] ?></p>
                    <p class="product-price"><?= number_format($sp['price'], 0, ',', '.') ?>đ</p>
                    <a href="index.php?page=addtocart&id=<?= $sp['id'] ?>" style="margin-top: auto; width: 100%;">
                        <button class="btn-add-cart">
                            <i class="fa-solid fa-cart-plus"></i> Thêm vào giỏ
                        </button>
                    </a>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
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