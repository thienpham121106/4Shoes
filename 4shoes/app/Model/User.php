<?php
include_once 'Model/Database.php';

class User {
    public $db;
    public function __construct() {
        // Kết nối đúng tên DB của bạn
        $this->db = new Database('localhost','da1_4shoes_wd20302','root','');
        $this->db->connect();
    }

    // 1. Đăng ký thành viên mới
    public function register($name, $email, $password, $phone) {
        // Mã hóa mật khẩu
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $role = 'user'; 

        $sql = "INSERT INTO users (name, email, password, role, phone) 
                VALUES ('$name', '$email', '$hashed_password', '$role', '$phone')";
        
        return $this->db->action($sql);
    }

    // 2. Kiểm tra email đã tồn tại chưa
    public function checkEmail($email) {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $this->db->get_all($sql);
        return count($result) > 0; 
    }

    // 3. Kiểm tra đăng nhập
    // public function checkLogin($email, $password) {
    //     $sql = "SELECT * FROM users WHERE email='$email'";
    //     $result = $this->db->get_all($sql);

    //     if (count($result) > 0) {
    //         $user = $result[0];
    //         if (password_verify($password, $user['password'])) {
    //             return $user; 
    //         }
    //     }
    //     return false; 
    // }
    public function checkLogin($email, $password) {
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $this->db->connect()->prepare($sql);
    $stmt->execute([':email' => $email]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
        $user = $result[0];

        // Kiểm tra mật khẩu
        if (password_verify($password, $user['password'])) {
            // Kiểm tra trạng thái block
            if ($user['is_blocked'] == 1) {
                return "blocked"; // trả về trạng thái đặc biệt
            }
            return $user; // hợp lệ
        }
    }
    return false; 
}


    // --- BỔ SUNG HÀM NÀY ĐỂ SỬA LỖI ADMIN ---
    // 4. Lấy danh sách tất cả người dùng
    public function get_all_user() {
        $sql = "SELECT * FROM users ORDER BY id DESC"; // Lấy tất cả, người mới nhất lên đầu
        return $this->db->get_all($sql);
    }
    public function add_user($name, $email, $password, $role, $phone) {
    // Nên mã hoá mật khẩu trước khi lưu
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (name, email, password, role, phone) 
            VALUES ('{$name}', '{$email}', '{$hashedPassword}', '{$role}', '{$phone}')";
    return $this->db->action($sql);
}
    public function get_user_byID($id) {
        $sql = "SELECT * FROM users WHERE id = {$id}";
        return $this->db->get_all($sql);
    }

// Block user
public function blockUser($id) {
    $sql = "UPDATE users SET is_blocked = 1 WHERE id = :id";
    $stmt = $this->db->connect()->prepare($sql);
    return $stmt->execute([':id' => $id]); // true/false
}

// Unblock user
public function unblockUser($id) {
    $sql = "UPDATE users SET is_blocked = 0 WHERE id = :id";
    $stmt = $this->db->connect()->prepare($sql);
    return $stmt->execute([':id' => $id]);
}

// Hide user
public function hideUser($id) {
    $sql = "UPDATE users SET is_hidden = 1 WHERE id = :id";
    $stmt = $this->db->connect()->prepare($sql);
    return $stmt->execute([':id' => $id]);
}

// Show user
public function showUser($id) {
    $sql = "UPDATE users SET is_hidden = 0 WHERE id = :id";
    $stmt = $this->db->connect()->prepare($sql);
    return $stmt->execute([':id' => $id]);
}



}
?>