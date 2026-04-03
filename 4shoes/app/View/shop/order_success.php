<style>
    .success-container {
        text-align: center;
        padding: 50px 20px;
        min-height: 60vh; /* Chiều cao tối thiểu */
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color: #f9f9f9;
    }
    .icon-check {
        font-size: 80px;
        color: #28a745; /* Màu xanh lá */
        margin-bottom: 20px;
    }
    .success-title {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
    }
    .order-id {
        font-size: 18px;
        color: #555;
        margin-bottom: 30px;
    }
    .btn-home {
        background-color: #ee4d2d;
        color: white;
        padding: 12px 30px;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        transition: 0.3s;
    }
    .btn-home:hover {
        background-color: #c0392b;
        color: white;
    }
</style>

<div class="success-container">
    <i class="fa-regular fa-circle-check icon-check"></i>
    
    <div class="success-title">ĐẶT HÀNG THÀNH CÔNG!</div>
    
    <p>Cảm ơn bạn đã mua hàng tại Neo Sport.</p>
    <p class="order-id">Mã đơn hàng của bạn là: <strong>#<?= isset($order_id) ? $order_id : '---' ?></strong></p>
    
    <p style="margin-bottom: 40px; color: gray;">
        Nhân viên sẽ sớm liên hệ với bạn để xác nhận đơn hàng.
    </p>

    <a href="index.php?page=index" class="btn-home">TIẾP TỤC MUA SẮM</a>
</div>