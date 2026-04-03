<div class="login-container">
    <h2>ĐĂNG NHẬP</h2>
    <form action="index.php?page=loginPost" method="POST">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required placeholder="Nhập email...">
        </div>
        <div class="form-group">
            <label>Mật khẩu</label>
            <input type="password" name="pass" required placeholder="Nhập mật khẩu...">
        </div>
        <button type="submit" name="btn_login" class="btn-submit">ĐĂNG NHẬP</button>
    </form>
    <div class="switch-link">
        Chưa có tài khoản? <a href="index.php?page=register">Đăng ký ngay</a>
    </div>
</div>