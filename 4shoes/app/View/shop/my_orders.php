<style>
    /* Container chính */
    .my-orders-container { 
        width: 85%; 
        margin: 40px auto; 
        min-height: 500px; 
        font-family: Arial, sans-serif;
    }
    .page-title { 
        font-size: 24px; 
        font-weight: bold; 
        color: #333; 
        margin-bottom: 20px; 
        border-left: 5px solid #ee4d2d; 
        padding-left: 15px;
    }

    /* --- CSS CHO TAB --- */
    .tab-header {
        display: flex;
        border-bottom: 2px solid #ddd;
        margin-bottom: 20px;
        background: #fff;
    }
    .tab-item {
        padding: 15px 25px;
        cursor: pointer;
        font-weight: 600;
        color: #555;
        border-bottom: 3px solid transparent;
        transition: all 0.3s;
        flex: 1; 
        text-align: center;
    }
    .tab-item:hover {
        color: #ee4d2d;
        background-color: #f9f9f9;
    }
    .tab-item.active {
        color: #ee4d2d;
        border-bottom: 3px solid #ee4d2d;
    }
    
    /* Ẩn hiện nội dung tab */
    .tab-content {
        display: none;
        animation: fadeIn 0.5s;
    }
    .tab-content.active {
        display: block;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* --- BẢNG ĐƠN HÀNG --- */
    .order-table { 
        width: 100%; 
        border-collapse: collapse; 
        background-color: white; 
        box-shadow: 0 2px 8px rgba(0,0,0,0.05); 
        border-radius: 8px;
        overflow: hidden;
    }
    .order-table th, .order-table td { 
        padding: 15px; 
        text-align: left; 
        border-bottom: 1px solid #eee; 
    }
    .order-table th { 
        background-color: #f4f4f4; 
        font-weight: bold; 
        color: #333; 
        text-transform: uppercase;
        font-size: 13px;
    }
    .order-table tr:hover {
        background-color: #fafafa;
    }
    
    /* Badge trạng thái */
    .status-badge { padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; display: inline-block; }
    .st-pending { background-color: #fff8e1; color: #ffa000; border: 1px solid #ffe082; } 
    .st-shipping { background-color: #e3f2fd; color: #1976d2; border: 1px solid #90caf9; }
    .st-completed { background-color: #e8f5e9; color: #2e7d32; border: 1px solid #a5d6a7; }
    .st-cancelled { background-color: #f5f5f5; color: #616161; border: 1px solid #e0e0e0; }

    /* Nút bấm */
    .btn-action {
        padding: 8px 15px;
        text-decoration: none;
        border-radius: 4px;
        font-size: 13px;
        font-weight: 500;
        transition: 0.2s;
        display: inline-block;
    }
    .btn-cancel { background-color: white; color: #d32f2f; border: 1px solid #d32f2f; }
    .btn-cancel:hover { background-color: #d32f2f; color: white; }
    
    .btn-view { background-color: #ee4d2d; color: white; border: 1px solid #ee4d2d; }
    .btn-view:hover { background-color: #c0392b; border-color: #c0392b; }

    .empty-tab { text-align: center; padding: 40px; color: #999; font-style: italic; }
</style>

<?php
    // 1. PHÂN LOẠI ĐƠN HÀNG RA CÁC MẢNG RIÊNG BIỆT (SỬA LỖI LOGIC TẠI ĐÂY)
    $list_pending = [];   // pending
    $list_shipping = [];  // processing
    $list_completed = []; // completed
    $list_cancelled = []; // cancelled

    if(isset($orders) && count($orders) > 0) {
        foreach($orders as $or) {
            // So sánh với CHUỖI ký tự thay vì số
            if($or['status'] == 'pending') $list_pending[] = $or;
            elseif($or['status'] == 'processing') $list_shipping[] = $or;
            elseif($or['status'] == 'completed') $list_completed[] = $or;
            else $list_cancelled[] = $or;
        }
    }
?>

<div class="my-orders-container">
    <h2 class="page-title">ĐƠN HÀNG CỦA TÔI</h2>

    <div class="tab-header">
        <div class="tab-item active" onclick="openTab(event, 'tabPending')">
            Chờ xác nhận (<?= count($list_pending) ?>)
        </div>
        <div class="tab-item" onclick="openTab(event, 'tabShipping')">
            Đang giao (<?= count($list_shipping) ?>)
        </div>
        <div class="tab-item" onclick="openTab(event, 'tabCompleted')">
            Hoàn thành (<?= count($list_completed) ?>)
        </div>
        <div class="tab-item" onclick="openTab(event, 'tabCancelled')">
            Đã hủy (<?= count($list_cancelled) ?>)
        </div>
    </div>

    <div id="tabPending" class="tab-content active">
        <?php renderOrderTable($list_pending); ?>
    </div>

    <div id="tabShipping" class="tab-content">
        <?php renderOrderTable($list_shipping); ?>
    </div>

    <div id="tabCompleted" class="tab-content">
        <?php renderOrderTable($list_completed); ?>
    </div>

    <div id="tabCancelled" class="tab-content">
        <?php renderOrderTable($list_cancelled); ?>
    </div>
</div>

<script>
    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;

        // Ẩn tất cả nội dung tab
        tabcontent = document.getElementsByClassName("tab-content");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].className = tabcontent[i].className.replace(" active", "");
        }

        // Bỏ active ở tất cả các nút tab
        tablinks = document.getElementsByClassName("tab-item");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Hiện tab được chọn và thêm active cho nút đó
        document.getElementById(tabName).className += " active";
        evt.currentTarget.className += " active";
    }
</script>

<?php
// HÀM HỖ TRỢ HIỂN THỊ BẢNG
function renderOrderTable($data) {
    if(count($data) == 0) {
        echo '<div class="empty-tab"><i class="fa-solid fa-box-open" style="font-size: 40px; margin-bottom: 10px;"></i><br>Chưa có đơn hàng nào ở mục này.</div>';
        return;
    }
?>
    <table class="order-table">
        <thead>
            <tr>
                <th>Mã đơn</th>
                <th>Ngày đặt</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th style="text-align: right;">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $order): ?>
            <tr>
                <td><strong>#<?= $order['id'] ?></strong></td>
                <td><?= date("d/m/Y H:i", strtotime($order['order_date'])) ?></td>
                <td style="color: #ee4d2d; font-weight: bold;">
                    <?= number_format($order['total_price'], 0, ',', '.') ?>đ
                </td>
                <td>
                    <?php 
                        // Hiển thị trạng thái dựa trên chuỗi text
                        if($order['status'] == 'pending') echo '<span class="status-badge st-pending">Chờ xác nhận</span>';
                        elseif($order['status'] == 'processing') echo '<span class="status-badge st-shipping">Đang giao hàng</span>';
                        elseif($order['status'] == 'completed') echo '<span class="status-badge st-completed">Giao thành công</span>';
                        else echo '<span class="status-badge st-cancelled">Đã hủy</span>';
                    ?>
                </td>
                <td style="text-align: right;">
                    <a href="index.php?page=order_detail_history&id=<?= $order['id'] ?>" class="btn-action btn-view">
                        Chi tiết
                    </a>

                    <?php if($order['status'] == 'pending'): ?>
                        <a href="index.php?page=cancel_order&id=<?= $order['id'] ?>" 
                           class="btn-action btn-cancel"
                           onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');">
                            Hủy đơn
                        </a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php } ?>