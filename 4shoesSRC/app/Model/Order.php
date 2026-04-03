<?php
// Nhúng file Database giống như Product.php
include_once 'Model/Database.php';

class Order {
    public $db;

    public function __construct() {
        // Khởi tạo kết nối DB
        $this->db = new Database('localhost', 'da1_4shoes_wd20302', 'root', '');
        $this->db->connect();
    }

    // --- HÀM TẠO ĐƠN HÀNG (ĐÃ SỬA ĐỂ NHẬN PHƯƠNG THỨC THANH TOÁN) ---
    public function createOrder($total_money, $user_data, $payment_method = 'COD', $voucher_id = null) {
        $servername = "localhost";
        $username = "root"; 
        $password = ""; 
        $dbname = "da1_4shoes_wd20302"; 

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Câu lệnh SQL
            $sql = "INSERT INTO orders (user_name, address, phone, email, note, total_price, order_date, user_id, voucher_id, status, payment_method) 
                    VALUES (?, ?, ?, ?, ?, ?, NOW(), ?, ?, ?, ?)";
            
            $stmt = $conn->prepare($sql);
            
            // Kiểm tra User ID (Nếu không có thì mặc định là 1)
            $final_user_id = !empty($user_data['user_id']) ? $user_data['user_id'] : 1;
            
            // Thực thi câu lệnh
            $stmt->execute([
                $user_data['user_name'],
                $user_data['address'],
                $user_data['phone'],
                $user_data['email'],
                $user_data['note'],
                $total_money,
                $final_user_id, 
                $voucher_id, // <--- Thay null bằng biến này
                'pending',
                $payment_method 
            ]);

            return $conn->lastInsertId();
        } catch(PDOException $e) {
            echo "Lỗi SQL: " . $e->getMessage();
            die();
        }
    }

    // Hàm lưu chi tiết đơn hàng
    public function createOrderDetail($order_id, $product_id, $quantity, $price) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "da1_4shoes_wd20302"; 

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$order_id, $product_id, $quantity, $price]);
            
        } catch(PDOException $e) {
            echo "Lỗi chi tiết đơn hàng: " . $e->getMessage();
        }
    }

    // Hàm lấy thông tin đơn hàng theo ID
    public function getOrderById($id) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "da1_4shoes_wd20302";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM orders WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return [];
        }
    }

    // Lấy danh sách đơn hàng của User
    public function getOrdersByUser($user_id) {
        $sql = "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY id DESC";
        return $this->db->get_all($sql);
    }

    // Hủy đơn hàng
    public function cancelOrder($id) {
        $sql = "UPDATE orders SET status = 'cancelled' WHERE id = $id";
        return $this->db->action($sql);
    }

    // Lấy chi tiết sản phẩm trong đơn hàng
    public function getOrderDetails($order_id) {
        $sql = "SELECT od.*, p.name, p.image 
                FROM order_details od 
                JOIN products p ON od.product_id = p.id 
                WHERE od.order_id = $order_id";
        return $this->db->get_all($sql);
    }

    // Lấy tất cả đơn hàng (Cho Admin)
    public function get_all_orders() {
        $sql = "SELECT * FROM orders ORDER BY id DESC";
        return $this->db->get_all($sql);
    }

    // Cập nhật trạng thái đơn hàng (Cho Admin)
    public function updateStatus($id, $status) {
        $sql = "UPDATE orders SET status = '$status' WHERE id = $id";
        return $this->db->action($sql);
    }
}
?>