<div class="card">
    <div class="card-header">
        <span class="header-title">Quản lý Đơn hàng</span>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th style="width: 80px;">Mã đơn</th>
                    <th>Thông tin khách hàng</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái hiện tại</th>
                    <th style="width: 250px;">Cập nhật trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dsorder as $order): ?>
                <tr>
                    <td><strong>#<?= $order['id'] ?></strong></td>
                    
                    <td>
                        <span style="font-weight:bold; color:#4e73df;"><?= htmlspecialchars($order['user_name']) ?></span><br>
                        <small><i class="fa-solid fa-phone"></i> <?= htmlspecialchars($order['phone']) ?></small><br>
                        <small style="color:#888;"><?= htmlspecialchars($order['address']) ?></small>
                    </td>

                    <td><?= date("d/m/Y H:i", strtotime($order['order_date'])) ?></td>
                    
                    <td class="price-tag"><?= number_format($order['total_price'], 0, ',', '.') ?>đ</td>
                    
                    <td>
                        <?php 
                            $st = $order['status'];
                            if($st == 'pending') echo '<span class="stock-badge stock-low">Chờ xác nhận</span>';
                            elseif($st == 'processing') echo '<span class="stock-badge" style="background:#36b9cc; color:white;">Đang giao</span>';
                            elseif($st == 'completed') echo '<span class="stock-badge stock-high">Hoàn thành</span>';
                            else echo '<span class="stock-badge stock-out">Đã hủy</span>';
                        ?>
                    </td>

                    <td>
                        <form action="" method="POST" style="display: flex; gap: 5px;">
                            <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                            
                            <select name="status" style="padding: 6px; border-radius: 4px; border: 1px solid #d1d3e2; outline:none; font-size: 13px;">
                                <option value="pending" <?= $st=='pending'?'selected':'' ?>>Chờ xác nhận</option>
                                <option value="processing" <?= $st=='processing'?'selected':'' ?>>Đang giao hàng</option>
                                <option value="completed" <?= $st=='completed'?'selected':'' ?>>Hoàn thành</option>
                                <option value="cancelled" <?= $st=='cancelled'?'selected':'' ?>>Hủy đơn</option>
                            </select>
                            
                            <button type="submit" name="update_status" class="btn btn-add" style="padding: 6px 10px; font-size: 13px;">
                                <i class="fa-solid fa-save"></i> Lưu
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>