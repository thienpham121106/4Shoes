<?php
include_once 'Model/Database.php';

class Product {
    public $db;
    public function __construct() {
        $this->db = new Database('localhost','da1_4shoes_wd20302','root','');
        $this->db->connect();
    }

public function get_all_sp() {
    $sql = "SELECT p.*, 
                   b.name AS brand_name, 
                   c.name AS category_name
            FROM products p
            JOIN brands b ON p.brand_id = b.id
            JOIN categories c ON p.category_id = c.id";
    return $this->db->get_all($sql);
}


    public function get_sp_byID($id) {
        $sql = "SELECT * FROM products WHERE id={$id}";
        $result = $this->db->get_all($sql);
        return $result[0] ?? null;
    }

    public function add_sp($category_id, $brand_id, $name, $price, $description, $image, $stock) {
        $sql = "INSERT INTO products (category_id, brand_id, name, price, description, image, stock) 
                VALUES ('{$category_id}', '{$brand_id}', '{$name}', '{$price}', '{$description}', '{$image}', '{$stock}')";
        return $this->db->action($sql);
    }

public function update_sp($id, $category_id, $brand_id, $name, $price, $description, $image, $stock) {
    $sql = "UPDATE products SET 
                category_id='{$category_id}', 
                brand_id='{$brand_id}', 
                name='{$name}', 
                price='{$price}', 
                description='{$description}', 
                image='{$image}', 
                stock='{$stock}'
            WHERE id={$id}";
    return $this->db->action($sql);
    }

    public function delete_sp($id) {
        $sql = "DELETE FROM products WHERE id={$id}";
        return $this->db->action($sql);
    }
    // 1. Lấy 10 sản phẩm MỚI NHẤT
    public function get_new_products() {
        $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 10";
        return $this->db->get_all($sql);
    }

    // 2. Lấy 10 sản phẩm TIÊU BIỂU (Giá cao đến thấp)
    public function get_featured_products() {
        $sql = "SELECT * FROM products ORDER BY price DESC LIMIT 10";
        return $this->db->get_all($sql);
    }

    // 3. Lấy 10 sản phẩm BÁN CHẠY (Ngẫu nhiên hoặc theo view)
    public function get_bestseller_products() {
        // WHERE stock > 0: Chỉ lấy những sản phẩm vẫn còn hàng
        // ORDER BY stock ASC: Số lượng càng ít (gần hết) thì xếp lên đầu
        $sql = "SELECT * FROM products WHERE stock > 0 ORDER BY stock ASC LIMIT 10";
        return $this->db->get_all($sql);
    }
    public function get_products_sorted($categoryId = 0, $sort = 'new') {
        $sql = "SELECT * FROM products WHERE 1"; // WHERE 1 để dễ nối chuỗi

        // 1. Nếu đang xem danh mục cụ thể thì lọc theo danh mục đó
        if ($categoryId > 0) {
            $sql .= " AND category_id = $categoryId";
        }

        // 2. Xử lý sắp xếp
        switch ($sort) {
            case 'price_asc':
                $sql .= " ORDER BY price ASC"; // Giá thấp đến cao
                break;
            case 'price_desc':
                $sql .= " ORDER BY price DESC"; // Giá cao đến thấp
                break;
           case 'bestseller':
                // SỬA Ở ĐÂY: Tồn kho thấp (ASC) nghĩa là bán chạy
                $sql .= " ORDER BY stock ASC"; 
                break;
            default:
                $sql .= " ORDER BY id DESC"; // Mặc định là mới nhất
                break;
        }

        return $this->db->get_all($sql);
    }
    
}
?>
