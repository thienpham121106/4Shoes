<div class="login-container">
    <h2>ĐĂNG KÝ</h2>
    <form action="index.php?page=registerPost" method="POST">
        <div class="form-group">
            <label>Họ và tên</label>
            <input type="text" name="name" required placeholder="Nhập họ tên...">
        </div>
        <div class="form-group">
            <label>Số điện thoại</label>
            <input type="text" name="phone" required placeholder="Nhập số điện thoại...">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required placeholder="Nhập email...">
        </div>
        <div class="form-group">
            <label>Mật khẩu</label>
            <input type="password" name="pass" required placeholder="Nhập mật khẩu...">
        </div>
        <button type="submit" name="btn_register" class="btn-submit">ĐĂNG KÝ</button>
    </form>
    <div class="switch-link">
        Đã có tài khoản? <a href="index.php?page=login">Đăng nhập</a>
    </div>
</div>