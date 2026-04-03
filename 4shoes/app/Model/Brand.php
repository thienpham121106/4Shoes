<?php
include_once 'Model/Database.php';
class Brand{
    // connect tới DB
    public $db;
    public function __construct() {
        $this->db = new Database('localhost','da1_4shoes_wd20302','root','');
        $this->db->connect();
    }

    // phương thức lấy ra tất cả danh mục

    public function get_all_BR() {
        $sql = "SELECT * FROM brands";
        return $this->db->get_all($sql);
    }
    // phương thức thêm danh mục mới
    public function add_br($name) {
        $sql = "INSERT INTO brands (name) VALUES ('{$name}')";
        return $this->db->action($sql);
    }

    // phương thức xoá danh mục

    public function xoa_br($id) {
        $sql = "DELETE FROM brands WHERE `id` = {$id}";
        return $this->db->action($sql);
    }
    // phương thức update danh mục
    public function update_br($id,$name) {
        $sql = "UPDATE `brands` SET `name` = '{$name}' WHERE `id` = {$id}";
        return $this->db->action($sql);
    }
    // lọc danh mục theo ID
    public function get_br_byID($id) {
        $sql = "SELECT * FROM brands WHERE id={$id}";
        return $this->db->get_all($sql);
    }
}


?>