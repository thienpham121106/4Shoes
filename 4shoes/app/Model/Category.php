<?php
include_once 'Model/Database.php';

class Category {
    public $db;
    public function __construct() {
        $this->db = new Database('localhost','da1_4shoes_wd20302','root','');
        $this->db->connect();
    }

    public function get_all_categories() {
        $sql = "SELECT * FROM categories";
        return $this->db->get_all($sql);
    }
}
?>
