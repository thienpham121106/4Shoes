<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neo Sport</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../public/ASM-js/shop.css/index.css">
    <link rel="stylesheet" href="../public/ASM-js/shop.css/header.css">
    <link rel="stylesheet" href="../public/ASM-js/shop.css/footer.css">
    <link rel="stylesheet" href="../public/ASM-js/shop.css/productdetail.css">
    <link rel="stylesheet" href="../public/ASM-js/shop.css/cart.css">
    <link rel="stylesheet" href="../public/ASM-js/shop.css/checkout.css">
    <link rel="stylesheet" href="../public/ASM-js/shop.css/login.css">
    <link rel="stylesheet" href="../public/ASM-js/shop.css/register.css">

    <style>
        .header-icon {
            display: flex;
            align-items: center;
            gap: 20px; /* Khoảng cách giữa User và Cart */
        }
        
        /* User Dropdown */
        .user-dropdown {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background-color: white;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1000;
            border-radius: 5px;
            border: 1px solid #eee;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            font-size: 14px;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
            color: #ee4d2d;
        }

        .user-dropdown:hover .dropdown-content {
            display: block;
        }
        /* --- CSS CHO MENU NAVIGATION --- */
.menu {
    list-style: none; /* Bỏ dấu chấm đầu dòng */
    padding: 0;
    margin: 10px 0 0 0; /* Cách phần trên một chút */
    display: flex; /* Xếp các mục thành hàng ngang */
    justify-content: center; /* Căn giữa màn hình */
    flex-wrap: wrap; /* Tự động xuống dòng nếu màn hình bé */
    background-color: #fff; /* Nền trắng */
    border-top: 1px solid #eee; /* Đường kẻ mờ ngăn cách với header */
    border-bottom: 2px solid #f5f5f5; /* Đường kẻ đậm hơn ở dưới */
}

.menu li {
    position: relative;
}

.menu li a {
    display: block; /* Để nhận padding */
    padding: 15px 18px; /* Khoảng cách giữa các mục menu */
    text-decoration: none; /* Bỏ gạch chân */
    color: #333; /* Màu chữ đen xám sang trọng */
    font-weight: 700; /* Chữ đậm */
    font-size: 13px; /* Kích thước chữ vừa vặn */
    text-transform: uppercase; /* VIẾT HOA TOÀN BỘ */
    font-family: 'Segoe UI', sans-serif;
    transition: all 0.3s ease; /* Hiệu ứng chuyển màu mượt */
}

/* Hiệu ứng khi di chuột vào */
.menu li a:hover {
    color: #ee4d2d; /* Đổi màu cam thương hiệu */
    background-color: #fafafa; /* Nền hơi xám nhẹ */
}

/* Style riêng cho mục SALE Tốt để nổi bật */
.menu li a[href*="SALE"] {
    color: #ee4d2d;
}
    </style>
</head>
<body>
    <header>
        <a href="index.php?page=index">
            <img class="logo" src="../public/ASM-js/images/4shoes.png" alt="Neo Sport Logo">
        </a>

        <div class="input-box">
            <input type="text" placeholder="Tìm kiếm sản phẩm..." > 
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
        
        <div class="header-icon">
            
            <?php if(isset($_SESSION['user'])): ?>
                <div class="user-dropdown">
                    <div style="display: flex; align-items: center; gap: 5px; color: black;">
                        <i class="fa-regular fa-user"></i>
                        <span style="font-size: 14px; font-weight: bold;">
                            <?= $_SESSION['user']['name'] ?>
                        </span>
                        <i class="fa-solid fa-caret-down" style="font-size: 10px;"></i>
                    </div>

                    <div class="dropdown-content">
                        <a href="index.php?page=profile">
                            <i class="fa-regular fa-id-card"></i> Thông tin
                        </a>
                        <a href="index.php?page=my_orders">
                            <i class="fa-solid fa-box-open"></i> Đơn hàng
                        </a>
                        <a href="index.php?page=my_voucher">
                            <i class="fa-solid fa-ticket"></i> Voucher của tôi
                        </a>
                        <a href="index.php?page=logout" style="color: red;">
                            <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <a href="index.php?page=login" style="color: black; text-decoration: none; display: flex; flex-direction: column; align-items: center;">
                    <i class="fa-regular fa-user"></i>
                    <p style="margin: 0; font-size: 12px;">Đăng nhập</p>
                </a>
            <?php endif; ?>

            <a href="index.php?page=cart" class="cart-link" style="text-decoration: none; color: black; display: flex; flex-direction: column; align-items: center;">
                <div style="position: relative;">
                    <i class="fa-solid fa-cart-flatbed"></i>
                    <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                        <span style="position: absolute; top: -8px; right: -10px; background: red; color: white; font-size: 10px; padding: 2px 5px; border-radius: 50%;">
                            <?= count($_SESSION['cart']) ?>
                        </span>
                    <?php endif; ?>
                </div>
                <p style="margin: 0; font-size: 12px;">Giỏ hàng</p>
            </a>

        </div>
    </header>

    
        <ul class="menu">
    <li><a href="index.php?page=index">Trang Chủ</a></li>
    <li><a href="index.php?page=product">Sản phẩm</a></li>
    <li><a href="index.php?page=policy">Chính sách</a></li>
    <li><a href="index.php?page=contact">Liên hệ</a></li>
</ul>
    

    <?php
        if(isset($_SESSION['thongbao'])) {
            echo "<script>alert('" . $_SESSION['thongbao'] . "');</script>";
            unset($_SESSION['thongbao']);
        }
    ?>