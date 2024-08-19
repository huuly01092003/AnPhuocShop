<?php
session_start();
include("./ketnoi.php");
require("./PHPMailer-master/src/PHPMailer.php");
require("./PHPMailer-master/src/SMTP.php");
require("./PHPMailer-master/src/Exception.php");

function clearSessionAndCookies() {
    $_SESSION = array();
    session_destroy();
    setcookie(session_name(), '', time() - 3600, '/');
}

// Kiểm tra xem có sự kiện submit từ form hay không
if (isset($_POST['submit_email'])) {
    // Lấy giá trị email từ form
    $email = $_POST['email'];

    // Kiểm tra email có tồn tại trong cơ sở dữ liệu không
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user) {
        $error = "Email không tồn tại trong cơ sở dữ liệu.";
    } else {
        // Email tồn tại trong cơ sở dữ liệu, tiến hành gửi email
        $mail = new PHPMailer\PHPMailer\PHPMailer();

        // Cấu hình SMTP
        $mail->isSMTP();
        $mail->SMTPDebug = 0; // Tắt debugging
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl'; // Sử dụng giao thức SSL
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->Username = "hieunhanag2003@gmail.com"; // Địa chỉ email của bạn
        $mail->Password = "wtsq xert lwxl nzcc"; // Mật khẩu email của bạn
        $mail->setFrom("hieunhanag2003@gmail.com"); // Địa chỉ email gửi
        $mail->Subject = "Code forget password"; // Chủ đề email

        // Tạo mã 6 số và lưu vào cơ sở dữ liệu
        $code = rand(100000, 999999); // Tạo mã 6 số ngẫu nhiên
        $sql_insert = "INSERT INTO reset_password_request (username, code) VALUES (?, ?)";
        $stmt_insert = $con->prepare($sql_insert);
        $stmt_insert->execute([$user['username'], $code]);

        // Nội dung email
        $mail->Body = "Mã xác nhận của bạn là: $code";
        $mail->addAddress($email); // Thêm địa chỉ email nhận vào

        if (!$mail->send()) {
            $error = "Gửi email không thành công. " . $mail->ErrorInfo;
        } else {
            $success = "Gửi email thành công.";
            $_SESSION['email'] = $email;
        }
    }
}

if (isset($_POST['submit_code'])) {
    $email = $_SESSION['email'];
    $code = $_POST['code'];
    $sql = "SELECT * FROM reset_password_request WHERE code = ? AND username = (SELECT username FROM users WHERE email = ?)";
    $stmt = $con->prepare($sql);
    $stmt->execute([$code, $email]);
    $request = $stmt->fetch();

    if (!$request) {
        $error = "Mã xác nhận không đúng.";
        clearSessionAndCookies();
        header("Location: quen_mk.php");
        exit();
    } else {
        $success = "Mã xác nhận đúng. Vui lòng nhập mật khẩu mới.";
        $_SESSION['code'] = $code;
    }
}

if (isset($_POST['submit_password'])) {
    $email = $_SESSION['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = "Mật khẩu không khớp.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql_update = "UPDATE users SET pass = ? WHERE email = ?";
        $stmt_update = $con->prepare($sql_update);
        $stmt_update->execute([$hashed_password, $email]);

        $success = "Đặt lại mật khẩu thành công.";
        clearSessionAndCookies();
        header("Location: Login.php");
        exit();
    }
}
?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <title>Quên mật khẩu</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">

    <link rel="stylesheet" href="styles.css">
</head>
<style>
    body {
    font-family: 'Arial', sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.login-page {
    width: 360px;
    padding: 8% 0 0;
    margin: auto;
}

.form {
    position: relative;
    background: #ffffff;
    max-width: 360px;
    margin: 0 auto 100px;
    padding: 45px;
    text-align: center;
    box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.2);
    border-radius: 8px;
}

.form input {
    font-family: 'Arial', sans-serif;
    outline: 0;
    background: #f2f2f2;
    width: 100%;
    border: 0;
    margin: 0 0 15px;
    padding: 15px;
    box-sizing: border-box;
    font-size: 14px;
    border-radius: 4px;
}

.form button {
    font-family: 'Arial', sans-serif;
    text-transform: uppercase;
    outline: 0;
    background: #4CAF50;
    width: 100%;
    border: 0;
    padding: 15px;
    color: #ffffff;
    font-size: 14px;
    cursor: pointer;
    border-radius: 4px;
    transition: all 0.3 ease;
}

.form button:hover,
.form button:active {
    background: #43A047;
}

.form .error {
    color: #ff0000;
    margin: 10px 0;
    font-size: 14px;
}

.form .success {
    color: #4CAF50;
    margin: 10px 0;
    font-size: 14px;
}

</style>
<body>
    <div class="login-page">
        <div class="form">
            <!-- Form gửi email -->
            <?php if (!isset($_SESSION['email']) && !isset($_SESSION['code'])): ?>
                <form method="post">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                    <button type="submit" name="submit_email">Gửi</button>
                </form>
            <?php endif; ?>

            <!-- Form nhập mã xác nhận -->
            <?php if ((isset($success) && $success === "Gửi email thành công.") || isset($_SESSION['code'])): ?>
                <form method="post">
                    <label for="code">Mã xác nhận:</label>
                    <input type="text" id="code" name="code" required>
                    <button type="submit" name="submit_code">Xác nhận</button>
                </form>
            <?php endif; ?>

            <!-- Form nhập mật khẩu mới -->
            <?php if (isset($_SESSION['code']) && !isset($_POST['submit_password'])): ?>
                <form method="post">
                    <label for="password">Mật khẩu mới:</label>
                    <input type="password" id="password" name="password" required>
                    <label for="confirm_password">Nhập lại mật khẩu:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                    <button type="submit" name="submit_password">Đặt lại mật khẩu</button>
                </form>
            <?php endif; ?>

            <!-- Hiển thị thông báo -->
            <?php if (isset($error)): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if (isset($success) && $success !== "Gửi email thành công." && $success !== "Mã xác nhận đúng. Vui lòng nhập mật khẩu mới."): ?>
                <div class="success"><?php echo $success; ?></div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
