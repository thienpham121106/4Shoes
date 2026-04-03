<style>
    body {
        background-color: #f5f5f5;
        font-family: 'Segoe UI', sans-serif;
    }
    .voucher-container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 0 15px;
    }
    .page-title {
        font-size: 24px;
        color: #333;
        margin-bottom: 20px;
        border-left: 4px solid #ee4d2d;
        padding-left: 10px;
        font-weight: bold;
    }
    
    /* Grid Layout */
    .voucher-list {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    /* Ticket Style */
    .voucher-card {
        background: #fff;
        display: flex;
        height: 120px;
        border-radius: 4px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        position: relative;
        overflow: hidden;
        transition: transform 0.2s;
        border: 1px solid #e8e8e8;
    }
    .voucher-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border-color: #ee4d2d;
    }

    /* Cột Trái (Màu cam) */
    .voucher-left {
        width: 30%;
        background: linear-gradient(135deg, #ee4d2d, #ff7337);
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        border-right: 2px dashed #fff;
        position: relative;
    }
    .voucher-left::before, .voucher-left::after {
        content: "";
        position: absolute;
        width: 16px;
        height: 16px;
        background-color: #f5f5f5;
        border-radius: 50%;
        right: -8px;
    }
    .voucher-left::before { top: -8px; }
    .voucher-left::after { bottom: -8px; }

    .voucher-amount { font-size: 20px; font-weight: bold; text-align: center; }
    .voucher-label { font-size: 12px; text-transform: uppercase; margin-top: 5px; }

    /* Cột Phải (Thông tin) */
    .voucher-right {
        width: 70%;
        padding: 15px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .voucher-code-title {
        font-weight: bold;
        color: #333;
        font-size: 16px;
    }
    .voucher-desc {
        font-size: 13px;
        color: #757575;
    }
    .voucher-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 12px;
    }
    .voucher-qty {
        color: #ee4d2d;
        background: #fff2ee;
        padding: 2px 8px;
        border-radius: 2px;
    }
    .voucher-status {
        color: #28a745; /* Màu xanh lá */
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .voucher-list { grid-template-columns: 1fr; }
    }
</style>

<div class="voucher-container">
    <h2 class="page-title">Kho Voucher Của Tôi</h2>

    <?php if(count($list_vouchers) > 0): ?>
        <div class="voucher-list">
            <?php foreach($list_vouchers as $vc): ?>
                <div class="voucher-card">
                    <div class="voucher-left">
                        <div class="voucher-amount"><?= number_format($vc['discount']/1000, 0) ?>k</div>
                        <div class="voucher-label">Giảm giá</div>
                    </div>

                    <div class="voucher-right">
                        <div>
                            <div class="voucher-code-title">Giảm <?= number_format($vc['discount'], 0, ',', '.') ?>đ</div>
                            <div class="voucher-desc">Mã: <strong><?= $vc['code'] ?></strong></div>
                            <div class="voucher-desc" style="margin-top: 5px;">Áp dụng cho mọi đơn hàng</div>
                        </div>

                        <div class="voucher-footer">
                            <span class="voucher-qty">Còn lại: <?= $vc['quantity'] ?></span>
                            
                            <span class="voucher-status">
                                <i class="fa-regular fa-circle-check"></i> Có thể sử dụng
                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div style="text-align: center; padding: 50px; background: white; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
            <i class="fa-solid fa-ticket" style="font-size: 50px; color: #ddd; margin-bottom: 20px;"></i>
            <p style="color: gray; margin-bottom: 20px;">Bạn chưa có voucher nào!</p>
            <a href="index.php" style="color: #ee4d2d; font-weight: bold; text-decoration: none; border: 1px solid #ee4d2d; padding: 10px 20px; border-radius: 4px;">
                Săn voucher ngay
            </a>
        </div>
    <?php endif; ?>
</div>