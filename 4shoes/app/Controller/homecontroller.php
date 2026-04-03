<?php
require_once "Model/Category.php";
require_once "Model/Brand.php";
require_once "Model/Product.php"; 
require_once "Model/User.php"; 
require_once "Model/Order.php"; 
require_once "Model/Voucher.php"; 

class homecontroller {
    public $dm;
    public $sp;
    public $order;
    public $user;
    public $vc;

    public function __construct() {
        $this->dm = new Category();
        $this->sp = new product();
        $this->order = new Order();
        $this->user = new User();
        $this->vc = new Voucher();
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    // --- 1. USER AUTH ---
    public function register() {
        include "View/shop/register.php";
    }

    public function registerPost() {
        if(isset($_POST['btn_register'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $phone = $_POST['phone'];

            if($this->user->checkEmail($email)) {
                echo "<script>alert('Email này đã được sử dụng!'); window.location.href='index.php?page=register';</script>";
            } else {
                $this->user->register($name, $email, $pass, $phone);
                echo "<script>alert('Đăng ký thành công! Vui lòng đăng nhập.'); window.location.href='index.php?page=login';</script>";
            }
        }
    }

    public function login() {
        include "View/shop/login.php";
    }

    public function loginPost() {
        if (isset($_POST['btn_login'])) {
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $user_info = $this->user->checkLogin($email, $pass);

            if ($user_info) {
                if ($user_info === "blocked") {
                    echo "<script>alert('Tài khoản của bạn đã bị chặn!'); window.location.href='index.php?page=login';</script>";
                    exit();
                }
                $_SESSION['user'] = $user_info;
                if ($user_info['role'] == 'admin') {
                    header("Location: admin.php"); 
                } else {
                    header("Location: index.php");
                }
                exit();
            } else {
                echo "<script>alert('Sai email hoặc mật khẩu!'); window.location.href='index.php?page=login';</script>";
            }
        }
    }

    public function logout() {
        unset($_SESSION['user']);
        header("Location: index.php");
    }

    // --- 2. PRODUCT ---
    public function index() {
        // Gọi 3 hàm vừa viết bên Model
        $dssp_new = $this->sp->get_new_products();          // Giày mới về
        $dssp_featured = $this->sp->get_featured_products(); // Tiêu biểu (Giá cao)
        $dssp_bestseller = $this->sp->get_bestseller_products(); // Bán chạy
        
        include "View/shop/home.php";
    }

    public function Product() {
        $cat_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'new';

        // Gọi hàm lọc
        $dssp = $this->sp->get_products_sorted($cat_id, $sort);
        
        // KHÔNG ĐƯỢC CÓ DÒNG NÀY: $dssp = $this->sp->get_all_sp();

        include "View/shop/product.php";
    }

    public function productdetail() {
        $sp_detail = null;
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = (int)$_GET['id'];
            $sp_detail = $this->sp->get_sp_byID($id);
        }
        include "View/shop/productdetail.php";
    }

    // --- 3. CART ---
   public function addToCart() {
        // ... (Giữ nguyên phần kiểm tra đăng nhập) ...
        if (!isset($_SESSION['user'])) {
            $_SESSION['thongbao'] = "Vui lòng đăng nhập để mua hàng!";
            header("Location: index.php?page=login");
            exit();
        }

        if(isset($_GET['id']) && $_GET['id'] > 0){
            $id = $_GET['id'];
            $product = $this->sp->get_sp_byID($id);
            
            $qty = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
            if($qty <= 0) $qty = 1;

            if($product){
                if(isset($_SESSION['cart'][$id])){
                    $_SESSION['cart'][$id]['quantity'] += $qty; 
                } else {
                    $_SESSION['cart'][$id] = [
                        'name' => $product['name'],
                        'price' => $product['price'],
                        'image' => $product['image'],
                        'quantity' => $qty
                    ];
                }

                // --- THAY ĐỔI Ở ĐÂY ---
                // Tạo session thông báo thành công
                $_SESSION['success_msg'] = "Đã thêm sản phẩm vào giỏ hàng thành công!";
            }
        }
        
        // Chuyển hướng lại trang trước đó bằng PHP header (mượt hơn history.back JS)
        if(isset($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            header("Location: index.php"); // Fallback nếu không tìm thấy trang trước
        }
        exit();
    }
    
    public function updateCart() {
        if(isset($_GET['id']) && isset($_GET['type'])) {
            $id = $_GET['id'];
            $type = $_GET['type'];
            if(isset($_SESSION['cart'][$id])) {
                if($type == 'increase') {
                    $_SESSION['cart'][$id]['quantity']++;
                } elseif($type == 'decrease') {
                    if($_SESSION['cart'][$id]['quantity'] > 1) {
                        $_SESSION['cart'][$id]['quantity']--;
                    } else {
                        unset($_SESSION['cart'][$id]);
                    }
                }
            }
        }
        header("Location: index.php?page=cart");
        exit(); 
    }

    public function cart() {
        $total_money = 0;
        if(!empty($_SESSION['cart'])){
            foreach($_SESSION['cart'] as $item){
                $total_money += $item['price'] * $item['quantity'];
            }
        }
        include "View/shop/cart.php";
    }

    public function deleteCart(){
        if(isset($_GET['id'])){
            unset($_SESSION['cart'][$_GET['id']]);
        }
        header("Location: index.php?page=cart");
        exit();
    }

    // --- 4. CHECKOUT & ORDER ---
    public function checkout() {
        if(!empty($_SESSION['cart'])) {
            // Lấy danh sách voucher của người dùng hiện tại
            $user_id = isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0;
            $list_vouchers = $this->vc->getVouchersForUser($user_id);

            include "View/shop/checkout.php";
        } else {
            header("Location: index.php?page=cart");
            exit();
        }
    }

    public function confirmOrder() {
        if(isset($_POST['btn_confirm']) && !empty($_SESSION['cart'])) {
            
            // 1. Tính tổng tiền gốc
            $total_money = 0;
            foreach($_SESSION['cart'] as $item){
                $total_money += $item['price'] * $item['quantity'];
            }

            // --- 2. XỬ LÝ VOUCHER (MỚI) ---
            $voucher_id = null; 
            if(isset($_SESSION['voucher'])) {
                $voucher_id = $_SESSION['voucher']['id'];
                $discount_amount = $_SESSION['voucher']['discount']; // Đây là số tiền (VD: 50000)
                
                // Đảm bảo tiền giảm không lớn hơn tổng đơn hàng
                if($discount_amount > $total_money) {
                    $discount_amount = $total_money;
                }

                $total_money = $total_money - $discount_amount; // Trừ thẳng
            }
            // -----------------------------

            // 3. Lấy dữ liệu User
            $current_user_id = isset($_SESSION['user']) ? $_SESSION['user']['id'] : 1;
            
            $full_address = $_POST['address'];
            if(isset($_POST['city']) && $_POST['city'] != "") {
                $full_address .= " - " . $_POST['city'];
            }

            $user_data = [
                'user_name' => $_POST['user_name'],
                'address'   => $full_address,
                'phone'     => $_POST['phone'],
                'email'     => $_POST['email'],
                'note'      => $_POST['note'],
                'user_id'   => $current_user_id
            ];

            // 4. Lấy phương thức thanh toán
            $payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : 'COD';

            // --- GỌI MODEL TẠO ĐƠN HÀNG (Truyền thêm $voucher_id) ---
            $order_id = $this->order->createOrder($total_money, $user_data, $payment_method, $voucher_id);

            // 5. Xử lý sau khi tạo đơn thành công
            if($order_id > 0) {
                // Lưu chi tiết đơn hàng
                foreach($_SESSION['cart'] as $product_id => $item){
                    $this->order->createOrderDetail($order_id, $product_id, $item['quantity'], $item['price']);
                }

                // Nếu dùng Voucher thì xóa session voucher đi (để không bị lưu cho đơn sau)
                if(isset($_SESSION['voucher'])) {
                    unset($_SESSION['voucher']);
                }

                // A. Nếu là MoMo -> Gọi hàm giả lập thanh toán
                if($payment_method == 'momo') {
                    $this->processMomoPayment($order_id, $total_money);
                    return; 
                } 
                
                // B. Nếu là COD -> Xóa giỏ hàng và chuyển trang thành công
                else {
                    unset($_SESSION['cart']); 
                    header("Location: index.php?page=order_success&id=" . $order_id);
                    exit();
                }
            }
        }
        // Nếu lỗi hoặc giỏ hàng rỗng
        header("Location: index.php?page=checkout");
    }
    // --- 5. MOMO PAYMENT ---
    public function processMomoPayment($order_id, $amount) {
        // Thay vì gọi API thật, ta giả định thanh toán luôn thành công
        
        // 1. Xóa giỏ hàng (vì đã đặt xong)
        unset($_SESSION['cart']);

        // 2. Cập nhật trạng thái đơn hàng (nếu muốn logic chặt chẽ hơn)
        // Ví dụ: Đổi trạng thái từ 'pending' sang 'processing' (Đã thanh toán)
        // $this->order->updateStatus($order_id, 'processing');

        // 3. Chuyển hướng sang trang báo thành công
        // Truyền thêm tham số &payment=momo để hiển thị thông báo riêng nếu cần
        echo "<script>
                alert('Đang chuyển đến cổng thanh toán MoMo...');
                setTimeout(function(){
                    alert('Thanh toán MoMo thành công!');
                    window.location.href = 'index.php?page=order_success&id=" . $order_id . "';
                }, 1000);
              </script>";
        exit();
    }

    public function execPostRequest($url, $data) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data)));
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function momo_return() {
        if(isset($_GET['resultCode']) && $_GET['resultCode'] == '0') {
            $order_id = $_GET['orderId'];
            unset($_SESSION['cart']);
            header("Location: index.php?page=order_success&id=" . $order_id);
            exit();
        } else {
            echo "<script>alert('Thanh toán thất bại!'); window.location.href='index.php?page=checkout';</script>";
        }
    }

    // --- 6. ORDER HISTORY ---
    public function myOrders() {
        if(isset($_SESSION['user'])) {
            $user_id = $_SESSION['user']['id'];
            $orders = $this->order->getOrdersByUser($user_id);
            include "View/shop/my_orders.php";
        } else {
            header("Location: index.php?page=login");
            exit();
        }
    }

    public function orderSuccess() {
        if(isset($_GET['id'])){
            $order_id = $_GET['id'];
            include "View/shop/order_success.php";
        } else {
            header("Location: index.php");
        }
    }

    public function cancelOrder() {
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->order->cancelOrder($id);
            header("Location: index.php?page=my_orders");
        }
    }

    public function orderDetailHistory() {
        if(isset($_GET['id']) && isset($_SESSION['user'])) {
            $order_id = $_GET['id'];
            $order = $this->order->getOrderById($order_id);
            $order_details = $this->order->getOrderDetails($order_id);
            include "View/shop/order_detail_history.php";
        } else {
            header("Location: index.php");
        }
    }
    // HÀM XỬ LÝ ÁP MÃ VOUCHER
    public function applyVoucher() {
        // Kiểm tra xem có nhận được ID voucher không
        if(isset($_POST['selected_voucher_id'])) {
            $id = $_POST['selected_voucher_id'];
            
            // Trường hợp chọn "Không sử dụng giảm giá" (value=0)
            if($id == 0) {
                unset($_SESSION['voucher']);
                echo "<script>alert('Đã hủy áp dụng voucher!'); window.location.href='index.php?page=checkout';</script>";
                exit();
            }

            // Trường hợp chọn voucher cụ thể
            $voucher = $this->vc->getVoucherById($id);

            if($voucher) {
                // Lưu vào session
                $_SESSION['voucher'] = [
                    'id' => $voucher['id'],
                    'code' => $voucher['code'],
                    'discount' => $voucher['discount'] // Số tiền giảm
                ];
                // Reload trang checkout
                header("Location: index.php?page=checkout");
                exit();
            } else {
                // Nếu không tìm thấy voucher trong DB
                echo "<script>alert('Lỗi: Voucher không tồn tại hoặc đã hết hạn!'); window.location.href='index.php?page=checkout';</script>";
                exit();
            }
        }
        
        // Nếu không có POST data
        header("Location: index.php?page=checkout");
        exit();
    }
    public function myVoucher() {
        // Kiểm tra đăng nhập
        if(isset($_SESSION['user'])) {
            $user_id = $_SESSION['user']['id'];
            
            // Gọi hàm getVouchersForUser đã viết ở Model Voucher
            // Hàm này sẽ lấy Voucher riêng của user + Voucher chung
            $list_vouchers = $this->vc->getVouchersForUser($user_id);
            
            include "View/shop/my_voucher.php";
        } else {
            // Chưa đăng nhập thì đá về trang login
            $_SESSION['thongbao'] = "Vui lòng đăng nhập để xem kho voucher!";
            header("Location: index.php?page=login");
            exit();
        }
    }
    // --- 10. TRANG CHÍNH SÁCH ---
    public function policy() {
        include "View/shop/policy.php";
    }
    public function contact() {
        include "View/shop/contact.php";
    }
    // --- GỬI LIÊN HỆ BẰNG PHPMAILER ---
    public function sendContact() {
        if(isset($_POST['btn_send_contact'])) {
            $name = $_POST['name'];
            $email_khach = $_POST['email']; // Email người gửi nhập vào form
            $subject = $_POST['subject'];
            $message = $_POST['message'];

            // 1. Nhúng thư viện PHPMailer (Chú ý đường dẫn phải đúng)
            require_once "Model/PHPMailer/src/Exception.php";
            require_once "Model/PHPMailer/src/PHPMailer.php";
            require_once "Model/PHPMailer/src/SMTP.php";

            $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

            try {
                // --- Cấu hình Server (Dùng Gmail làm ví dụ) ---
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com'; 
                $mail->SMTPAuth   = true;
                $mail->CharSet    = 'UTF-8'; // Để gửi tiếng Việt không lỗi font
                
                // ================================================================
                // THAY THÔNG TIN CỦA BẠN VÀO ĐÂY
                // ================================================================
                $mail->Username   = 'thienpham121106@gmail.com'; // Email của bạn (đóng vai trò server gửi)
                $mail->Password   = 'iqxj fcjm kobt jdkq';     // MẬT KHẨU ỨNG DỤNG (16 ký tự)
                // ================================================================

                $mail->SMTPSecure = 'tls'; // Giao thức bảo mật
                $mail->Port       = 587;   // Port của Gmail

                // --- Thiết lập người gửi và người nhận ---
                // Người gửi: Hệ thống (hoặc chính bạn)
                $mail->setFrom('zyzy121106@gmail.com', '4Shoes Sport - Hỗ trợ');
                
                // Người nhận: Là Admin (chính bạn hoặc nhân viên)
                $mail->addAddress('hehethien7@gmail.com'); 
                
                // (Tùy chọn) Reply-To: Để khi bạn bấm Reply, nó sẽ trả lời vào email của khách
                $mail->addReplyTo($email_khach, $name);

                // --- Nội dung Email ---
                $mail->isHTML(true);
                $mail->Subject = "[LIÊN HỆ MỚI] " . $subject;
                $mail->Body    = "
                    <h3>Bạn nhận được liên hệ mới từ website:</h3>
                    <p><strong>Họ tên khách:</strong> $name</p>
                    <p><strong>Email khách:</strong> $email_khach</p>
                    <p><strong>Nội dung:</strong><br>$message</p>
                ";
                $mail->AltBody = "Khách hàng $name ($email_khach) nhắn: $message"; // Cho trình duyệt không hỗ trợ HTML

                $mail->send();
                
                // Thông báo thành công
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Đã gửi thành công!',
                        text: 'Chúng tôi sẽ phản hồi bạn sớm nhất có thể.',
                        confirmButtonColor: '#ee4d2d'
                    }).then(() => {
                        window.location.href = 'index.php?page=contact';
                    });
                </script>";

            } catch (Exception $e) {
                // Thông báo lỗi
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Gửi thất bại',
                        text: 'Lỗi: {$mail->ErrorInfo}',
                        confirmButtonColor: '#ee4d2d'
                    }).then(() => {
                        window.location.href = 'index.php?page=contact';
                    });
                </script>";
            }
            exit(); // Dừng code để không chạy lung tung
        }
    }
}
?>