<?php
    if(isset($br_edit)) {
        $name = $br_edit[0]['name'];
    } else {
        $name = '';
    }

?>  
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funda Web IT Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../public/ASM-js/admin.css/category.css">
    <link rel="stylesheet" href="../public/ASM-js/admin.css/product.css">
    <link rel="stylesheet" href="../public/ASM-js/admin.css/product-form.css">
    <link rel="stylesheet" href="../public/ASM-js/admin.css/user-form.css">
    </head>
<body>

    <aside class="sidebar">
        <div class="sidebar-brand">
            <i class="fa-solid fa-face-laugh-wink" style="margin-right: 10px;"></i>
            4 Shoes
        </div>

        <div class="sidebar-menu">
            <a href="admin.php" class="nav-item">
                <i class="fa-solid fa-gauge-high"></i>
                <span>Dashboard</span>
            </a>

            <div class="nav-header">Interface</div>

            <a href="?page=product" class="nav-item">
                <i class="fa-solid fa-box"></i>
                <span>Sản phẩm</span>
            <a href="?page=voucher" class="nav-item">
    <i class="fa-solid fa-ticket"></i>
    <span>Voucher</span>
</a>

            <a href="?page=brand" class="nav-item">
                <i class="fa-solid fa-tag"></i>
                <span>Thương hiệu</span>
            </a>

            <a href="?page=user" class="nav-item">
                <i class="fa-solid fa-users"></i>
                <span>Người dùng</span>
            </a>

            <a href="?page=order" class="nav-item">
                <i class="fa-solid fa-cart-shopping"></i>
                <span>Đơn hàng</span>
            </a>


            
            <div style="margin-top: auto; padding: 20px; text-align: center;">
                <div style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; cursor: pointer;">
                     <i class="fa-solid fa-chevron-left"></i>
                </div>
            </div>
        </div>
    </aside>

    <div class="main-content">
        
        <header class="topbar">
            <div class="search-box">
                <input type="text" placeholder="Tìm kiếm...">
                <button><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>

            <div class="user-profile">
                <i class="fa-solid fa-bell" style="color: #d1d3e2; margin-right: 15px;"></i>
                <i class="fa-solid fa-envelope" style="color: #d1d3e2; margin-right: 15px;"></i>
                <div style="border-left: 1px solid #e3e6f0; height: 30px; margin-right: 15px;"></div>
                
                <span style="margin-right: 10px;">
                    <?php echo isset($_SESSION['user']) ? $_SESSION['user']['name'] : 'Admin'; ?>
                </span>

                <div class="user-avatar" style="width: 35px; height: 35px; background: #eaecf4; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fa-regular fa-user" style="color: #4e73df; font-size: 18px;"></i>
                </div>
            </div>
        </header>

        <div class="container-fluid">
    