<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// include_once "Controller/admincontroller.php";
// $Admincontroller = new admincontroller();

// include "View/admin/header.php";

// $page = $_GET['page'] ?? 'brand'; // mặc định là brand

// if (method_exists($Admincontroller, $page)) {
//     $Admincontroller->$page();
// } else {
//     $Admincontroller->brand();
// }

// include "View/admin/footer.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once "Controller/AdminController.php";
$Admincontroller = new AdminController();

include "View/admin/header.php";

$page = $_GET['page'] ?? 'brand';
$id   = $_GET['id']   ?? null;

if (method_exists($Admincontroller, $page)) {
    // Nếu hàm cần id thì truyền vào
    if (in_array($page, ['blockUser','unblockUser','hideUser','showUser']) && $id !== null) {
        $Admincontroller->$page($id);
    } else {
        $Admincontroller->$page();
    }
} else {
    $Admincontroller->brand();
}

include "View/admin/footer.php";
?>
