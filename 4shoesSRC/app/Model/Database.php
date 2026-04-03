<?php
class Database {
    private $db_host;
    private $db_name;
    private $db_user;
    private $db_pass;
    private $connect;

    public function __construct($db_host,$db_name,$db_user,$db_pass) {
        $this->db_host = $db_host;
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
    }

    // phương thức kết nối
    public function connect() {
        if ($this->connect === null) {
            try {
                $this->connect = new PDO(
                    "mysql:host={$this->db_host};dbname={$this->db_name};charset=utf8",
                    $this->db_user,
                    $this->db_pass
                );
                $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
        return $this->connect; // ✅ luôn trả về PDO
    }

    // phương thức hiển thị tất cả dữ liệu có trong DB
    public function get_all($sql) {
        $stmt = $this->connect()->prepare($sql); // gọi connect() để chắc chắn có PDO
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // phương thức thêm, sửa, xoá
    public function action($sql) {
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount(); // trả về số dòng update/delete
    }
}
?>
