<style>
    .detail-container { width: 80%; margin: 50px auto; background: white; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.05); border-radius: 8px; }
    .head-title { border-bottom: 2px solid #ee4d2d; padding-bottom: 10px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
    .back-link { text-decoration: none; color: #555; font-size: 14px; }
    .back-link:hover { color: #ee4d2d; }
    
    /* Thông tin chung */
    .order-info-box { background: #f9f9f9; padding: 15px; border-radius: 5px; margin-bottom: 20px; display: flex; justify-content: space-between; }
    .info-group h4 { margin: 0 0 10px 0; font-size: 14px; color: #888; text-transform: uppercase; }
    .info-group p { margin: 5px 0; font-weight: bold; color: #333; }

    /* Bảng sản phẩm */
    .detail-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
    .detail-table th { background: #eee; padding: 10px; text-align: left; font-size: 14px; }
    .detail-table td { padding: 10px; border-bottom: 1px solid #eee; vertical-align: middle; }
    .detail-table img { width: 60px; height: 60px; object-fit: cover; border: 1px solid #ddd; border-radius: 4px; margin-right: 10px; }
    .prod-flex { display: flex; align-items: center; }
    
    /* Tổng tiền */
    .total-box { text-align: right; margin-top: 20px; }
    .total-row { display: flex; justify-content: flex-end; gap: 50px; margin-bottom: 5px; }
    .total-price { color: #ee4d2d; font-size: 20px; font-weight: bold; }
</style>

<div class="detail-container">
    <div class="head-title">
        <h2 style="margin: 0;">CHI TIẾT ĐƠN HÀNG #<?= $order['id'] ?></h2>
        <a href="index.php?page=my_orders" class="back-link"><i class="fa-solid fa-arrow-left"></i> Quay lại danh sách</a>
    </div>

    <div class="order-info-box">
        <div class="info-group">
            <h4>Địa chỉ nhận hàng</h4>
            <p><?= $order['user_name'] ?></p>
            <p><?= $order['phone'] ?></p>
            <p><?= $order['address'] ?></p>
        </div>
        <div class="info-group">
            <h4>Thông tin đơn hàng</h4>
            <p>Ngày đặt: <?= date("d/m/Y H:i", strtotime($order['order_date'])) ?></p>
            <p>Trạng thái: 
                <?php 
                    if($order['status'] == 1) echo '<span style="color: orange">Chờ xác nhận</span>';
                    elseif($order['status'] == 2) echo '<span style="color: blue">Đang giao hàng</span>';
                    elseif($order['status'] == 3) echo '<span style="color: green">Hoàn thành</span>';
                    else echo '<span style="color: gray">Chờ xác nhận</span>';
                ?>
            </p>
            <p>Thanh toán: <?= $order['payment_method'] ?></p>
        </div>
    </div>

    <table class="detail-table">
        <thead>
            <tr>
                <th style="width: 50%;">Sản phẩm</th>
                <th>Đơn giá</th>
                <th>Số lượng</th>
                <th style="text-align: right;">Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($order_details as $item): ?>
            <tr>
                <td>
                    <div class="prod-flex">
                        <img src="../public/ASM-js/images/index-product/<?= $item['image'] ?>" alt="">
                        <div>
                            <p style="margin: 0; font-weight: bold;"><?= $item['name'] ?></p>
                            </div>
                    </div>
                </td>
                <td><?= number_format($item['price'], 0, ',', '.') ?>đ</td>
                <td>x<?= $item['quantity'] ?></td>
                <td style="text-align: right; font-weight: bold;">
                    <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?>đ
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="total-box">
        <div class="total-row">
            <span>Tổng tiền hàng:</span>
            <span><?= number_format($order['total_price'], 0, ',', '.') ?>đ</span>
        </div>
        <div class="total-row">
            <span>Phí vận chuyển:</span>
            <span>0đ</span>
        </div>
        <hr style="margin: 10px 0; border: 0; border-top: 1px solid #eee;">
        <div class="total-row">
            <span style="font-size: 16px; font-weight: bold;">TỔNG THANH TOÁN:</span>
            <span class="total-price"><?= number_format($order['total_price'], 0, ',', '.') ?>đ</span>
        </div>
    </div>
</div>