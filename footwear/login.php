<?php
session_start();
require_once "./public/dbconnection.php";
if (isset($_POST['btn'])) {
    extract($_REQUEST);
    $sql = "select * from users where username = '$username'";
    // var_dump($sql);
    // die;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $us = $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($us);
    // die;
    if ($us != false) {
        if (password_verify($password, $us['password'])) {
            $_SESSION['username'] = $us['username'];
            $_SESSION['email'] = $us['email'];
            $_SESSION['role'] = $us['role'];
            $_SESSION['id'] = $us['user_id'];
            // var_dump($_SESSION);
            // die;
            header("location:index.php");
            die;
        } else {
            $err = "Mật khẩu không chính xác";
            // var_dump($err);
            // die;
        }
    } else {
        $userr = "Tài khoản chưa chính xác";
        // var_dump($userr);
        // die;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php require_once './public/header.php' ?>

<body>
    <?php include_once './public/nav.php' ?>
    <br><br>
    <p class="text-center text-danger">Đăng nhập</p>
    <div class="row">
        <div class="col-md-6" style="margin: auto;">
            <form method="post">
                <div class="form-group">
                    <label for="exampleInputEmail11">Tên tài khoản</label>
                    <input type="text" class="form-control" id="exampleInputEmail11" name="username">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mật khẩu</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                </div>
                <button type="submit" class="btn btn-outline-black" name="btn">Đăng nhập</button>
            </form>
        </div>
    </div>
</body>

</html>