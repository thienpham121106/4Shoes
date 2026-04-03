<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', sans-serif;
        color: #333;
    }
    .policy-wrapper {
        max-width: 1200px;
        margin: 40px auto;
        display: flex;
        gap: 30px;
        padding: 0 15px;
    }

    /* MENU BÊN TRÁI */
    .policy-sidebar {
        width: 25%;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        height: fit-content;
        position: sticky;
        top: 20px; /* Trượt theo khi cuộn */
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .policy-sidebar h3 {
        margin-top: 0;
        font-size: 18px;
        border-bottom: 2px solid #ee4d2d;
        padding-bottom: 10px;
        margin-bottom: 15px;
        color: #ee4d2d;
    }
    .policy-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .policy-menu li {
        margin-bottom: 10px;
    }
    .policy-menu li a {
        text-decoration: none;
        color: #555;
        font-weight: 500;
        display: block;
        padding: 8px 10px;
        border-radius: 4px;
        transition: 0.2s;
    }
    .policy-menu li a:hover {
        background-color: #fff2ee;
        color: #ee4d2d;
    }

    /* NỘI DUNG BÊN PHẢI */
    .policy-content {
        width: 75%;
        background: #fff;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .policy-section {
        margin-bottom: 40px;
        border-bottom: 1px solid #eee;
        padding-bottom: 20px;
    }
    .policy-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }
    .policy-title {
        font-size: 24px;
        font-weight: bold;
        color: #ee4d2d;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .policy-text {
        line-height: 1.8;
        color: #444;
        font-size: 15px;
    }
    .policy-text strong {
        color: #000;
    }
    .policy-text ul {
        padding-left: 20px;
        margin: 10px 0;
    }
    .policy-text li {
        margin-bottom: 5px;
    }
</style>

<div class="policy-wrapper">
    <div class="policy-sidebar">
        <h3>DANH MỤC CHÍNH SÁCH</h3>
        <ul class="policy-menu">
            <li><a href="#doitra"><i class="fa-solid fa-rotate-right"></i> Chính sách đổi trả</a></li>
            <li><a href="#baohanh"><i class="fa-solid fa-shield-halved"></i> Chính sách bảo hành</a></li>
            <li><a href="#vanchuyen"><i class="fa-solid fa-truck-fast"></i> Chính sách vận chuyển</a></li>
            <li><a href="#baomat"><i class="fa-solid fa-lock"></i> Chính sách bảo mật</a></li>
        </ul>
    </div>

    <div class="policy-content">
        
        <div id="doitra" class="policy-section">
            <h2 class="policy-title"><i class="fa-solid fa-rotate-right"></i> 1. CHÍNH SÁCH ĐỔI TRẢ</h2>
            <div class="policy-text">
                <p>Neo Sport cam kết bán hàng nguyên mới và đảm bảo đúng chất lượng. Tuy nhiên, nếu quý khách có nhu cầu đổi trả, vui lòng lưu ý các quy định sau:</p>
                <ul>
                    <li><strong>Thời gian đổi trả:</strong> Trong vòng <strong>07 ngày</strong> kể từ ngày nhận hàng.</li>
                    <li><strong>Điều kiện:</strong> Sản phẩm còn nguyên tem mác, chưa qua sử dụng, không bị dơ bẩn hay hư hỏng do lỗi người dùng.</li>
                    <li><strong>Phí đổi trả:</strong> Miễn phí nếu lỗi do nhà sản xuất (giao sai size, rách, lỗi...). Khách hàng chịu phí ship 2 chiều nếu muốn đổi size/mẫu theo nhu cầu cá nhân.</li>
                </ul>
            </div>
        </div>

        <div id="baohanh" class="policy-section">
            <h2 class="policy-title"><i class="fa-solid fa-shield-halved"></i> 2. CHÍNH SÁCH BẢO HÀNH</h2>
            <div class="policy-text">
                <p>Tất cả sản phẩm giày bóng đá tại Neo Sport đều được bảo hành keo và đế trọn đời hoặc theo thời hạn cụ thể:</p>
                <ul>
                    <li><strong>Giày Chính Hãng:</strong> Bảo hành keo trọn đời. Bảo hành đế 06 tháng.</li>
                    <li><strong>Giày Fake/Super Fake:</strong> Bảo hành keo 03 tháng.</li>
                    <li><strong>Không bảo hành:</strong> Với các lỗi do va chạm vật lý mạnh (bị rách da do đinh giày khác, bị chó cắn, hơ lửa...).</li>
                </ul>
            </div>
        </div>

        <div id="vanchuyen" class="policy-section">
            <h2 class="policy-title"><i class="fa-solid fa-truck-fast"></i> 3. CHÍNH SÁCH VẬN CHUYỂN</h2>
            <div class="policy-text">
                <p>Chúng tôi hợp tác với các đơn vị vận chuyển uy tín như GHTK, GHN, Viettel Post để giao hàng nhanh nhất đến tay quý khách:</p>
                <ul>
                    <li><strong>Nội thành TP.HCM:</strong> Giao trong 24h - 48h. Phí ship đồng giá 20.000đ.</li>
                    <li><strong>Tỉnh thành khác:</strong> Giao trong 3 - 4 ngày. Phí ship đồng giá 30.000đ.</li>
                    <li><strong>Freeship:</strong> Cho đơn hàng có giá trị từ <strong>500.000đ</strong> trở lên (chuyển khoản trước).</li>
                </ul>
            </div>
        </div>

        <div id="baomat" class="policy-section">
            <h2 class="policy-title"><i class="fa-solid fa-lock"></i> 4. CHÍNH SÁCH BẢO MẬT</h2>
            <div class="policy-text">
                <p>Neo Sport cam kết bảo mật tuyệt đối thông tin cá nhân của khách hàng:</p>
                <ul>
                    <li>Thông tin (Họ tên, SĐT, Địa chỉ) chỉ được sử dụng cho mục đích giao hàng và chăm sóc khách hàng.</li>
                    <li>Tuyệt đối không chia sẻ thông tin cho bên thứ 3 dưới mọi hình thức.</li>
                    <li>Khách hàng có quyền yêu cầu chỉnh sửa hoặc xóa dữ liệu cá nhân khỏi hệ thống bất cứ lúc nào.</li>
                </ul>
            </div>
        </div>

    </div>
</div>