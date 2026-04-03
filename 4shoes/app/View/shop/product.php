<style>
    /* --- 1. CSS THANH CÔNG CỤ LỌC (GIỮ NGUYÊN) --- */
    .filter-bar {
        width: 97%;
        max-width: 1400px;
        margin: 30px auto 20px auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 15px;
        border-bottom: 2px solid #f5f5f5;
    }

    .filter-title {
        font-size: 20px;
        font-weight: 700;
        text-transform: uppercase;
        color: #333;
        border-left: 5px solid #ee4d2d;
        padding-left: 10px;
    }

    .filter-options {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .filter-select {
        padding: 8px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        outline: none;
        font-size: 14px;
        cursor: pointer;
        min-width: 220px;
        background-color: #fff;
    }
    .filter-select:focus { border-color: #ee4d2d; }

    /* --- 2. CSS LƯỚI SẢN PHẨM (ĐỒNG BỘ VỚI INDEX) --- */
    .container-product {
        margin: 0 auto;
        width: 97%;
        max-width: 1400px;
        display: grid;
        grid-template-columns: repeat(5, 1fr); /* 5 CỘT */
        gap: 15px;
        padding-bottom: 40px;
    }

    .product {
        background: #fff;
        border: 1px solid #e1e1e1;
        border-radius: 8px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        height: 100%;
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0,0,0,0.02);
        position: relative;
    }

    .product:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border-color: #ee4d2d;
    }

    .product a { text-decoration: none; color: inherit; display: flex; flex-direction: column; height: 100%; }

    /* ẢNH SẢN PHẨM */
    .product img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        border-bottom: 1px solid #f0f0f0;
    }

    /* KHUNG THÔNG TIN */
    .product-info-wrapper {
        padding: 12px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .product-name {
        font-weight: 600;
        color: #333;
        font-size: 14px;
        line-height: 1.4;
        margin-bottom: 8px;
        text-align: center;
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Cắt chữ 2 dòng */
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 40px;
    }
    .product:hover .product-name { color: #ee4d2d; }

    .product-price {
        font-size: 16px;
        font-weight: bold;
        color: #d0011b;
        margin: 5px 0 10px 0;
        text-align: center;
    }

    /* --- 3. CSS CHO PHẦN STOCK (TỒN KHO) --- */
    .stock-badge {
        font-size: 12px;
        text-align: center;
        margin-bottom: 10px;
        padding: 3px 10px;
        border-radius: 12px;
        background-color: #f8f9fa;
        color: #666;
        font-weight: 500;
        display: inline-block;
        align-self: center; /* Căn giữa badge */
        border: 1px solid #eee;
    }
    
    .stock-badge i {
        margin-right: 4px;
        color: #888;
    }

    /* Nếu tồn kho thấp (<10) thì hiện màu cam báo động */
    .low-stock {
        color: #d35400;
        background-color: #fff5e6;
        border-color: #ffe0b2;
    }
    .low-stock i { color: #d35400; }

    /* NÚT THÊM VÀO GIỎ */
    .btn-add-cart {
        background-color: #ee4d2d;
        color: white;
        border: none;
        padding: 10px 0;
        border-radius: 4px;
        font-weight: bold;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: auto;
        text-transform: uppercase;
    }
    .btn-add-cart:hover { background-color: #c53e24; }
    
    /* Responsive Mobile */
    @media (max-width: 768px) {
        .container-product { grid-template-columns: repeat(2, 1fr); }
    }
</style>

<div class="filter-bar">
    <div class="filter-title">
        <?php 
            if(isset($_GET['id']) && $_GET['id'] > 0) {
                echo "Sản phẩm theo danh mục"; 
            } else {
                echo "Tất cả sản phẩm";
            }
        ?>
    </div>

    <div class="filter-options">
        <span style="font-weight: 600; font-size: 14px;">Sắp xếp theo:</span>
        <select class="filter-select" onchange="sortProduct(this.value)">
            <option value="new" <?= (isset($_GET['sort']) && $_GET['sort'] == 'new') ? 'selected' : '' ?>>Mới nhất</option>
            <option value="price_asc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'price_asc') ? 'selected' : '' ?>>Giá: Thấp đến Cao</option>
            <option value="price_desc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'price_desc') ? 'selected' : '' ?>>Giá: Cao đến Thấp</option>
            <option value="bestseller" <?= (isset($_GET['sort']) && $_GET['sort'] == 'bestseller') ? 'selected' : '' ?>>Bán chạy nhất</option>
        </select>
    </div>
</div>

<div class="container-product">
    <?php if(count($dssp) > 0): ?>
        <?php foreach($dssp as $sp): ?>
            <div class="product">
                <a href="index.php?page=productdetail&id=<?= $sp['id'] ?>">
                    <img src="../public/ASM-js/images/index-product/<?= $sp['image'] ?>" alt="">
                    
                    <div class="product-info-wrapper">
                        <p class="product-name"><?= $sp['name'] ?></p>
                        <p class="product-price"><?= number_format($sp['price'], 0, ',', '.') ?>đ</p>
                        
                        <?php 
                            // Logic đổi màu nếu tồn kho thấp
                            $stock_class = ($sp['stock'] < 10) ? 'low-stock' : ''; 
                            $stock_text = $sp['stock'];
                            if($sp['stock'] == 0) $stock_text = "Hết hàng";
                        ?>
                        <div class="stock-badge <?= $stock_class ?>">
                            <i class="fa-solid fa-layer-group"></i> Kho: <?= $stock_text ?>
                        </div>

                        <a href="index.php?page=addtocart&id=<?= $sp['id'] ?>" style="margin-top: auto; width: 100%;">
                            <button class="btn-add-cart" <?= ($sp['stock'] == 0) ? 'disabled style="background:gray;"' : '' ?>>
                                <i class="fa-solid fa-cart-plus"></i> 
                                <?= ($sp['stock'] == 0) ? 'Hết hàng' : 'Thêm vào giỏ' ?>
                            </button>
                        </a>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div style="text-align: center; width: 100%; grid-column: 1/-1; padding: 50px; background: #fff; border-radius: 8px;">
            <i class="fa-solid fa-box-open" style="font-size: 40px; color: #ddd; margin-bottom: 10px;"></i>
            <p>Không tìm thấy sản phẩm nào phù hợp.</p>
        </div>
    <?php endif; ?>
</div>

<script>
    function sortProduct(sortValue) {
        let currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('sort', sortValue);
        window.location.href = currentUrl.toString();
    }
</script>