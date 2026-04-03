<div class="user-form-container">
    <div class="user-form-card">
        <h2><?php echo isset($user_edit) ? "Sửa User" : "Thêm User"; ?></h2>
        <form method="post" action="">
            <div class="user-form-group">
                <label for="name">Tên:</label>
                <input type="text" id="name" name="name"
                       value="<?php echo (isset($user_edit['name'])) ? $user_edit['name'] : ''; ?>" required>
            </div>

            <div class="user-form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email"
                       value="<?php echo (isset($user_edit['email'])) ? $user_edit['email'] : ''; ?>" required>
            </div>

            <div class="user-form-group">
                <label for="phone">SĐT:</label>
                <input type="text" id="phone" name="phone"
                       value="<?php echo (isset($user_edit['phone'])) ? $user_edit['phone'] : ''; ?>" required>
            </div>

            <div class="user-form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password">
                <?php if(isset($user_edit)) echo "<small>(Để trống nếu không đổi mật khẩu)</small>"; ?>
            </div>

            <div class="user-form-group">
                <label for="role">Vai trò:</label>
                <select id="role" name="role">
                    <option value="user" <?php echo (isset($user_edit['role']) && $user_edit['role']=='user') ? 'selected' : ''; ?>>User</option>
                    <option value="admin" <?php echo (isset($user_edit['role']) && $user_edit['role']=='admin') ? 'selected' : ''; ?>>Admin</option>
                </select>
            </div>

            <div class="user-form-actions">
                <?php if(isset($user_edit)) { ?>
                    <button type="submit" name="update_user" class="btn-edit">Cập nhật</button>
                <?php } else { ?>
                    <button type="submit" name="add_user" class="btn-add">Thêm</button>
                <?php } ?>
                <a href="admin.php?page=user" class="btn-cancel">Hủy</a>
            </div>
        </form>
    </div>
</div>
