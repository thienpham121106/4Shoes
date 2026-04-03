<div class="card">
    <div class="card-header">
        <span class="header-title">Quản lý Voucher</span>
        <a href="admin.php?page=voucher_form" class="btn btn-add"><i class="fa-solid fa-plus"></i> Thêm Voucher</a>
    </div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mã Code</th>
                    <th>Giảm</th>
                    <th>Số lượng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($dsvc as $vc): ?>
                <tr>
                    <td><?= $vc['id'] ?></td>
                    <td style="color: #4e73df; font-weight: bold;"><?= $vc['code'] ?></td>
                    <td style="color: #1cc88a; font-weight: bold;">
    -<?= number_format($vc['discount'], 0, ',', '.') ?>đ
</td>
                    <td><?= $vc['quantity'] ?></td>
                    <td>
                        <a href="admin.php?page=voucher_form&idedit=<?= $vc['id'] ?>" class="btn btn-edit"><i class="fa-solid fa-pen"></i></a>
                        <a href="admin.php?page=voucher&id=<?= $vc['id'] ?>" onclick="return confirm('Xóa?')" class="btn btn-delete"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>