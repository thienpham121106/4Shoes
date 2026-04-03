<style>
    .contact-wrapper {
        max-width: 800px;
        margin: 50px auto;
        padding: 40px;
        background: #fff;
        box-shadow: 0 0 20px rgba(0,0,0,0.05);
        border-radius: 8px;
    }
    .contact-title {
        text-align: center;
        color: #ee4d2d;
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 30px;
        text-transform: uppercase;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
    }
    .form-control {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        outline: none;
        transition: 0.3s;
        box-sizing: border-box; /* Quan trọng để không bị tràn khung */
    }
    .form-control:focus {
        border-color: #ee4d2d;
        box-shadow: 0 0 5px rgba(238, 77, 45, 0.2);
    }
    .btn-send-mail {
        width: 100%;
        padding: 15px;
        background-color: #ee4d2d;
        color: white;
        border: none;
        font-weight: bold;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
        text-transform: uppercase;
        transition: 0.3s;
    }
    .btn-send-mail:hover {
        background-color: #c0392b;
    }
</style>

<div class="contact-wrapper">
    <h2 class="contact-title">Liên Hệ Với Chúng Tôi</h2>
    
    <form action="index.php?page=send_contact" method="POST">
        <div class="form-group">
            <label>Họ và tên</label>
            <input type="text" name="name" class="form-control" placeholder="Nhập họ tên của bạn" required>
        </div>
        
        <div class="form-group">
            <label>Email của bạn</label>
            <input type="email" name="email" class="form-control" placeholder="Nhập email để nhận phản hồi" required>
        </div>

        <div class="form-group">
            <label>Tiêu đề</label>
            <input type="text" name="subject" class="form-control" placeholder="Bạn cần hỗ trợ vấn đề gì?" required>
        </div>

        <div class="form-group">
            <label>Nội dung tin nhắn</label>
            <textarea name="message" class="form-control" rows="5" placeholder="Nhập nội dung chi tiết..." required></textarea>
        </div>

        <button type="submit" name="btn_send_contact" class="btn-send-mail">
            <i class="fa-solid fa-paper-plane"></i> Gửi Tin Nhắn
        </button>
    </form>
</div>