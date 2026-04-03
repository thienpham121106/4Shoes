<?php
require_once "Model/Category.php";
require_once "Model/Brand.php";
require_once "Model/Product.php";
require_once "Model/User.php";
require_once "Model/Order.php"; 
require_once "Model/Voucher.php"; // 1. Require file Voucher

class AdminController {
    public $br;
    public $sp;
    public $us;
    public $od; 
    public $vc; // 2. Khai báo biến vc

    public function __construct() {
        $this->br = new Brand();
        $this->sp = new Product();
        $this->us = new User();
        $this->od = new Order();
        $this->vc = new Voucher(); // 3. Khởi tạo đối tượng Voucher
    }

    // --- 1. QUẢN LÝ SẢN PHẨM ---
    public function product() {
        if(isset($_GET['id'])) {
            $this->sp->delete_sp($_GET['id']);
            header("location:admin.php?page=product");
            exit;
        }
        $dssp = $this->sp->get_all_sp();
        include "View/admin/product.php";
    }

    public function product_form() {
        $dsbr = $this->br->get_all_BR();
        $catModel = new Category();
        $dscategory = $catModel->get_all_categories();

        if(isset($_GET['idedit'])) {
            $sp_edit = $this->sp->get_sp_byID($_GET['idedit']);
        }

        if(isset($_POST['add_sp'])) {
            $imageName = "";
            if(isset($_FILES['image']) && $_FILES['image']['name'] != "") {
                $imageName = basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], "public/images/".$imageName);
            }
            $this->sp->add_sp(
                $_POST['category_id'], $_POST['brand_id'], $_POST['name'], 
                $_POST['price'], $_POST['description'], $imageName, $_POST['stock']
            );
            header("location:admin.php?page=product"); 
            exit;
        }

        if(isset($_POST['update_sp'])) {
            $imageName = $sp_edit['image'];
            if(isset($_FILES['image']) && $_FILES['image']['name'] != "") {
                $imageName = basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], "public/images/".$imageName);
            }
            $this->sp->update_sp(
                $_GET['idedit'], $_POST['category_id'], $_POST['brand_id'], $_POST['name'], 
                $_POST['price'], $_POST['description'], $imageName, $_POST['stock']
            );
            header("location:admin.php?page=product"); 
            exit;
        }
        include "View/admin/product_form.php";
    }

    // --- 2. QUẢN LÝ THƯƠNG HIỆU ---
    public function brand() {
        if(isset($_POST['add_cat'])) {
            $name = $_POST['catname'];
            if(isset($_GET['idedit'])) {
                $this->br->update_br($_GET['idedit'], $name);
            } else {
                $this->br->add_br($name);
            }
            header("location:admin.php?page=brand"); 
            exit;
        }

        if(isset($_GET['id'])) {
            $this->br->xoa_br($_GET['id']);
            header("location:admin.php?page=brand"); 
            exit;
        }

        $dsbr = $this->br->get_all_BR();
        if(isset($_GET['idedit'])) {
            $br_edit = $this->br->get_br_byID($_GET['idedit']);
        }
        include "View/admin/brand.php";
    }

    // --- 3. QUẢN LÝ NGƯỜI DÙNG ---
    public function user() {
        $dsuser = $this->us->get_all_user();
        include "View/admin/user.php";
    }

    public function user_form() {
        if(isset($_GET['idedit'])) {
            $user_edit = $this->us->get_user_byID($_GET['idedit']);
            $user_edit = $user_edit[0]; 
        }

        if(isset($_POST['add_user'])) {
            $this->us->add_user(
                $_POST['name'], $_POST['email'], $_POST['password'], 
                $_POST['role'], $_POST['phone']
            );
            header("location:admin.php?page=user"); 
            exit;
        }
        include "View/admin/user_form.php";
    }

    public function blockUser($id) { 
        $this->us->blockUser($id); 
        header("Location: admin.php?page=user"); exit; 
    }
    public function unblockUser($id) { 
        $this->us->unblockUser($id); 
        header("Location: admin.php?page=user"); exit; 
    }
    public function hideUser($id) { 
        $this->us->hideUser($id); 
        header("Location: admin.php?page=user"); exit; 
    }
    public function showUser($id) { 
        $this->us->showUser($id); 
        header("Location: admin.php?page=user"); exit; 
    }

    // --- 4. QUẢN LÝ ĐƠN HÀNG ---
    public function order() {
        if(isset($_POST['update_status'])) {
            $id = $_POST['order_id'];
            $status = $_POST['status'];
            $this->od->updateStatus($id, $status);
            header("Location: admin.php?page=order");
            exit;
        }
        $dsorder = $this->od->get_all_orders();
        include "View/admin/order.php";
    }

    // --- 5. QUẢN LÝ VOUCHER ---
    public function voucher() {
        if(isset($_GET['id'])) {
            $this->vc->delete($_GET['id']);
            header("location:admin.php?page=voucher");
            exit;
        }
        $dsvc = $this->vc->get_all();
        include "View/admin/voucher.php";
    }

    public function voucher_form() {
        if(isset($_GET['idedit'])) {
            $vc_edit = $this->vc->get_by_id($_GET['idedit']);
            $vc_edit = $vc_edit[0];
        }

        if(isset($_POST['add_vc'])) {
            $this->vc->add($_POST['code'], $_POST['discount'], $_POST['quantity']);
            header("location:admin.php?page=voucher"); exit;
        }

        if(isset($_POST['update_vc'])) {
            $this->vc->update($_GET['idedit'], $_POST['code'], $_POST['discount'], $_POST['quantity']);
            header("location:admin.php?page=voucher"); exit;
        }
        include "View/admin/voucher_form.php";
    }
}
?>