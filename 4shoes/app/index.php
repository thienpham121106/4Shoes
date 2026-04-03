<?php
    // 1. Bắt đầu bộ đệm đầu ra (QUAN TRỌNG: Để khắc phục lỗi header khi chuyển trang)
    ob_start(); 

    include_once "Controller/homecontroller.php";
    $controller = new homecontroller();
    
    // 2. Header hiển thị chung
    include "View/shop/header.php";

    // 3. Lấy tham số page, mặc định là index
    $page = isset($_GET['page']) ? $_GET['page'] : 'index';

    // 4. Điều hướng (Routing) an toàn bằng Switch Case
    switch ($page) {
        // --- TRANG CHÍNH ---
        case 'index':
            $controller->index();
            break;

        case 'product':
            // Nếu bạn có hàm product trong controller
            if(method_exists($controller, 'Product')) $controller->Product();
            else $controller->index(); 
            break;

        case 'productdetail':
            $controller->productdetail();
            break;

        // --- CHỨC NĂNG GIỎ HÀNG & MUA HÀNG ---
        case 'cart':
            $controller->cart();
            break;

        case 'addtocart':
            $controller->addToCart();
            break;
        case 'update_cart':
            $controller->updateCart();
            break;

        case 'deletecart':
            $controller->deleteCart();
            break;

        case 'checkout':
            $controller->checkout();
            break;

        case 'confirm_order':
            $controller->confirmOrder(); // Xử lý đặt hàng
            break;

        case 'order_success':
            $controller->orderSuccess(); // Trang cảm ơn
            break;

        // --- CHỨC NĂNG TÀI KHOẢN (Đăng nhập/Đăng ký) ---
        case 'login':
            $controller->login();
            break;
            
        case 'loginPost':
            $controller->loginPost();
            break;
        case 'my_orders':
            $controller->myOrders(); // Gọi hàm hiển thị lịch sử đơn hàng
            break;

        case 'register':
            $controller->register();
            break;

        case 'registerPost':
            $controller->registerPost();
            break;

        case 'logout':
            $controller->logout();
            break;
        case 'order_detail_history':
            $controller->orderDetailHistory();
            break;
        case 'cancel_order':
        $controller->cancelOrder();
        break;
        case 'momo_return':
            $controller->momo_return();
            break;
        case 'apply_voucher':
        $controller->applyVoucher();
        break;
        case 'my_voucher':
            $controller->myVoucher();
            break;
            case 'policy':
            $controller->policy();
            break;
            case 'contact':
    $controller->contact(); // Hàm này chỉ include file view contact.php
    break;
    

case 'send_contact':
    $controller->sendContact(); // Hàm này xử lý gửi mail
    break;
        
        // --- MẶC ĐỊNH ---
        default:
            $controller->index();
            break;
    }

    // 5. Footer hiển thị chung
    include "View/shop/footer.php";

    // 6. Kết thúc bộ đệm và xuất HTML
    ob_end_flush(); 
?>