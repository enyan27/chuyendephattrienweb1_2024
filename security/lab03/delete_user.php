<?php
session_start();

require_once 'models/UserModel.php';
require_once 'encodeId.php';

$userModel = new UserModel();

// Middleware
if (empty($_SESSION['id'])) {
    header('location: login.php');
    exit();
}

if (!empty($_GET['id']) && !empty($_GET['csrf_token'])) {
    // Kiểm tra token
    if (hash_equals($_SESSION['csrf_token'], $_GET['csrf_token'])) {
        $id = decodeId($_GET['id']);

        // Xóa người dùng
        if ($id) {
            $userModel->deleteUserById($id);
        }
        header('location: list_users.php');
        exit();
    } else {
        // Token không hợp lệ
        echo "Yêu cầu xóa không hợp lệ.";
        exit();
    }
} else {
    echo "Oops! Something went wrong...";
    exit();
}


/** Biện pháp câu 4:
 * 1. Sử dụng encode và decode như câu 1 để hacker khó đoán được tham số $id.
 * 
 * 2. Sử dụng middleware để kiểm tra đăng nhập trước khi thực hiện thao tác xóa trên giao diện hoặc xóa thông qua đường dẫn "http://localhost/lab03/delete_user.php?id=OQ". Nếu chưa điều hướng về trang "login.php".
 * 
 * 3. Sử dụng token đính kèm trong url.
 * 
 * 4. Phân quyền xóa hoặc chỉ cho phép xóa tài khoản chính chủ của bản thân. (Tùy chọn thêm)
 */