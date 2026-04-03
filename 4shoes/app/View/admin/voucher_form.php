<div class="card">
    <div class="card-header">
        <span class="header-title"><?= isset($vc_edit) ? 'Cập nhật Voucher' : 'Thêm Voucher Mới' ?></span>
    </div>
    
    <div style="padding: 20px;">
        <form method="post" action="" class="form-container">
            
            <div class="form-group">
                <label>Mã Voucher (VD: TET2025)</label>
                <input type="text" name="code" class="form-control" 
                       value="<?= isset($vc_edit)?$vc_edit['code']:'' ?>" 
                       required style="text-transform: uppercase;">
            </div>
            
            <div class="form-group">
                <label>Số tiền giảm (VND)</label>
                <input type="number" name="discount" class="form-control" 
                       value="<?= isset($vc_edit)?$vc_edit['discount']:'' ?>" 
                       required min="1000" placeholder="VD: 50000">
                <small style="color: gray;">Nhập số tiền muốn giảm trực tiếp (VD: 50000).</small>
            </div>

            <div class="form-group">
                <label>Dành cho User ID (Để trống nếu tặng tất cả)</label>
                <input type="number" name="user_id" class="form-control" 
                       value="<?= isset($vc_edit['user_id']) ? $vc_edit['user_id'] : '' ?>" 
                       placeholder="Nhập ID người dùng...">
                <small style="color: gray;">Ví dụ: Nhập 5 để tặng riêng cho User có ID là 5.</small>
            </div>

            <div class="form-group">
                <label>Số lượng</label>
                <input type="number" name="quantity" class="form-control" 
                       value="<?= isset($vc_edit)?$vc_edit['quantity']:'' ?>" 
                       required min="1">
            </div>

            <div class="form-actions" style="margin-top: 20px;">
                <input type="submit" class="btn btn-add" 
                       name="<?= isset($vc_edit)?'update_vc':'add_vc' ?>" 
                       value="Lưu lại" 
                       style="padding: 10px 30px; font-size: 16px; cursor: pointer;">
                
                <a href="admin.php?page=voucher" class="btn btn-delete" 
                   style="text-decoration: none; padding: 10px 30px; margin-left: 10px;">Hủy</a>
            </div>

        </form>
    </div>
</div>