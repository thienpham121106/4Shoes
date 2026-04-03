<?php
include_once 'Model/Database.php';

class Voucher {
    public $db;
    public function __construct() {
        $this->db = new Database('localhost','da1_4shoes_wd20302','root','');
        $this->db->connect();
    }

    public function get_all() {
        $sql = "SELECT * FROM vouchers";
        return $this->db->get_all($sql);
    }

    public function get_by_id($id) {
        $sql = "SELECT * FROM vouchers WHERE id = $id";
        return $this->db->get_all($sql);
    }

    public function add($code, $discount, $quantity, $user_id = null) {
        // Nếu user_id rỗng thì lưu là NULL
        $user_val = empty($user_id) ? "NULL" : $user_id;
        $sql = "INSERT INTO vouchers (code, discount, quantity, user_id) VALUES ('$code', '$discount', '$quantity', $user_val)";
        return $this->db->action($sql);
    }

    public function update($id, $code, $discount, $quantity) {
        $sql = "UPDATE vouchers SET code='$code', discount='$discount', quantity='$quantity' WHERE id=$id";
        return $this->db->action($sql);
    }

    public function delete($id) {
        $sql = "DELETE FROM vouchers WHERE id=$id";
        return $this->db->action($sql);
    }

    // Hàm kiểm tra mã giảm giá cho trang Checkout
    public function checkVoucher($code) {
        $sql = "SELECT * FROM vouchers WHERE code = '$code' AND quantity > 0 AND status = 1";
        $result = $this->db->get_all($sql);
        return $result[0] ?? null;
    }

    // Hàm trừ số lượng voucher sau khi đặt hàng thành công
    public function decreaseQuantity($id) {
        $sql = "UPDATE vouchers SET quantity = quantity - 1 WHERE id = $id";
        return $this->db->action($sql);
    }
    public function getVouchersForUser($user_id) {
        // Lấy voucher CỦA RIÊNG USER (user_id = $user_id) HOẶC voucher CHUNG (user_id IS NULL)
        // Và phải còn số lượng (quantity > 0)
        $sql = "SELECT * FROM vouchers 
                WHERE (user_id = $user_id OR user_id IS NULL) 
                AND quantity > 0 
                AND status = 1";
        return $this->db->get_all($sql);
    }

    // Lấy thông tin 1 voucher cụ thể theo ID (để xử lý khi chọn)
    public function getVoucherById($id) {
        $sql = "SELECT * FROM vouchers WHERE id = $id";
        $result = $this->db->get_all($sql);
        return $result[0] ?? null;
    }
}
?>