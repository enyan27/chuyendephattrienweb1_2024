<?php
// Start the session
session_start();
require_once 'models/UserModel.php';
require_once 'encodeId.php';
$userModel = new UserModel();

$user = NULL; // Add new user
$_id = NULL;
$isInvalidId = false; // Flag to check if id is invalid

if (!empty($_GET['id'])) {
    $_id = $_GET['id'];
    $_id = decodeId($_id);

    // Kiểm tra tính hợp lệ của $_id
    if (is_numeric($_id) && intval($_id) > 0) {
        $user = $userModel->findUserById($_id);
        // Nếu không tìm thấy user thì đặt lại $user thành NULL
        if (empty($user)) {
            $isInvalidId = true; // Set flag if user is not found
            $_id = null;
        }
    } else {
        $isInvalidId = true; // Set flag if id is not valid
        $_id = null; // Đặt lại nếu id không hợp lệ
    }
}

// Câu 3:
// ---Validate dữ liệu---
$errorMessages = [];
if (!empty($_POST['submit'])) {
    // Validate name
    if (empty($_POST['name'])) {
        $errorMessages['name'] = "Vui lòng nhập tên.";
    } else {
        $name = $_POST['name'];
        if (!preg_match("/^[A-Za-z0-9]{5,15}$/", $name)) {
            $errorMessages['name'] = "Tên phải chứa từ 5-15 ký tự hợp lệ (A-Z, a-z, 0-9).";
        }
    }

    // // Validate password
    if (empty($_POST['password'])) {
        $errorMessages['password'] = "Vui lòng nhập mật khẩu.";
    } else {
        $password = $_POST['password'];
        if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[~!@#$%^&*()])[A-Za-z\d~!@#$%^&*()]{5,10}$/", $password)) {
            $errorMessages['password'] = "Mật khẩu phải chứa từ 5-10 ký tự, bao gồm ít nhất một chữ thường, một chữ hoa, một chữ số và một ký tự đặc biệt (~!@#$%^&*()).";
        }
    }

    if (empty($errorMessages)) {
        if (!empty($_id)) {
            $userModel->updateUser($_POST);
        } else {
            $userModel->insertUser($_POST);
        }
        header('location: list_users.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User form</title>
    <?php include 'views/meta.php' ?>
</head>

<body>
    <?php include 'views/header.php' ?>
    <div class="container">
        <?php if ($isInvalidId) { ?>
            <div class="alert alert-success" role="alert">
                <b>User not found!</b>
            </div>
        <?php } else { ?>
            <div class="alert alert-warning" role="alert">
                User form
            </div>
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $_id ?>">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" name="name" placeholder="Name"
                        value='<?php echo isset($name) ? $name : (!empty($user[0]['name']) ? $user[0]['name'] : ''); ?>'>
                    <?php if (isset($errorMessages['name'])): ?>
                        <p style="color: red;"><?php echo $errorMessages['name']; ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <?php if (isset($errorMessages['password'])): ?>
                        <p style="color: red;"><?php echo $errorMessages['password']; ?></p>
                    <?php endif; ?>
                </div>

                <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
            </form>
        <?php } ?>
    </div>
</body>
</html>